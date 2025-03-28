<?php

//isset = is-set ¿está asignado?, ¿existe?
if (isset($_SERVER['REQUEST_METHOD'])){

  //Las respuestas estén formateadas como JSON
  header('Content-Type: application/json; charset=utf-8');

  require_once "../models/Producto.php";
  $producto = new Producto();

  switch ($_SERVER['REQUEST_METHOD']){
    case 'GET':
      echo json_encode($producto->getAll());
      break;
    case 'POST':
      
      break;
  }

}