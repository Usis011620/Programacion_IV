<?php
class DB{
    private $conexion, $result;

    public function BD($server, $user, $pass){
        $this->conexion = new PDO($server, $user, $pass, array(PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)) or die('Error al conectar con la base de datos');

    }
    public function consultas($sql=''){
        try{
            $parametros = func_get_args();
            array_shift($parametros);
            $this->preparado = $this->conexion->prepare($sql);
            $this->result = $this->preparado->execute($parametros);
        }catch(PDOException $e){
            echo 'Error: ' .$e->getMessage();
        }
    }
    public function obtener_datos(){
        return $this->preparado->fetchAll(PDO::FETCH_ASSOC);
    }
    public function obtener_respuesta(){
        return $this->result;
    }
    public function obtenerUltimoId(){
        return $this->conexion->lastInsertId();
    }
}
?>