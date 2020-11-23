<?php
/* L.C.C.  Martha Isabel Chavez Trejo  */
class Login{

	var $con;
	var $db;
	var $host;
	var $user;
	var $pass;
	var $clases;
	var $modelo;
	var $objDB;
    var $usuario;
    var $login;
	
	function Login($conf){
       $this->db         = $conf["database"];
	   $this->host       = $conf["server"];
	   $this->user       = $conf["login"];
	   $this->pass       = $conf["pass"];
	   $this->modelo     = $conf["modelo"];
       $this->connect();
        } 

     function connect(){
      require_once($this->modelo."DB_Mysql.php");
      $this->objDB=new DB_Mysql();
	  $this->objDB->conectaServidor($this->db,$this->host,$this->user,$this->pass);
	 } 

     function validarUsuario($usuario,$passwd){
     	$user=trim($usuario);
     	$clave=trim($passwd);

   	   $sql = "SELECT nom_usuario,clave_acceso  FROM  usuarios_beacons WHERE  nom_usuario='$user'  AND  clave_acceso='$clave'";    
       // echo "$sql <br>"; // exit(1);

   	   $this->objDB->ejecutaConsulta($sql);
       $rows= $this->objDB->numRenglones();
       if($myrow = $this->objDB->regresaRenglon()){
          $this->usuario["login"] = $myrow[0];
          $this->usuario["passwd"] = $myrow[1];
      
       }else{
		      $this->usuario["login"] = "";
              $this->usuario["passwd"] = "";
             
	        }

	        // print_r($this->usuario);  exit(1);

           return $this->usuario; 
        }  

	
	  
}//class
?>