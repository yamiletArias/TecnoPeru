<?php

require_once "../config/Database.php";

//Contiene toda la lógica
class Producto{
  
  private $conexion;

  public function __construct(){
    $this->conexion = Database::getConexion();
  }

  public function getAll(): array{
    $result = [];
    try{
      $sql = "SELECT * FROM vs_productos_todos ORDER BY id";

      //Consultas preparadas (SEGURIDAD evitar inyecciones SQL)
      $stmt = $this->conexion->prepare($sql);
      $stmt->execute();

      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e){
      throw new Exception($e->getMessage());
    }

    return $result;
  }

  public function add($params = []): int{
    $numRows = 0;

    try{
      //Los parámetros puede ingresar como: ? COMODINES - :valor VARIABLES
      $sql = "INSERT INTO productos (idmarca, tipo, descripcion, precio, garantia, esnuevo) VALUES (?,?,?,?,?,?)";
      $stmt = $this->conexion->prepare($sql); 

      $stmt->execute(
        array(
          $params["idmarca"],
          $params["tipo"],
          $params["descripcion"],
          $params["precio"],
          $params["garantia"],
          $params["esnuevo"]
        )
      );

      $numRows = $stmt->rowCount();

    }catch(PDOException $e){
      throw new Exception($e->getMessage());
    }

    return $numRows;
  }

  public function edit(): int{
    return 1;
  }

  public function delete(): int{
    return 1;
  }

  public function getById(): array{
    return [];
  }

}

/*
$producto = new Producto();

$registro = [
  "idmarca"     => 1,
  "tipo"        => "Tablet",
  "descripcion" => "Modelo A7",
  "precio"      => 900,
  "garantia"    => 12,
  "esnuevo"     => "S"
];

$n = $producto->add($registro);
var_dump( $n );
*/