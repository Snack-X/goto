<?php

require_once "../model/admin.php";
require_once "../model/travel.php";
require_once "../model/note.php";

class adminController extends baseController {
	var $admin_model;
	var $travel_model;
	var $note_model;

	public function __construct($mysqli, $config) {
		parent::__construct($config);

		$this->admin_model = new adminModel($mysqli, $config);
		$this->travel_model = new travelModel($mysqli, $config);
		$this->note_model = new noteModel($mysqli, $config);
	}

	private function _check_session() {
		if(!isset($_SESSION["mode"]) || $_SESSION["mode"] !== "admin") {
			$this->redirect("/admin/login");
		}
	}

	public function index() {
		$this->_check_session();

		$this->render("admin/index");
	}

	public function login() {
		$this->render("admin/login");
	}

	public function logout() {
		$_SESSION["mode"] = "";
		unset($_SESSION["mode"]);
		session_destroy();

		$this->redirect("/admin/login");
	}

	public function login_process() {
		$id = $_POST["id"];
		$pw = $_POST["password"];

		if($this->config["admin"]["id"] !== $id ||
		   $this->config["admin"]["password"] !== $this->admin_model->hash($pw)
		) {
			$this->redirect("/admin/login");
		}

		$_SESSION["mode"] = "admin";

		$this->redirect("/admin");
	}

	public function travel() {
		$this->_check_session();

		$travels = $this->travel_model->read_all();

		$data = array(
			"travels" => $travels["data"]
		);

		$this->render("admin/travel", $data);
	}

	public function travel_create() {
		$this->_check_session();

		$this->render("admin/travel_create");
	}

	private function _validate_travel($validate_link = true) {
		$name = $this->post("name");
		$description = $this->post("description");
		$start_y = intval($this->post("start_y"));
		$start_m = intval($this->post("start_m"));
		$start_d = intval($this->post("start_d"));
		$end_y = intval($this->post("end_y"));
		$end_m = intval($this->post("end_m"));
		$end_d = intval($this->post("end_d"));

		// conditional
		if($validate_link) {
			$link = $this->post("link");
		}

		try {
			if($name === "") throw new Exception("name is required");
			if($description === "") throw new Exception("description is required");

			if(Validator::valid_date($start_y, $start_m, $start_d) === false) {
				throw new Exception("invalid start date");
			}

			if(Validator::valid_date($end_y, $end_m, $end_d) === false) {
				throw new Exception("invalid end date");
			}

			$start_time = $start_y * 10000 + $start_m * 100 + $start_d;
			$end_time = $end_y * 10000 + $end_m * 100 + $end_d;
			if($start_time > $end_time) {
				throw new Exception("invalid date range");
			}

			// conditional
			if($validate_link) {
				if($link === "") throw new Exception("link is required");

				$travel = $this->travel_model->read_by_link($link);
				if($travel["result"] === true) {
					throw new Exception("duplicate link");
				}
			}
		} catch(Exception $e) {
			$this->back();
		}

		return array(
			$name, $link, $description,
			$start_y, $start_m, $start_d,
			$end_y, $end_m, $end_d
		);
	}

	public function travel_create_process() {
		$this->_check_session();

		list(
			$name, $link, $description,
			$start_y, $start_m, $start_d,
			$end_y, $end_m, $end_d
		) = $this->_validate_travel();

		$start = $start_y."-".$start_m."-".$start_d;
		$end = $end_y."-".$end_m."-".$end_d;

		$this->travel_model->create($link, $name, $description, $start, $end);

		$this->redirect("/admin/travel");
	}

	public function travel_update($travel_id) {
		$this->_check_session();

		$travel = $this->travel_model->read($travel_id);

		if($travel["result"] === false) {
			$this->back();
		}

		$start = $travel["data"]["start"];
		$end = $travel["data"]["end"];
		$travel["data"]["start_y"] = intval(substr($start, 0, 4));
		$travel["data"]["start_m"] = intval(substr($start, 5, 2));
		$travel["data"]["start_d"] = intval(substr($start, 8, 2));
		$travel["data"]["end_y"] = intval(substr($end, 0, 4));
		$travel["data"]["end_m"] = intval(substr($end, 5, 2));
		$travel["data"]["end_d"] = intval(substr($end, 8, 2));

		$data = array(
			"travel" => $travel["data"]
		);

		$this->render("admin/travel_update", $data);
	}

	public function travel_update_process($travel_id) {
		$this->_check_session();

		list(
			$name, $link, $description,
			$start_y, $start_m, $start_d,
			$end_y, $end_m, $end_d
		) = $this->_validate_travel(false);

		$start = $start_y."-".$start_m."-".$start_d;
		$end = $end_y."-".$end_m."-".$end_d;

		$this->travel_model->update($travel_id, $name, $description, $start, $end);

		$this->redirect("/admin/travel");
	}

	public function travel_delete($travel_id) {
		$this->_check_session();

		$travel = $this->travel_model->read($travel_id);

		if($travel["result"] === false) {
			$this->back();
		}

		$this->travel_model->delete($travel_id);

		$this->redirect("/admin/travel");
	}

	public function write() {
		$this->_check_session();

		$this->render("admin/write");
	}

	public function write_checkin() {
		$this->_check_session();

		$travels = $this->travel_model->read_all();
		$note = $this->note_model->read_latest_note();

		if($travels["result"] === false) {
			// no travels created
			$this->redirect("/admin/travel/create");
		}

		$data = array(
			"travels" => $travels["data"],
			"latest_note" => $note["data"]
		);

		$this->render("admin/write_checkin", $data);
	}

	public function write_checkin_process() {
		$this->_check_session();

		$travels_id = $this->post("travels_id");
		$travel = $this->travel_model->read($travels_id);

		if($travel["result"] === false) {
			$this->back();
		}

		$venue = $this->post("venue");
		preg_match("/([0-9.]+),([0-9.]+),(.*)/", $venue, $match);
		$venue_lat = $match[1];
		$venue_lng = $match[2];
		$venue_name = $match[3];

		$content = $this->post("content");

		$image = false;
		if($_FILES["image"]["error"] !== UPLOAD_ERR_NO_FILE) {
			try {
				$upload_path = "upload/".$travel["data"]["link"];
				$image = $this->admin_model->upload_file("image", $upload_path);
			} catch(Exception $e) {
				echo $e->getMessage();
				die;
			}
		}

		$note_data = array(
			"venue" => array($venue_lat, $venue_lng, $venue_name),
			"content" => $content,
			"image" => $image
		);
		$this->note_model->create($travels_id, "checkin", serialize($note_data));

		$latest_note = $this->note_model->read_latest_note();
		$this->admin_model->after_create($travel, $latest_note);

		$this->redirect("/admin");
	}

	public function write_note() {
		$this->_check_session();

		$travels = $this->travel_model->read_all();
		$note = $this->note_model->read_latest_note();

		if($travels["result"] === false) {
			// no travels created
			$this->redirect("/admin/travel/create");
		}

		$data = array(
			"travels" => $travels["data"],
			"latest_note" => $note["data"]
		);

		$this->render("admin/write_note", $data);
	}

	public function write_note_process() {
		$this->_check_session();

		$travels_id = $this->post("travels_id");
		$travel = $this->travel_model->read($travels_id);

		if($travel["result"] === false) {
			$this->back();
		}

		$content = $this->post("content");

		$image = false;
		if($_FILES["image"]["error"][0] !== UPLOAD_ERR_NO_FILE) {
			try {
				$upload_path = "upload/".$travel["data"]["link"];
				if(is_array($_FILES["image"]["name"])) {
					$image = $this->admin_model->upload_multiple_files("image", $upload_path);
				}
				else {
					$image = array($this->admin_model->upload_file("image", $upload_path));
				}
			} catch(Exception $e) {
				echo $e->getMessage();
				die;
			}
		}

		$note_data = array(
			"content" => $content,
			"image" => $image
		);
		$this->note_model->create($travels_id, "note", serialize($note_data));

		$latest_note = $this->note_model->read_latest_note();
		$this->admin_model->after_create($travel, $latest_note);

		$this->redirect("/admin");
	}
}