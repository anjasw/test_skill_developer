<?php

class Koneksi{
 
	private $kon = null;

	function __construct(){
		
	}

	private function konek() {
		$this->kon = new mysqli('localhost', 'root', '', 'test_phiraka');
		if ($this->kon->connect_error) die("Connection failed: " . $this->kon->connect_error);
	}

	private function diskonek() {
		$this->kon->close();
	}

	public function query($sSQL, $num='row') {
		if(strlen(trim($sSQL)) > 0) {
			$response = array();
			$this->konek();
			$result = $this->kon->query($sSQL);
			if($result){

				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$response[] = $row;
					}
				}
				
				$this->diskonek();
			}else{
				echo "Table tidak ada dalam database";exit;
				
			}
			return $response;
		}
	}

	public function insert($table,$data){
		$response;
		$this->konek();
		$column = array();
		$value = array();

		foreach($data as $key => $val){
			$column[] = $key;
			$value[] = $val;
		}
		
		$sql_insert = "INSERT INTO ".$table."(".implode(",",$column).") VALUES('".implode("','",$value)."')";
		// echo $sql_insert;exit;
		$add = $this->kon->query($sql_insert);
		if($add){
			$response = true;
		}else{
			$response = false;
			
		}
		
		$this->diskonek();

		return $response;
	}

	public function update($table,$data,$condition){
		$response;
		$this->konek();

		$set = array();
		foreach($data as $key => $val){
			$set[] = $key."='".$val."'";
		}

		$whys = array();
		foreach($condition as $key => $val){
			$whys[] = $key."='".$val."'";
		}

		$sql_update = "UPDATE ".$table." SET ".implode(",",$set)." WHERE ".implode(' AND ',$whys);
		// echo $sql_update;exit;
		$add = $this->kon->query($sql_update);
		if($add){
			$response = true;
		}else{
			$response = false;
			
		}
		
		$this->diskonek();

		return $response;
	}

	public function delete($table,$condition){
		$response;
		$this->konek();

		$whys = array();
		foreach($condition as $key => $val){
			$whys[] = $key."='".$val."'";
		}

		$sql_delete = "DELETE FROM ".$table." WHERE ".implode(' AND ',$whys);
		// echo $sql_delete;exit;
		$add = $this->kon->query($sql_delete);
		if($add){
			$response = true;
		}else{
			$response = false;
			
		}
		
		$this->diskonek();

		return $response;
	}
}

$conn = new Koneksi();