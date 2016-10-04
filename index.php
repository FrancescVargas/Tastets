<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Llistat de Tastets</title> 
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
            <img id="logo" src="vista/imatges/logo2.jpg" alt="logo">
            <img src="vista/imatges/capcalera_recurs_8.jpg">
            <form method="post" action="zonaprivada.php" id="identificador">
                
                <input type="text" name="usuari" placeholder="usuari">
             
                <input type="password" name="dni" placeholder="password">
                <button type="submit">Accedir a la Zona Privada</button><br>
            </form>
            <H2>El Campus de la UPC a Vilanova i la Geltrú posa a la vostra disposició diferents laboratoris on el professorat especialitzat impartirà una classe pràctica, una demostració, ... on els alumnes podran participar activament.  Inscriviu-vos als tallers que més us interessin!</H2>
            
        </header>
        
    <div id="contenedor">
        
        <div id="video">
       <iframe width="316" height="178" src="https://www.youtube.com/embed/lpuGRjIfI9A?list=PL2vJzlefC7mDqZAEQllt0XNiZ6JLW7TvI" frameborder="0" allowfullscreen></iframe>
        <img src="vista/imatges/fes-tastet.jpg">
        </div>
        <?php
        
        
       $sel = "SELECT * from tastets";
      
        try{
            $con = new PDO('mysql:host=localhost;dbname=tastets', "root"); 
        }catch(PDOException $e){
            echo "<div class='error'>".$e->getMessage()."</div>"; 
            die();
        }
            
        $res = $con->query($sel); 
        echo "<table><tr><th colspan=2>Llistat de Tastets</th></tr>";
        foreach($res as $fila)
        {
            echo "<tr><td>".$fila["id"]."</td><td><a href='controlador.php/detallstastet?id=".$fila["id"]."'>".$fila["nom"]."</a></td></tr>";
        }
        echo "</table></div>";
        ?>
        
        