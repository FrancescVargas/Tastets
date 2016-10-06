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
            <button><a href="sortirzonaprivada.php">Sortir de la zona Privada</a></button>
            <button><a href="zonaprivada.php">Torna a la teva pàgina d'Inici</a></button>
            <br>
            
            
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
                 echo "<fieldset><legend>Informació Pública:</legend><br>";
                echo "<input type='hidden' name='id' value='${res['id']}'><br>";
                echo "<label>Nom</label> <br><input type='text' class='inputlong' name='nom' value='${res['nom']}'><br>";
                echo "<label>Responsable</label> <br><input type='text' name='responsable' value='${res['responsable']}'><br>";
                echo "<label>DNI</label> <br><input type='text' name='dni' value='${res['dni']}'><br>";
                echo "<label>Departament</label> <br><input type='text' name='departament' value='${res['departament']}'><br>";
                echo "<label>Lloc</label> <br><input type='text' name='lloc' value='${res['lloc']}'><br>";
                echo "<label>Foto</label><br><img alt='foto'  class='fototastet' src='${res['foto']}'><input type='file' name='foto' ><br>";
                echo "<label>Descripció</label><br><textarea id='mytextarea' rows='8' cols='60' name='descripcio' > ${res['descripcio']}</textarea><br>";
                echo "</fieldset>";
                 
                 
                 echo "<fieldset><legend>Informació Interna:</legend><br>";
                
                echo "<label>Comentaris Generals</label> <br><textarea  rows='8' cols='60' name='int_comentari' > ${res['int_comentari']}</textarea><br>";
                echo "<label>Nombre Màxim d'Alumnes per Sessió</label> <br><input type='number' name='int_maxim_alu' class='inputshort' value='${res['int_maxim_alu']}'><br>";
                echo "<label>Nivell mínim (o òptim) d&#39;edat o formació per fer el taller:</label> <br><input type='text' name='int_nivell' value='${res['int_nivell']}'><br>";
                echo "<label>Períodes de l&#39;any en que està disponible:</label> <br><input type='text' name='int_dispany' value='${res['int_dispany']}'><br>";
                echo "<label>Quantitat màxima de tallers en un any acadèmic:</label> <br><input type='number' class='inputshort' name='int_max_tallers_any' value='${res['int_max_tallers_any']}'><br>";
            
                echo "<label>Suggeriments i comentaris:</label><br><textarea rows='8' cols='60' name='int_sugg' > ${res['int_sugg']}</textarea><br>";
                echo "</fieldset>";

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
                        $sql= "UPDATE tastets SET nom = '".$_POST["nom"]."', responsable = '".$_POST["responsable"]."', dni = '".$_POST["dni"]."', departament = '".$_POST["departament"]."', lloc = '".$_POST["lloc"]."', descripcio = '".$_POST["descripcio"]."', foto = '".$f."', int_comentari= '".$_POST["int_comentari"]."', int_maxim_alu= '".$_POST["int_maxim_alu"]."', int_nivell= '".$_POST["int_nivell"]."', int_dispany= '".$_POST["int_dispany"]."', int_max_tallers_any= '".$_POST["int_max_tallers_any"]."', int_sugg= '".$_POST["int_sugg"]."' WHERE tastets.id =".$_POST["id"].";";
                    }

                   
             
                 else
                 {
                   $sql= "UPDATE tastets SET nom = '".$_POST["nom"]."', responsable = '".$_POST["responsable"]."', dni = '".$_POST["dni"]."', departament = '".$_POST["departament"]."', lloc = '".$_POST["lloc"]."', descripcio = '".$_POST["descripcio"]."', int_comentari= '".$_POST["int_comentari"]."', int_maxim_alu= '".$_POST["int_maxim_alu"]."', int_nivell= '".$_POST["int_nivell"]."', int_dispany= '".$_POST["int_dispany"]."', int_max_tallers_any= '".$_POST["int_max_tallers_any"]."', int_sugg= '".$_POST["int_sugg"]."' WHERE tastets.id =".$_POST["id"].";";
                 }
                 
                 $res=$con->exec($sql); 
                header ("Location:zonaprivada.php");
                
            
             }
                
            
            
        ?>    
            
        
            
            
            
        </div>
    </body>
</html>