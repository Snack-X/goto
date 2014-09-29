<?php

class noteModel {
	private $mysqli;
	private $config;

	public function __construct($mysqli, $config) {
		$this->mysqli = $mysqli;
		$this->config = $config;
	}

	public function create($travels_id, $type, $data) {
		$query = "INSERT INTO `notes` (travels_id, time, type, data)
		          VALUES (?, ?, ?, ?)";
		$time = time();

		$stmt = $this->mysqli->prepare($query);
		$stmt->bind_param("iiss", $travels_id, $time, $type, $data);
		$stmt->execute();
		$stmt->close();
	}

	public function read($where_id) {
		$query = "SELECT id, travels_id, time, type, data
		          FROM `notes`
		          WHERE id = ?";

		$stmt = $this->mysqli->prepare($query);
		$stmt->bind_param("i", $where_id);
		$stmt->execute();

		$stmt->bind_result($id, $travels_id, $time, $type, $data);

		$result = array(
			"result" => false,
			"data" => array()
		);

		while($stmt->fetch()) {
			$result["result"] = true;

			$result["data"] = array(
				"id" => $id,
				"travels_id" => $travels_id,
				"time" => $time,
				"type" => $type,
				"data" => $data
			);
		}

		$stmt->close();

		return $result;
	}

	/**
	 * read all notes where note.id = travel.id
	 * ex) to get last 10 notes = read_by_travels_id($id, 10, "DESC")
	 * ex) to get first 10 notes = read_by_travels_id($id, 10, "ASC")
	 * @param int    $where_travels_id travel.id
	 * @param int    $count            number of notes
	 * @param string $direction        DESC or ASC. if DESC latest first, if ASC oldest first
	 * @param int    $skip             number of notes to skip
	 * @return array
	 */
	public function read_by_travels_id($where_travels_id, $count = 10, $direction = "DESC", $skip = 0) {
		$sign = "<=";
		if($direction === "ASC") $sign = ">=";

		$query = "SELECT id, time, type, data
		          FROM `notes`
		          WHERE travels_id = ?
		          ORDER BY id $direction
		          LIMIT $skip, $count";

		$stmt = $this->mysqli->prepare($query);
		$stmt->bind_param("i", $where_travels_id);
		$stmt->execute();

		$stmt->bind_result($id, $time, $type, $data);

		$result = array(
			"result" => false,
			"data" => array()
		);

		while($stmt->fetch()) {
			$result["result"] = true;

			$note = array(
				"id" => $id,
				"time" => $time,
				"type" => $type,
				"data" => $data
			);

			array_push($result["data"], $note);
		}

		$stmt->close();

		return $result;
	}

	public function read_latest_note() {
		$query = "SELECT id, travels_id, time, type, data
		          FROM `notes`
		          ORDER BY time DESC
		          LIMIT 1";

		$stmt = $this->mysqli->prepare($query);
		$stmt->execute();

		$stmt->bind_result($id, $travels_id, $time, $type, $data);

		$result = array(
			"result" => false,
			"data" => array()
		);

		while($stmt->fetch()) {
			$result["result"] = true;

			$result["data"] = array(
				"id" => $id,
				"travels_id" => $travels_id,
				"time" => $time,
				"type" => $type,
				"data" => $data
			);
		}

		$stmt->close();

		return $result;
	}

	public function count_by_travels_id($where_travels_id) {
		$query = "SELECT count(*)
		          FROM `notes`
		          WHERE travels_id = ?";

		$stmt = $this->mysqli->prepare($query);
		$stmt->bind_param("i", $where_travels_id);
		$stmt->execute();

		$stmt->bind_result($count);

		$result = array(
			"result" => false,
			"data" => 0
		);

		while($stmt->fetch()) {
			$result["result"] = true;
			$result["data"] = intval($count);
		}

		$stmt->close();

		return $result;
	}

	public function delete($where_id) {
		$stmt = $this->mysqli->prepare("DELETE FROM `notes` WHERE id = ?");
		$stmt->bind_param("i", $where_id);
		$stmt->execute();
		$stmt->close();
	}
}