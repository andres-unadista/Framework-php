<?php

namespace App\Controllers;

class ContactController extends Controller
{
  public function index($name)
  {
    return $this->view('contact.index', [
      'title' => $name,
      'state' => 'activo'
    ]);
  }
}
