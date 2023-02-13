<?php

namespace App\Controllers;

class ContactController
{
  public function index($name)
  {
    return "El contacto es $name";
  }
}
