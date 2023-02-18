<?php

declare(strict_types=1);

namespace App\Models;

use Exception;
use mysqli;

class Model
{
  private $db_user = DB_USER;
  private $db_name = DB_NAME;
  private $db_pass = DB_PASS;
  private $db_host = DB_HOST;
  protected $connection;
  protected $query;
  protected $table;

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
    try {
      $this->query = $this->connection->query($sql);
    } catch (Exception $e) {
      die("Error query: " . $e->getMessage());
    }
    return $this;
  }

  public function first()
  {
    return $this->query->fetch_assoc();
  }

  public function getAll()
  {
    return $this->query->fetch_all(MYSQLI_ASSOC);
  }

  public function all()
  {
    $sql = "SELECT * FROM {$this->table}";
    return $this->query($sql)->getAll();
  }

  public function find(int $id)
  {
    $sql = "SELECT * FROM {$this->table} WHERE id = {$id}";
    return $this->query($sql)->first();
  }

  public function where(string $column, string $operator, $value = null)
  {
    if ($value == null) {
      $value = $operator;
      $operator = "=";
    }

    $sql = "SELECT * FROM {$this->table} WHERE {$column} {$operator} '{$value}'";
    $this->query($sql);
    return $this;
  }

  public function create(array $data)
  {
    $columns = implode(',', array_keys($data));
    $values = "'" . implode("','", array_values($data)) . "'";

    $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";
    $this->query($sql);
    $last_id = $this->connection->insert_id;

    return $this->find($last_id);
  }

  public function update(int $id, array $data)
  {
    $columns = array_map(
      fn ($value, $key) => "{$key}='{$value}'",
      $data,
      array_keys($data)
    );

    $columns =  implode(',', $columns);
    $sql = "UPDATE {$this->table} SET {$columns} WHERE id = {$id}";
    $this->query($sql);
    return $this->find($id);
  }

  public function delete(int $id)
  {
    $sql = "DELETE FROM {$this->table} WHERE id = {$id}";
    $this->query($sql);
  }
}
