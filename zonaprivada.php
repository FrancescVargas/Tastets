<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Usuari <?php echo $_POST["dni"]; ?></title>
          <style>
        body
            {
                width: 75%;
                margin: auto;
            }
        header
            {
                margin-bottom: 30px;
            }
        header h1
            {
                display: inline-block;
                width: 70%;
            }
        #imatgeheader
            {
                width: 100%;
            }
        #logo
            {
                float: right;
                margin: 20px 0;
                width: 30%;
            }
        #identificador input,button
            {
                font-size: 0.6em;
                text-align: left;  
            }


        table,th,td
        {
        border: 1px solid black;
            }
        #video
            {
                float: right;
            }
        iframe
            {
                display: block;
            }
        #detalls
            {
                border:2px solid blue;
                border-radius: 50px;
                margin: 10px;
                width: 50%;
                text-align: center;
            }
        #fotodesc
            {
                float: right;
            }
        
        #forminscripcio
            {
                float: right;
                
                
            }
        #formescondido
            {
               
                box-shadow: 10px 10px 10px blue;
                margin-top: 20px;
                border: 1px solid blue;
                display:none;
            }
        #cargarform
            {
                float: right;
                
                margin: 5px;
            }
        input, label, textarea
            {
                margin: 0 5px;
            }
        
        </style>
    </head>
      
    <body>
          
      <header>
            <H1>FES UN TAST A L'ENGINYERIA</H1>
            <img id="logo" src="/Francesc/Tastets/vista/imatges/logo2.jpg" alt="logo">
            <img id="imatgeheader" src="/Francesc/Tastets/vista/imatges/capcalera_recurs_8.jpg">
            <button><a href="sortirzonaprovada.php">Sortir de la zona Privada</a></button><br>
            
            
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
        
        
        echo "<h3>Usuari ".$_SESSION["usuari"]."</h3>";
    
        if(count($res)>0)
        {    
            
            
            echo "<h4>Administració Tastets Propis</4>";
            foreach($res as $fila)
            {
            $sel2="SELECT count(*) from solicituts where solicituts.tastet_id=".$fila["id"].";"; 
            $res2=$con->query($sel2);
            $res2=$res2->fetch();
            echo $fila["nom"]."-->Numero Peticions -->".$res2[0]."<br>";
            }
        }
        else echo "<h4>Ara mateix no ets responsable de cap curs</h4>";
        
     }
?>
        </div>    
    </body>
</html>