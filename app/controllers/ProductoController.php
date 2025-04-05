<?php

//isset = is-set ¿está asignado?, ¿existe?
if (isset($_SERVER['REQUEST_METHOD'])) {

  //Las respuestas estén formateadas como JSON
  header('Content-Type: application/json; charset=utf-8');

  require_once "../models/Producto.php";
  $producto = new Producto();

  switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
      if($_GET['task'] == 'getAll'){ echo json_encode($producto->getAll()); }
      if($_GET['task'] == 'getById'){ echo json_encode($producto->getById($_GET['idproducto'])); }
      break;
    case 'POST':
      //Los datos llegan del cliente en formato: JSON/XML/TXT/FORMDATA
      $input = file_get_contents('php://input');
      $dataJSON = json_decode($input, true);

      //Registrar un nuevo producto
      $registro = [
        'idmarca' => htmlspecialchars($dataJSON['idmarca']),
        'tipo' => htmlspecialchars($dataJSON['tipo']),
        'descripcion' => htmlspecialchars($dataJSON['descripcion']),
        'precio' => htmlspecialchars($dataJSON['precio']),
        'garantia' => htmlspecialchars($dataJSON['garantia']),
        'esnuevo' => htmlspecialchars($dataJSON['esnuevo'])
      ];

      $n = $producto->add($registro);
      echo json_encode(["rows" => $n]); //{"rows": 1}

      break;
      
    case "DELETE":
      //El ID viene en la URL = miweb.com/app/productos/7
      $URL = $_SERVER['REQUEST_URI'];
      $arrayUrl = explode('/', $URL);
      $id = end($arrayUrl);

      $n = $producto->delete(["idproducto" => $id]); //0 - 1
      //Lo que envia BACKEND o FRONTEND debe ir como JSON
      echo json_encode(["rows" => $n]);



      break;
  }

}