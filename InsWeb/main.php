<?php

date_default_timezone_set("Chile/Continental");
$server="127.0.0.1";
$user="root";
$bd="bitacora";

$conexion = mysqli_connect( $server, $user, "" )or die ("No se ha podido conectar al servidor de Base de datos");
$db = mysqli_select_db( $conexion, $bd) or die ("No se ha podido conectar al servidor de Base de datos");

if(isset($_POST['enviar'])){

$nom=$_POST['name'];
$ape=$_POST['surname'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$dir=$_POST['address'];
$car=$_POST['Cargo'];
$ubi=$_POST['Ubicacion'];

$nameimg=$_FILES['images']['name'];
$file=$_FILES['images']['tmp_name'];
$ruta="img";

$ruta=$ruta.'/'.$nameimg;

move_uploaded_file($file,$ruta);


$elim=("SELECT * FROM usuarios WHERE '".$nom."'=UserName and UserPass='".$pass."'");
$res=mysqli_query($conexion, $elim);

if  (/*Consulta si hay registro*/mysqli_num_rows($res)>0) {
  echo "<script type='text/javascript'>
alert('Usuario Ya Existente');
  </script>";
}
else{

if ($car=="Portero") {
  $ubi="Portería";
$save=("INSERT INTO usuarios VALUES ('".$nom."','".$ape."','".$email."','".$pass."','".$dir."','".$car."','".$ruta."',".$ubi."');");
$resultado=mysqli_query($conexion, $save)or die ( "Algo ha ido mal en la consulta a la base de datos");
}

elseif ($car=="Supervisor") {
$ubi="NULL";

}
$save=("INSERT INTO usuarios VALUES ('".$nom."','".$ape."','".$email."','".$pass."','".$dir."','".$car."','".$ruta."','".$ubi."');");
$resultado=mysqli_query($conexion, $save)or die ( "Algo ha ido mal en la consulta a la base de datos");

}

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Crear :)</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body background="img/hola.jpg">



<center>
	<div class="container mt-5">
<form method="post" action="" enctype="multipart/form-data">
  <div class="form-row">
   <div class="form-group col-md-6">
      <label for="user" class="text-white">Nombre</label>
      <input type="text" class="form-control bg-transparent border border-danger text-white" name="name" placeholder="Nombre" required="">
    </div>
   <div class="form-group col-md-6">
      <label for="user"class="text-white">Apellido</label>
      <input type="text" class="form-control bg-transparent border border-danger text-white" name="surname" placeholder="Apellido" required >
    </div>
   
    <div class="form-group col-md-6">
      <label for="inputEmail4"class="text-white">Email</label>
      <input type="email" class="form-control bg-transparent border border-danger text-white" name="email" placeholder="Email" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4"class="text-white">Contraseña(no repetir de Email)</label>
      <input type="password" class="form-control bg-transparent border border-danger text-white" name="pass" placeholder="Password" required >
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress"class="text-white">Dirección</label>
    <input type="text" class="form-control bg-transparent border border-danger text-white" name="address"id="InputAddress" placeholder="1234 Main St" required>
  </div> 


    <div class="form-group col-md-4">
      <select name="Cargo" class="form-control bg-transparent border border-primary text-primary">
        <option name="Inspector">Inspector</option>
        <option name="Portero">Portero</option>
        <option name="Supervisor">Supervisor</option>
      </select>
    </div>
     <div class="form-group col-md-4">
      <select name="Ubicacion" class="form-control bg-transparent border border-primary text-primary">
        <option class="bg-transparent">Internado A</option>
        <option>Internado B</option>
        <option>Internado D</option>
        <option>Portería</option>
      </select>
    </div>
  </div>
  <input type="submit" value="Enviar" name="enviar" class="btn btn-primary">
   <input type="reset" class="btn btn-danger">
   <br/>
   <br/>
    <div class="form-group col-md-7 mr-5">
      <label class="text-success">Imagen(Usuario)</label>
      <input type="file" name="images" class="form-control btn btn-primary bg-transparent border border-danger">
    </div>
    <a href="index.php"  class="text-white">Ya tengo Lista Mi Cuenta</a>
</form>
</div>
</center>



</body>
</html>