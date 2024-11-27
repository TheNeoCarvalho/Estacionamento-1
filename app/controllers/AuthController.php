<?php

namespace App\Controllers;

use Core\Controller;
use Core\Database;

class AuthController extends Controller
{
 
  public function register(){

    if($_SERVER['REQUEST_METHOD'] === "POST"){
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $db = Database::connect();

      $stm = $db->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
      
      $hash_password = password_hash($password, PASSWORD_DEFAULT);

      $stm->bindParam(":nome", $name);
      $stm->bindParam(":email", $email);
      $stm->bindParam(":senha", $hash_password);
      
        if($stm->execute()) {
          $this->redirect('/login');
        }

    }
    $this->view('/auth/register');
  }
 
  public function login()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $_POST['email'];
      $password = $_POST['senha'];

      $db = Database::connect();
      $stm = $db->prepare("SELECT * FROM usuarios WHERE email = :email");

      $stm->bindParam(":email", $email);
      $stm->execute();

      $user = $stm->fetch();
      session_start();

      if($user && password_verify($password, $user['senha'])){

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];

        $this->redirect('/dash');

      }
    }
    $this->view('auth/login');
  }
 }
