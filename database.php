<?php

class DatabaseConnection
{
	private $host;
	private $dbname;
	private $username;
	private $password;
	private $connection;

	public function __construct($config)
	{
		$this->host = $config['host'];
		$this->dbname = $config['dbname'];
		$this->username = $config['username'];
		$this->password = $config['password'];
		$this->connection = null;
		$this->connect();
	}

	public function connect()
	{
		try {
			if (empty($this->host) ||
				empty($this->dbname) ||
				empty($this->username))
			{
				throw new Exception('Config missing database connection.');
			}
			$this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $this->connection;
		} catch (PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
			return null;
		}
	}
	
	public function query($query, $parameters = [])
	{
		try {
			$stmt = $this->connection->prepare($query);
			$stmt->execute($parameters);
			return $stmt;
		} catch (PDOException $e) {
			echo "Query failed: " . $e->getMessage();
			return false;
		}
	}

	public function select($table, $columns = '*', $where = '', $parameters = [])
	{
		try {
			$query = "SELECT $columns FROM $table";
			if (!empty($where)) {
				$query .= " WHERE $where";
			}

			$stmt = $this->query($query, $parameters);

			if ($stmt) {
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			} else {
				return [];
			}
		} catch (PDOException $e) {
			echo "Query failed: " . $e->getMessage();
			return false;
		}
	}
	
	public function insert($table, $data)
	{
		try {
			$columns = implode(', ', array_keys($data));
			$placeholders = implode(', ', array_fill(0, count($data), '?'));
			$query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
			
			$stmt = $this->query($query, array_values($data));
			
			if ($stmt) {
				return $this->connection->lastInsertId();
			} else {
				return false;
			}
		} catch (PDOException $e) {
			echo "Query failed: " . $e->getMessage();
			return false;
		}
	}
	
	public function update($table, $data, $where, $parameters = [])
	{
		$setClause = implode(', ', array_map(fn($key) => "$key = ?", array_keys($data)));
		$query = "UPDATE $table SET $setClause WHERE $where";

		$stmt = $this->executeQuery($query, array_merge(array_values($data), $parameters));

		return $stmt ? $stmt->rowCount() : false;
	}

	public function disconnect()
	{
		$this->connection = null;
	}

	public function getConnection()
	{
		return $this->connection;
	}
}
