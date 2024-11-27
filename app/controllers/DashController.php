<?php

namespace App\Controllers;

use Core\Controller;
use Core\helpers;
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
        $this->redirect('/dash/index');
      }

    }

    $this->view('/dash/index');
  }

  public function update()
{
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $placa = $_POST['placa'];
        $saida = date('Y-m-d H:i:s');

        $db = Database::connect();

        $stm = $db->prepare("UPDATE veiculos SET saida = :saida WHERE placa = :placa");
        $stm->bindParam(":saida", $saida);
        $stm->bindParam(":placa", $placa);
        $stm->execute();

        // Buscar o registro atualizado
        $stm = $db->prepare("SELECT * FROM veiculos WHERE placa = :placa");
        $stm->bindParam(":placa", $placa);
        $stm->execute();

        $data = $stm->fetch();

        if ($data) {
            $tempoPermanencia = calcularHorasPassadas($data['entrada'], $data['saida']);

            $this->view('/dash/update');
            return;
        }
    }

    $this->view('/dash/update');
}

  public function index()
  {
        $db = Database::connect();

        $stm = $db->prepare("SELECT * FROM veiculos");
        $stm->execute();

        $data = $stm->fetchAll();
        $this->view('/dash/index', ['data' => $data]);
  }

  public function registro()
  {

    // $stm->execute();

    $this->redirect('/dash');
  }
}