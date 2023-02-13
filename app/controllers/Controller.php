<?php

namespace App\Controllers;

class Controller
{
  public function view($file, $data = [])
  {
    //destructuring
    extract($data);

    $file = str_replace('.', '/', $file);
    $path = "../resources/views/{$file}.php";
    if (file_exists($path)) {
      ob_start();
      include_once $path;
      $content = ob_get_clean();
      return $content;
    } else {
      return "El archivo no existe";
    }
  }
}
