<?php

require_once "../model/travel.php";
require_once "../model/note.php";

class publicController extends baseController {
	var $travel_model;
	var $note_model;

	public function __construct($mysqli, $config) {
		parent::__construct($config);

		$this->travel_model = new travelModel($mysqli, $config);
		$this->note_model = new noteModel($mysqli, $config);
	}

	public function travel_list() {
		$travels = $this->travel_model->read_all();

		$data = array(
			"travels" => $travels["data"]
		);

		$this->render("public/index", $data);
	}

	public function note_list($travel_link) {
		$travel = $this->travel_model->read_by_link($travel_link);
		if($travel["result"] === false) {
			$_SESSION["error"] = "goto is not found.";
			$this->redirect("/error");
		}

		$direction = "DESC";
		if(isset($_GET["from"]) && $_GET["from"] === "old") {
			$direction = "ASC";
		}

		$per_page = 10;
		$page = 1;
		if(isset($_GET["page"])) {
			$page = intval($_GET["page"]);
		}
		$skip = ($page - 1) * $per_page;

		$count_notes = $this->note_model->count_by_travels_id($travel["data"]["id"]);
		$count_pages = ceil($count_notes["data"] / $per_page);

		$notes = $this->note_model->read_by_travels_id($travel["data"]["id"], $per_page, $direction, $skip);

		$data = array(
			"travel" => $travel["data"],
			"notes" => $notes["data"],
			"page" => $page,
			"count_pages" => $count_pages,
			"direction" => $direction
		);

		$this->render("public/notes", $data);
	}

	public function note_view($travel_link, $note_id) {
		$travel = $this->travel_model->read_by_link($travel_link);
		if($travel["result"] === false) {
			$_SESSION["error"] = "goto is not found.";
			$this->redirect("/error");
		}

		$note = $this->note_model->read($note_id);
		if($note["result"] === false) {
			$_SESSION["error"] = "note is not found.";
			$this->redirect("/error");
		}
		else if($travel["data"]["id"] !== $note["data"]["travels_id"]) {
			$_SESSION["error"] = "note is not found.";
			$this->redirect("/error");
		}

		$data = array(
			"travel" => $travel["data"],
			"note" => $note["data"]
		);

		$this->render("public/note_view", $data);
	}

	public function error() {
		$message = "";
		if(isset($_SESSION["error"]) && $_SESSION["error"] !== "") {
			$message = $_SESSION["error"];
			$_SESSION["error"] = "";
		}

		$this->render("public/error", array("message" => $message));
	}
}