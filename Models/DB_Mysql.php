<?php
class DB_Mysql{
  var $dataBase;
  var $server;
  var $login;
  var $pass;
 //identificacion
  var $idConexion;
  var $idConsulta;
 //Manejo de errores
  var $errorNum;
  var $errorText;
//Constructor
  function DB_Mysql($db="",$host="localhost",$user="",$pas=""){
    $this->dataBase=$db;
    $this->server=$host;
    $this->login=$user;
    $this->pass=$pas;
  }
  function conectaServidor($db,$host,$user,$pas){
    $this->dataBase=$db;
    $this->server=$host;
    $this->login=$user;
    $this->pass=$pas;
    $this->idConexion=mysql_connect($this->server,$this->login,$this->pass);
    if(!$this->idConexion){
        $this->errorText="No hay conexion al servidor";
        return 0;
    }
    if(!mysql_select_db($this->dataBase,$this->idConexion)){
        $this->errorText="No es posible abrir:".$this->dataBase;
        return 0;
    }
    //Si todo salio bien, regresamos el identificador de la conexion;
    return $this->idConexion;
  }
  function ejecutaConsulta ($sql=""){
    if($sql==""){
        $this->errorText="No se especifico consulta SQL";
        return 0;
    }
    $this->idConsulta=mysql_query($sql,$this->idConexion);
    if(!$this->idConsulta){
        $this->errorNum=mysql_errno();
        $this->errorText=mysql_error();
    }
    return $this->idConsulta; //devuelve 0 si hay error
  }
  //no hay necesidad de usar esta funcion, mejor usa ejecutaConsulta
  function ejecutaEdicion ($sql=""){
    return $this->ejecutaConsulta($sql);
  }
  //regresa la cantidad de renglones del idConsulta atributo de la clase
  function regresaRenglon (){
     $result=mysql_fetch_array($this->idConsulta);
     if(empty($result)){
//	echo"<br>esta vacio";
      }
	return $result;
  }     
   function numRenglones(){
        return mysql_num_rows($this->idConsulta); //devuelve el numero de renglones de una consulta
  }
   
}//fin clase
?>