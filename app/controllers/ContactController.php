<?php

namespace App\Controllers;

use App\Models\User;
use DateTime;
use DateTimeZone;

class ContactController extends Controller
{
  public function index($name)
  {
    $userModel = new User();
    /*     $dateNow = new DateTime('now', new DateTimeZone('America/Bogota'));

    return $userModel->create([
      'nombre' => 'Física',
      'fecha_hora' => $dateNow->format('Y-m-d H:i:s')
    ]); */
    return $this->view('contact.index', [
      'title' => $name,
      'state' => 'activo',
      'meets' => $userModel->getMeets()
    ]);
  }
}
