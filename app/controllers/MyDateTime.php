<?php

namespace App\Controllers;

use Core\Controller;

class MyDateTime extends Controller
{
    private $dateTime;

    public function __construct($date = 'now')
    {
        $this->dateTime = new \DateTime($date); // Usando a classe DateTime nativa do PHP
    }

    public function addDays($days)
    {
        $this->dateTime->modify("+$days days");
    }

    public function subDays($days)
    {
        $this->dateTime->modify("-$days days");
    }

    public function format($format)
    {
        return $this->dateTime->format($format);
    }

    // Método para acessar a data interna
    public function getDateTime()
    {
        return $this->dateTime;
    }
}
