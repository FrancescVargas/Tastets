<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0">
        <title>Usuari <?php echo $_POST["dni"]; ?></title>
        <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
        <script>
            tinymce.init({
                selector: '#mytextarea'
                , menubar: "edit tools insert"
                , plugins: 'lists advlist autolink charmap code textcolor colorpicker emoticons media image paste searchreplace table fullscreen'
                , toolbar: "undo redo paste copy searchreplace fullscreen | styleselect bold italic forecolor backcolor | code charmap emoticons media image table"
            });
        </script>
 <link rel="stylesheet" type="text/css" href="css/estils.css">
    </head>
      
    <body>
          
      <header>
            <H1>FES UN TAST A L'ENGINYERIA</H1>
            <img id="logo" src="/Francesc/Tastets/vista/imatges/logo2.jpg" alt="logo">
            <img id="imatgeheader" src="/Francesc/Tastets/vista/imatges/capcalera_recurs_8.jpg">
            <button><a href="sortirzonaprivada.php">Sortir de la zona Privada</a></button><button><a href="zonaprivada.php">Torna a la teva pàgina d'Inici</a></button><br>
            
            
        </header>
        <div id="contenedor">
          <?php
            session_start();
             try
            {
                $con= new PDO('mysql:host=localhost;dbname=tastets', "root");
            }
        catch(PDOException $e)
            {
                echo "Error:".$e->getMessage(); 
                die();
            }
            
        
        if(isset($_GET["dni"]))
        {    
           
            
         

        echo "<h2>Ara pots afegir un Tastet nou</h2>";
        echo "<form id='formmodificar' method='post' action='afegirtastet.php' enctype='multipart/form-data'>";
        
        echo "<label>Nom</label> <br><input class='inputlong' type='text' name='nom'><br>";
        echo "<label>Responsable</label> <br><input type='text' name='responsable' value='".$_GET["responsable"]."'><br>";
        echo "<label>DNI</label> <br><input type='text' name='dni' value='".$_GET["dni"]."' ><br>";
        echo "<label>Departament</label> <br><input type='text' name='departament'><br>";
        echo "<label>Lloc</label> <br><input type='text' name='lloc'><br>";
        echo "<label>Foto</label><br><input type='file' name='foto'><br>";
        echo "<label>Descripció</label><br><textarea id='mytextarea' rows='8' cols='60' name='descripcio' ></textarea><br>";
        echo "<p><input type='submit' value='afegir'></p></form>";

        }
            
        if(isset($_POST["nom"]))
        {
            
               if($_FILES['foto']['name']!=="")
                    {
                       
                        $target_path = "vista/imatges/".$_FILES['foto']['name'];
                        $f=$target_path;
                        if(!move_uploaded_file($_FILES['foto']['tmp_name'], $target_path))
                        {

                            echo "";

                        } 
                        $sql = "INSERT INTO `tastets` (`nom`, `responsable`, `dni`, `departament`, `lloc`, `descripcio`, `foto`) VALUES ('".$_POST["nom"]."', '".$_POST["responsable"]."', ".$_POST["dni"].", '".$_POST["departament"]."', '".$_POST["lloc"]."', '".$_POST["descripcio"]."', '$f');";
                   
                    }

                   
             
                 else
                 {
                    
                   $sql = "INSERT INTO `tastets` (`nom`, `responsable`, `dni`, `departament`, `lloc`, `descripcio`) VALUES ('".$_POST["nom"]."', '".$_POST["responsable"]."', ".$_POST["dni"].", '".$_POST["departament"]."', '".$_POST["lloc"]."', '".$_POST["descripcio"]."');";
                     
                 }
                 
                
            $res=$con->exec($sql); 
                 header ("Location:zonaprivada.php");
             
            
        }
            
            
        ?>    
            
        
            
            
            
        </div>
    </body>
</html>