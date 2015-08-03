<?php 

class CDatabase {


	public function __construct($options) {
	   $default = array(
	     'dsn' => null,
	     'username' => null,
	     'password' => null,
	     'driver_options' => null,
	     'fetch_style' => PDO::FETCH_OBJ,
	   );
	   $this->options = array_merge($default, $options);
	   try {
	     $this->db = new PDO($this->options['dsn'], $this->options['username'], $this->options['password'], $this->options['driver_options']);
	     $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	   }
	   catch(Exception $e) {
	     //throw $e; // For debug purpose, shows all connection details
	     throw new PDOException('Could not connect to database, hiding connection details.'); // Hide connection details.
	   }
	  }
		
	function executeQuery($query) {
		$this->db->query($query);
		
	}
	
	function prepareAndExecute($query) {
		$prepared = $this->db-prepare($query);
		$prepared->execute();
	}

	function createMovieTable($tableName) {
		
		$sql = 'DROP TABLE IF EXISTS ' . $tableName . ';
								CREATE TABLE ' . $tableName . '(
								id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
								title VARCHAR(80),
								description TEXT
							 );';
			$this->db->query($sql);
												
	}

}