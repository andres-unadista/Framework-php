<?php

namespace App\Models;

class User extends Model
{
  protected $table = 'meet';

  public function getMeets()
  {
    $sql = "SELECT * FROM meet";
    return $this->query($sql)->getAll();
  }

  public function getMeet()
  {
    $sql = "SELECT * FROM meet";
    return $this->query($sql)->first();
  }
}
