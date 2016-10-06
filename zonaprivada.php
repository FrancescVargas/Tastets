<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Usuari <?php echo $_POST["dni"]; ?></title>
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
 
if(isset($_POST["dni"]))
    {   
    
        if($_POST['usuari']!=="" && $_POST['dni']!=="" )
        {
          $_SESSION['usuari']=$_POST['usuari'];
         $_SESSION['dni']=$_POST['dni'];   

        }
    }

if(!isset($_SESSION['dni']))
    {
        echo "<h3>Les credencials no son vàlides</h3>";
        $_SESSION=[];
        session_destroy();

    }       

if(isset($_SESSION['dni']))
    {       
         try{
            $con = new PDO('mysql:host=localhost;dbname=tastets', "root"); 
        }catch(PDOException $e){
            echo "<div class='error'>".$e->getMessage()."</div>"; 
            die();
        }
        
        $sel="SELECT * from tastets where tastets.dni='".$_SESSION["dni"]."';";
        $res=$con->query($sel);
        $res=$res->fetchAll();
        echo "<h3>Pàdina d'inici Usuari ".$_SESSION["usuari"]."</h3>";
        
        if(count($res)>0)
        {    
            echo "<table>
            <caption><h4>Administració Tastets Propis</4></caption>
            <tr><th colspan=4><button id='afegirtastet'><a href='afegirtastet.php?responsable=".$res[0]["responsable"]."&dni=".$res[0]["dni"]."' title='afegir tastet'>Afegir Nou tastet</a></button>
            <tr><th>Nom del Tastet</th><th>Peticions</th><th>Eliminar</th><th>Modificar</th></tr>";
            foreach($res as $fila)
            {
            $sel2="SELECT count(*) from solicituts where solicituts.tastet_id=".$fila["id"].";"; 
            $res2=$con->query($sel2);
            $res2=$res2->fetch();
            echo "<tr><td>".$fila["nom"]."</td><td>".$res2[0]."</td><td><a title='eliminar tastet' href='zonaprivada.php?id_borrar=".$fila['id']."'><img class='eliminar' alt='eliminar tastet' src='vista/imatges/eliminar.png'></a></td><td><a title='editar tastet' href='editartastet.php?id=".$fila['id']."' ><img class='eliminar' alt='editar tastet' src=vista/imatges/modificar.png ></a></td></tr>";
            }
            echo "</table>";
        }
        else echo "<h4>Ara mateix no ets responsable de cap curs</h4>";
    
    
        if(isset ( $_GET['id_borrar']))
        {

            // borrar el tastet



         $sql = "delete from tastets where id='".$_GET['id_borrar']."';";
         $res=$con->exec($sql); 
         header ("Location:zonaprivada.php");

        } 
        
     }
?>
        </div>    
    </body>
</html>