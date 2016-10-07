<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Usuari <?php echo $_POST["dni"]; ?></title>
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
 
if(isset($_POST["dni"]))
    {   
    
        if(($_POST['perfil']=="A" || $_POST['perfil']=="B")  && $_POST['dni']!=="" )
        {
          $_SESSION['perfil']=$_POST['perfil'];
         $_SESSION['dni']=$_POST['dni'];   

        }
    }

if(!isset($_SESSION['dni']))
    {
        echo "<h3>Les credencials no son vàlides</h3><div id='tornar'><a href='/Francesc/Tastets/index.php' title='Tornar a Index'><img src='vista/imatges/home.jpg'></a></div>";
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
        if($_SESSION['perfil']=="B")
        {    
            $sel="SELECT * from tastets where tastets.dni='".$_SESSION["dni"]."' and tastets.int_borrat='No' ;";
        }
        if($_SESSION['perfil']=="A")
        {    
            $sel="SELECT * from tastets where tastets.int_borrat='No' ;";
        }
        $res=$con->query($sel);
        $res=$res->fetchAll();
        echo "<h3>Pàgina d'inici Usuari ".$_SESSION["dni"]."</h3><h4>Aquí pots administrar o crear els teus tastets</h4>";
        
        if(count($res)>0)
        {    
            
            echo "<table>
            
            <tr><th colspan=4><button id='afegirtastet'><a href='afegirtastet.php?responsable=".$res[0]["responsable"]."&dni=".$res[0]["dni"]."' title='afegir tastet'>Afegir Nou tastet</a></button>
            <tr><th>Nom del Tastet</th><th>Peticions</th><th>Eliminar</th><th>Modificar</th></tr>";
            foreach($res as $fila)
            {
            $sel2="SELECT count(*) from solicituts where solicituts.tastet_id=".$fila["id"].";"; 
            $res2=$con->query($sel2);
            $res2=$res2->fetch();
            echo "<tr><td><a href='javascript:cargar(".$fila["id"].")'>".$fila["nom"]."</a></td><td><a href='javascript:peticio(".$fila["id"].")'>".$res2[0]."</a></td><td><a title='eliminar tastet' href='zonaprivada.php?id_borrar=".$fila['id']."'><img class='eliminar' alt='eliminar tastet' src='vista/imatges/eliminar.png'></a></td><td><a title='editar tastet' href='editartastet.php?id=".$fila['id']."' ><img class='eliminar' alt='editar tastet' src=vista/imatges/modificar.png ></a></td></tr>";
            }
            echo "</table>";
            echo "<div id='resultado'></div>";
            
        }
        else 
        {
            echo "<h4>Ara mateix no ets responsable de cap curs</h4>";
            echo "<table>
            
            <tr><th colspan=4><button id='afegirtastet'><a href='afegirtastet.php?dni=".$_SESSION["dni"]."' title='afegir tastet'>Afegir Nou tastet</a></button>
            <tr><th>Nom del Tastet</th><th>Peticions</th><th>Eliminar</th><th>Modificar</th></tr></table>";
        }
        if(isset ( $_GET['id_borrar']))
        {
            $_SESSION["id_borrar"]=$_GET['id_borrar'];
            // borrar el tastet
            echo "<div id='confirmacion'><p>Segur que vols borrar aquest tastet?</p>";
            echo "<form method='post' action='zonaprivada.php'>";
            echo "<input type='radio' name='confirmar' value='si'>Sí<br>";
            echo "<input type='radio' name='confirmar' value='no' checked>No<br>";
            
            echo "<p><input type='submit' value='confirmar'></p>";
           
            echo "</form>";
            echo "</div>";
        }
            
        if(isset($_POST["confirmar"]))
        {
            if($_POST["confirmar"]==="si")
            {


         $sql = "UPDATE tastets set int_borrat = 'Si' where id='".$_SESSION['id_borrar']."';";
         $res=$con->exec($sql);
        
            }
         
            header ("Location:zonaprivada.php");
        } 
        
     }
?>
        </div>    
    </body>
</html>