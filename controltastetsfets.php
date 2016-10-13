<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Control Tastets Fets</title>
        <script src="js/mostrartastet.js"></script>
 <link rel="stylesheet" type="text/css" href="css/estils.css">
    </head>
      
    <body>
          
      <header>
            <H1>FES UN TAST A L'ENGINYERIA</H1>
            <img id="logo" src="/Francesc/Tastets/vista/imatges/logo2.jpg" alt="logo">
            <img id="imatgeheader" src="/Francesc/Tastets/vista/imatges/capcalera_recurs_8.jpg">
            <button><a href="sortirzonaprivada.php">Sortir de la zona Privada</a></button><br>
            
            
        </header>
        <div id="contenedor">
        
        
<?php
      
session_start();
 


if(!isset($_SESSION['dni']))
    {
        echo "<h3>Les credencials no son vàlides</h3><div id='tornar'><a href='/Francesc/Tastets/index.php' title='Tornar a Index'><img src='vista/imatges/home.jpg'></a></div>";
        $_SESSION=[];
        session_destroy();
        

    }       

if(isset($_SESSION['dni']))
    {       
         try{
            $con = new PDO('mysql:host=localhost;dbname=activitats', "root"); 
        }catch(PDOException $e){
            echo "<div class='error'>".$e->getMessage()."</div>"; 
            die();
        }
        if($_SESSION['perfil']=="B")
        {    
            $sel="SELECT * from activitats where activitats.dni='".$_SESSION["dni"]."' and activitats.int_borrat='No' ;";
        }
        if($_SESSION['perfil']=="A")
        {    
            $sel="SELECT * from activitats where activitats.int_borrat='No' ;";
        }
        $res=$con->query($sel);
        $res=$res->fetchAll();
        echo "<h2>Pàgina d'inici Usuari ".$_SESSION["dni"]."</h2><h3>Aquí pots controlar els tastets fets fins ara</h3>";
        
        if(count($res)>0)
        {    
            
            echo "<table>
            
            
            <tr><th>Nom del Tastet</th><th>Tastets Fets</th><th>Total Alumnes</th></tr>";
            foreach($res as $fila)
            {
            $sel2="SELECT count(*) from activitats_fetes where activitat_id=".$fila["id"].";"; 
            $res2=$con->query($sel2);
            $res2=$res2->fetch();
                
            
                
            $sel3="SELECT count(*) from estu_activitats, activitats_fetes where estu_activitats.activitats_fetes_id=activitats_fetes.id and activitats_fetes.activitat_id=".$fila["id"].";"; 
            $res3=$con->query($sel3);
            $res3=$res3->fetch();
                
            echo "<tr><td><a href='javascript:activitats_fetes(".$fila["id"].")'>".$fila["nom"]."</a></td><td>".$res2[0]."</td><td>".$res3[0]."</td></tr>";
            }
            echo "</table>";
            echo "<div id='resultado'></div>";
            
        }
        else 
        {
            echo "<h4>Ara mateix no ets responsable de cap curs</h4>";
            
        }
       
        
     }
?>
        </div>    
    </body>
</html>