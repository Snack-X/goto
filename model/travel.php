<?php

class travelModel {
	private $mysqli;
	private $config;

	public function __construct($mysqli, $config) {
		$this->mysqli = $mysqli;
		$this->config = $config;
	}

	public function create($link, $name, $description, $start, $end) {
		$query = "INSERT INTO `travels` (link, name, description, start, end)
		          VALUES (?, ?, ?, ?, ?)";

		$stmt = $this->mysqli->prepare($query);
		$stmt->bind_param("sssss", $link, $name, $description, $start, $end);
		$stmt->execute();
		$stmt->close();
	}

	public function read($where_id) {
		$query = "SELECT id, link, name, description, start, end
		          FROM `travels`
		          WHERE id = ?";

		$stmt = $this->mysqli->prepare($query);
		$stmt->bind_param("i", $where_id);
		$stmt->execute();

		$result = $this->_read_fetch_single($stmt);

		$stmt->close();

		return $result;
	}

	public function read_by_link($where_link) {
		$query = "SELECT id, link, name, description, start, end
		          FROM `travels`
		          WHERE link = ?";

		$stmt = $this->mysqli->prepare($query);
		$stmt->bind_param("s", $where_link);
		$stmt->execute();

		$result = $this->_read_fetch_single($stmt);

		$stmt->close();

		return $result;
	}

	public function read_all() {
		$query = "SELECT id, link, name, description, start, end
		          FROM `travels`
		          ORDER by id DESC";

		$stmt = $this->mysqli->prepare($query);
		$stmt->execute();
		$stmt->bind_result($id, $link, $name, $description, $start, $end);

		$result = array(
			"result" => false,
			"data" => array()
		);

		while($stmt->fetch()) {
			$result["result"] = true;

			$travel = array(
				"id" => $id,
				"link" => $link,
				"name" => $name,
				"description" => $description,
				"start" => $start,
				"end" => $end
			);

			array_push($result["data"], $travel);
		}

		$stmt->close();

		return $result;
	}

	private function _read_fetch_single($stmt) {
		$stmt->bind_result($id, $link, $name, $description, $start, $end);

		$result = array(
			"result" => false,
			"data" => array()
		);

		while($stmt->fetch()) {
			$result["result"] = true;

			$result["data"] = array(
				"id" => $id,
				"link" => $link,
				"name" => $name,
				"description" => $description,
				"start" => $start,
				"end" => $end
			);
		}

		return $result;
	}

	public function update($where_id, $name, $description, $start, $end) {
		$query = "UPDATE `travels`
		          SET
		              name = ?,
		              description = ?,
		              start = ?,
		              end = ?
		          WHERE id = ?";

		$stmt = $this->mysqli->prepare($query);
		$stmt->bind_param("ssssi", $name, $description, $start, $end, $where_id);
		$stmt->execute();
		$stmt->close();
	}

	public function delete($where_id) {
		$query = "DELETE FROM `travels`
		          WHERE id = ?";

		$stmt = $this->mysqli->prepare($query);
		$stmt->bind_param("i", $where_id);
		$stmt->execute();
		$stmt->close();
	}
}