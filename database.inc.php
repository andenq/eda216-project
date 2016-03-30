<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*
 *
 * Class Database: interface to the movie database from PHP.
 *
 * You must:
 *
 * 1) Change the function userExists so the SQL query is appropriate for your tables.
 * 2) Write more functions.
 *
 */
class Database {
	private $host;
	private $userName;
	private $password;
	private $database;
	private $conn;
	
	/**
	 * Constructs a database object for the specified user.
	 */
	public function __construct($host, $userName, $password, $database) {
		$this->host = $host;
		$this->userName = $userName;
		$this->password = $password;
		$this->database = $database;
	}

    public function getPallets() {
        $sql = "SELECT * FROM Pallets";
        return $this->executeQuery($sql);
    }

    public function toggleBlockedPallet($barcodeId) {
        $sql = "UPDATE Pallets SET blocked_at = IF(blocked_at IS NULL, NOW(), NULL) WHERE barcode_id = ?";
        $this->executeUpdate($sql, array($barcodeId));
    }

    public function searchPallets($barcode_id, $pastry_name, $from_date, $to_date) {
        $sql = "SELECT * FROM Pallets WHERE 1=1"; // Riktig fuling
        $variables = array();

        if (!empty($barcode_id)) {
            $sql .= ' AND barcode_id = ?';
            $variables[] = $barcode_id;
        }

        if (!empty($pastry_name)) {
            $sql .= ' AND pastry_name = ?';
            $variables[] = $pastry_name;
        }

        if (!empty($from_date) && !empty($to_date)) {
            if ($from_date == $to_date) {
                $sql .= ' AND created_at = ?';
                $variables[] = $from_date;
            } else { 
                $sql .= ' AND created_at BETWEEN ? AND ?';
                $variables[] = $from_date;
                $variables[] = $to_date;
            }
        }

        return $this->executeQuery($sql, $variables);
    }
	
	/** 
	 * Opens a connection to the database, using the earlier specified user
	 * name and password.
	 *
	 * @return true if the connection succeeded, false if the connection 
	 * couldn't be opened or the supplied user name and password were not 
	 * recognized.
	 */
	public function openConnection() {
		try {
			$this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", 
					$this->userName,  $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			$error = "Connection error: " . $e->getMessage();
			echo $error . "<p>";
			unset($this->conn);
			return false;
		}
		return true;
	}
	
	/**
	 * Closes the connection to the database.
	 */
	public function closeConnection() {
		$this->conn = null;
		unset($this->conn);
	}

	/**
	 * Checks if the connection to the database has been established.
	 *
	 * @return true if the connection has been established
	 */
	public function isConnected() {
		return isset($this->conn);
	}
	
	/**
	 * Execute a database query (select).
	 *
	 * @param $query The query string (SQL), with ? placeholders for parameters
	 * @param $param Array with parameters 
	 * @return The result set
	 */
	private function executeQuery($query, $param = null) {
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->execute($param);
			$result = $stmt->fetchAll();
		} catch (PDOException $e) {
			$error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
			die($error);
		}
		return $result;
	}
	

	/**
	 * Execute a database update (insert/delete/update).
	 *
	 * @param $query The query string (SQL), with ? placeholders for parameters
	 * @param $param Array with parameters 
	 * @return The number of affected rows
	 */
	private function executeUpdate($query, $params = array()) {
		$stmt = $this->conn->prepare($query);
		$stmt->execute($params);
	}

    public function getPastries() {
        $sql = "SELECT name FROM pastries";
        $result = $this->executeQuery($sql);
        return $result;
    }

    public function scanPallet($barcode_id, $pastry_name) {
        $sql = "INSERT INTO StockEvents (material_name, amount) SELECT material_name, amount FROM Ingredients WHERE pastry_name = ?";
        $this->executeUpdate($sql, array($pastry_name));
               
        $sql = "INSERT INTO Pallets(barcode_id, pastry_name) VALUES (?, ?)";        
        $this->executeUpdate($sql, array($barcode_id, $pastry_name));
    }
}
?>
