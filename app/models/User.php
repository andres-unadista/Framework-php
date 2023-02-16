<?php

namespace App\Models;



class User extends Database
{
  public function getContacts()
  {
    $sql = "SELECT * FROM contacts";
    return $this->query($sql)->getAll();
  }

  public function getContact()
  {
    $sql = "SELECT * FROM contacts";
    return $this->query($sql)->first();
  }
}
