<?php

namespace App\Models;

use Exception;
use mysqli;

class Database
{
  private $db_user = DB_USER;
  private $db_name = DB_NAME;
  private $db_pass = DB_PASS;
  private $db_host = DB_HOST;
  protected $connection;
  protected $query;

  public function __construct()
  {
    $this->connection();
  }

  private function connection()
  {
    try {
      $this->connection = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
    } catch (Exception $e) {
      die("Error de base de datos: {$e->getMessage()}");
    }
  }

  protected function query($sql)
  {
    $this->query = $this->connection->query($sql);
    return $this;
  }

  protected function first()
  {
    return $this->query->fetch_assoc();
  }

  protected function getAll()
  {
    return $this->query->fetch_all(MYSQLI_ASSOC);
  }
}
