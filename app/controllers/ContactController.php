<?php

namespace App\Controllers;

use App\Models\User;

class ContactController extends Controller
{
  public function index($name)
  {
    $userModel = new User();
    var_dump($userModel->getContacts());
    var_dump($userModel->getContact());

    return $this->view('contact.index', [
      'title' => $name,
      'state' => 'activo'
    ]);
  }
}
