<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Detalls Tastet</title>
        <link rel="stylesheet" type="text/css" href="/Francesc/Tastets/css/estils.css">
    </head>
      
    <body>
          
      <header>
            <H1>FES UN TAST A L'ENGINYERIA</H1>
            <img id="logo" src="/Francesc/Tastets/vista/imatges/logo2.jpg" alt="logo">
            <img id="imatgeheader" src="/Francesc/Tastets/vista/imatges/capcalera_recurs_8.jpg">
            <form method="post" action="/Francesc/Tastets/zonaprivada.php" id="identificador">
                
                <input type="text" name="usuari" placeholder="usuari">
             
                <input type="password" name="dni" placeholder="password">
                <button type="submit">Accedir a la Zona Privada</button><br>
            </form>
            
        </header>
        
    <div id="contenedor">
        
   
       
        
    <?php
   
     
      
        
        echo "<div id='descripcio'><img id='fotodesc' src='/Francesc/Tastets/".$data["foto"]."'><h2>".$data["nom"]."</h2><p>
        ".$data["descripcio"]."</p></div>";
        
        
         echo '<div id="forminscripcio">';
         if(!isset($_GET["inscrit"]))
        { 
               echo '<button id="cargarform" onclick="cargarform()" >Formulari Inscripció</button><br>
                <form id="formescondido" method="post" action="/Francesc/Tastets/controlador.php/publicoment">

                <input type="hidden" name="id_tastet" value="'.$data["id"].'">
                <label>Nom i Cognoms: </label><br><input type="text" name="nomicognoms"><br>
                <label>Centre: </label><br><input type="text" name="centre"><br>
                <label>Email: </label><br><input type="email" name="email"><br>
                <label>Telèfon: </label><br><input type="tel" name="telefon"><br>
                <label>Comentari: </label><br><textarea rows="5" cols="40" name="comentari"> </textarea><br>

                 <p><input type="submit" value="confirmar"></p>
                 </form>
                 </div>';
       }
        else
        {
            echo "<h3>La inscripció s'ha realitzat amb éxit</h3></div>";
        }
        echo "<div id='detalls'>
        <h3>Responsable: ".$data["responsable"]."<br>".
        $data["departament"]."<br>
        Lloc: ".$data["lloc"]."</h3></div>";
        
        
        
        
        
        
        
        
       
        
        ?> 
        
        
   
        </div>  
        
        <script>
            var i=0;
            function cargarform()
            {
                i+=1;
                var x=document.getElementById("formescondido");
                if(i%2!==0) x.style.display="inline-block";
                else x.style.display="none";
            }
        </script>
    
    </body>




</html>