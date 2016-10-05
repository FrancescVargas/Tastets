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
            <button><a href="sortirzonaprovada.php">Sortir de la zona Privada</a></button><br>
            
            
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
            
             if(isset($_GET['id']))
             {
                 $sel = "SELECT * FROM tastets WHERE tastets.id =".$_GET['id']."";
                 $res = $con->query($sel);
                   $res=$res->fetch();
                   

                 echo "<h2>Ara pots editar les dades del tastet ".$res["nom"]."</h2>";

                  echo "<form id='formmodificar' method='post' action='editartastet.php' enctype='multipart/form-data'>";
                echo "<input type='hidden' name='id' value='${res['id']}'><br>";
                echo "<label>Nom</label> <br><input type='text' name='nom' value='${res['nom']}'><br>";
                echo "<label>Responsable</label> <br><input type='text' name='responsable' value='${res['responsable']}'><br>";
                echo "<label>DNI</label> <br><input type='text' name='dni' value='${res['dni']}'><br>";
                echo "<label>Departament</label> <br><input type='text' name='departament' value='${res['departament']}'><br>";
                echo "<label>Lloc</label> <br><input type='text' name='lloc' value='${res['lloc']}'><br>";
                echo "<label>Foto</label><br><img alt='foto'  class='fototastet' src='${res['foto']}'><input type='file' name='foto' ><br>";
                echo "<label>Descripció</label><br><textarea id='mytextarea' rows='8' cols='60' name='descripcio' > ${res['descripcio']}</textarea><br>";

                echo "<p><input type='submit' value='modificar'></p></form>";
      
             }
            
            
             if(isset($_POST['id']))
             {
   
                if($_FILES['foto']['name']!=="")
                    {

                        $target_path = "vista/imatges/".$_FILES['foto']['name'];
                        $f=$target_path;
                        if(!move_uploaded_file($_FILES['foto']['tmp_name'], $target_path))
                        {
                            echo "";
                        } 
                        $sql= "UPDATE tastets SET nom = '".$_POST["nom"]."', responsable = '".$_POST["responsable"]."', dni = ".$_POST["dni"].", departament = '".$_POST["departament"]."', lloc = '".$_POST["lloc"]."', descripcio = '".$_POST["descripcio"]."', foto = '".$f."' WHERE tastets.id =".$_POST["id"].";";
                    }

                   
             
                 else
                 {
                   $sql= "UPDATE tastets SET nom = '".$_POST["nom"]."', responsable = '".$_POST["responsable"]."', dni = ".$_POST["dni"].", departament = '".$_POST["departament"]."', lloc = '".$_POST["lloc"]."', descripcio = '".$_POST["descripcio"]."' WHERE tastets.id =".$_POST["id"].";";
                 }
                 
                 $res=$con->exec($sql); 
                header ("Location:zonaprivada.php");
            
             }
                
            
            
        ?>    
            
        
            
            
            
        </div>
    </body>
</html>