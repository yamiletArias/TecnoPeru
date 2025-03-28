<?php

//Clase de conexión...
class Database{

  //Parámetros de conexión
  private static $host = "localhost";
  private static $dbname = "tecnoperu";
  private static $username = "root";
  private static $password = "";
  private static $charset = "utf8mb4";
  private static $conexion = null; //Objeto conexión


  //Se reutilizará la conexión activa
  public static function getConexion(){
    if (self::$conexion === null){
      try{
        //Cadena de conexión
        
        //mysql:host=localhost;port=3306;dbname=tecnoperu;charset=utf8mb4
        $DSN = "mysql:host=" . self::$host . ";port=3306;dbname=" . self::$dbname . ";charset=" . self::$charset;

        //Parámetros de conexión
        $options = [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES => false
        ];

        //Asignamos los nuevos datos al objeto conexion
        self::$conexion = new PDO($DSN, self::$username, self::$password, $options);  

      }catch(PDOException $e){
        throw new PDOException($e->getMessage());
      }
    }
    return self::$conexion;
  }

  public function desconectar(){
    self::$conexion = null;
  }

}