<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>crear bd Contactos</title>
        <link href="estilos.css" rel="stylesheet">
       
    </head>
    <body>
        <h1>INSTALACION</h1>
        
        <?php
        
          try
            {
                $conexion = new PDO('mysql:host=localhost', "root");
            }
          catch(PDOException $e)
            {
                echo "Error:".$e->getMessage(); 
                die();
            }
        
        // borramos la base de datos antes que nada para no tener que borrarla en myadmin
        
        
          $sql="drop database if exists tastets;";
          $res=$conexion->exec($sql);
          
        
        // creamos la base de datos cinemania
        
          $sql="create database tastets;";
          $res=$conexion->exec($sql); //exec nos devuelve el número de filas afectadas o "false" (o "0") si no ha podido crear la BD
          if($res===FALSE)
              {
                  echo "<p>No se ha podido crear la base de datos</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Base de Datos creada</p>";
              }
          
          // nos conectamos a la base de datos que hemos creado
        
          $sql="use tastets;";
        
          $res=$conexion->exec($sql); 
          if($res===FALSE)
              {
                  echo "<p>No se ha podido crear la base de datos</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Conectados a 'tastets'</p>";
              }
        
        
         //creamos tabla tastets
        
          $sql=<<<sql
create table tastets(
	id int primary key auto_increment,
    nom varchar(60) not null unique,
    responsable varchar(40),
    dni varchar(10),
    departament varchar(40),
    lloc varchar(40),
    descripcio text,
    foto varchar(140)
    
	
	
);
sql;
       $res=$conexion->exec($sql); 
          if($res===FALSE)
              {
                  echo "<p>No se ha podido crear la tabla tastets</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Tabla tastets creada!!!</p>";
              }
         
        
       //insertamos en tastets
        
         $sql=<<<sql
          
INSERT INTO `tastets` (`nom`, `responsable`,`dni`,`departament`,`lloc`,`descripcio`,`foto`) VALUES ('Assaigs destructius de caracterització de materials','Josep A. Picas','40554565-Q','Dept.de Ciència de materials i enginyeria metal de Ciència de materials i enginyeria metal·lúrgica','AL002 –Lab. Mesures Elèctriques ','Per tal de donar a conèixer les activitats del
departament es proposa una visita a les seves
instal·lacions, on es realitzaran diferents assaigs de
caracterització de materials. Abans de cada assaig
es farà un breu resum de la funcionalitat del mateix
i descripció dels paràmetres obtinguts. Els assaigs
proposats són els següents:
• Assaig de tracció.
• Assaig d’impacte mitjançant pèndul
Charpy.
• Assaig de duresa.
• Assaig d’ultramicroduresa.
Es realitzarà un recorregut per les instal·lacions de
corrosió i es visitarà la cambra de boira salina i
s’explicaran els assajos potencio-dinàmics per a
la determinació de la resistència de materials a la corrosió. S’observaran mostres
en el microscopi electrònic d’escombrat (SEM) a les instal·lacions del CTVG. 
','vista/imatges/tastet1.jpg'),('Aplicacions de l\'extensiometria elèctrica','Victòria Ismael','40553265-R','Dept. de Resistència de materials i estructures a l\'enginyeria','AL012 –Laboratori Laboratori Laboratori Mecànica i Resistència de Materials Mecànica i Resistència de Materials Mecànica i Resistència de Materialsde l’EPSEVG','• L’extensiometria elèctrica és una tècnica experimental d’anàlisi de
tensions. Donar a conèixer a l’estudiant els principis fonamentals
d’aquesta tècnica.
• Enganxar una galga a una llauna de refresc i mesurar les deformacions
que pateix quan es sotmet a sol·licitacions estàtiques i dinàmiques.
• Sotmetre provetes del laboratori a esforços de tracció, compressió i flexió i
mesurar les deformacions que pateixen.
• Aplicar forces de tracció utilitzant una relació de braç de palanca de 1 a 10
en el banc d’aplicació de càrregues.
• Realitzar i analitzar totes les possibles connexions al pont de Wheatstone. 
','vista/imatges/tastet2.jpg');
sql;
        
          $res=$conexion->exec($sql); 
          if($res===FALSE)
              {
                  echo "<p>Error al añadir datos en tastets</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Se han añadido $res filas en la tabla tastets</p>";
              } 
           
        
        // creamos tabla solicituts
        
           $sql=<<<sql
create table solicituts(
	id int primary key auto_increment,
    tastet_id int,
    nom_i_cognoms varchar(40),
    centre varchar(60),
    email varchar(60),
    telefon varchar(20),
    comentari text,
    foreign key (tastet_id) references tastets(id) ON DELETE SET NULL ON UPDATE CASCADE
);
sql;
        
          $res=$conexion->exec($sql); 
          if($res===FALSE)
              {
                  echo "<p>No se ha podido crear la tabla solicituts</p>";
                  echo "<p>".$conexion->errorInfo()[2]."</p>";
              }
          else
              {
                  echo "<p>Tabla solicituts creada!!!</p>";
              }
        
        
     
     
        
         
          
     
        ?>
    </body>
</html>