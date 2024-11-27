<?php

namespace App\Controllers;

use Core\Controller;
use App\Controllers\MyDateTime;
use Core\Database;

class DashController extends Controller
{

  public function dash()
  {

    if ($_SERVER['REQUEST_METHOD'] === "POST") {

      $modelo = $_POST['modelo'];
      $placa = $_POST['placa'];
      $cor = "";

      $entrada = date('Y-m-d H:i:s'); // Hora atual no formato DATETIME

      $db = Database::connect();

      $stm = $db->prepare("INSERT INTO veiculos (modelo, placa, cor, entrada) VALUES (:modelo, :placa, :cor, :entrada)");

      $stm->bindParam(":modelo", $modelo);
      $stm->bindParam(":placa", $placa);
      $stm->bindParam(":cor", $cor);
      $stm->bindParam(":entrada", $entrada);

      if ($stm->execute()) {
        $this->redirect('dash/index');
      }

    }

    $this->view('/dash/index', ['modelo' => $modelo]);
  }

  public function update()
  {

    if (class_exists('App\Controllers\MyDateTime')) {
      echo "Classe MyDateTime existe!";
  } else {
      echo "Classe MyDateTime não foi encontrada!";
  }
  
    if ($_SERVER['REQUEST_METHOD'] === "POST") {

      $placa = $_POST['placa']; // Identifica o veículo pela placa ou ID
      $saida = date('Y-m-d H:i:s'); // Hora atual no formato DATETIME

      $db = Database::connect();

      $stm = $db->prepare("UPDATE veiculos SET saida = :saida WHERE placa = :placa");
      $stm->bindParam(":saida", $saida);
      $stm->bindParam(":placa", $placa);

      //if ($stm->execute()) {
      //  $this->redirect('index');
      //}

      $this->view('/dash/update');

    }
    $this->view('/dash/update');
  }

  public function index()
  {
    $this->view('/dash/index');
  }

  public function registro()
  {

    // $stm->execute();

    $this->redirect('/dash');
  }
}