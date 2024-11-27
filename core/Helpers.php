<?php

function calcularHorasPassadas($entrada, $saida) {
  try {
      // Criar objetos DateTime a partir das strings fornecidas
      $dataEntrada = new DateTime($entrada);
      $dataSaida = new DateTime($saida);

      // Calcular a diferença entre as datas
      $intervalo = $dataEntrada->diff($dataSaida);

      // Obter horas e minutos do intervalo
      $horas = ($intervalo->days * 24) + $intervalo->h; // Inclui as horas de dias completos
      $minutos = $intervalo->i;

      // Montar a string formatada
      if ($horas > 0 && $minutos > 0) {
          return "{$horas}h e {$minutos}minutos";
      } elseif ($horas > 0) {
          return "{$horas}h";
      } elseif ($minutos > 0) {
          return "{$minutos} minutos";
      } else {
          return "Menos de um minuto";
      }
  } catch (Exception $e) {
      return "Erro ao processar as datas: " . $e->getMessage();
  }
}