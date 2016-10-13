<?php
require "vendor/autoload.php";


$app=new Slim\App();
$c=$app->getContainer(); 

$c["bd"]=function()  
{
    $pdo=new PDO("mysql:host=localhost;dbname=activitats","root");
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC); 
    return $pdo;
};


$c["view"]=new \Slim\Views\PhpRenderer("vista/"); 

$app->get("/detallsactivitat",function($request,$response,$args)  // sacamos el listado de la búsqueda
          {
              $con=$this->bd; 
              $params=$request->getQueryParams();
              $sql="SELECT * from activitats where activitats.id=".$params['id'].";";
              $res1=$con->query($sql);
             
              $datos= $res1->fetch();
              
              
             
              $response=$this->view->render($response,"plantillatastet.php",$datos); 
              return $response;
            
          });


$app->post("/publicoment", function($request,$response,$args)
          {
               try{
                $con = new PDO('mysql:host=localhost;dbname=activitats', "root"); 
            }catch(PDOException $e){
                echo "<div class='error'>".$e->getMessage()."</div>"; 
                die();
            }
            $con=$this->bd;
            $params=$request->getParsedBody();
            
            $sql="insert into solicituts(estuaprox,centre,comentari,email,nom_i_cognoms,activitat_id,telefon) values('${params["estuaprox"]}','${params["centre"]}','${params["comentari"]}','${params["email"]}','${params["nomicognoms"]}','${params["id_activitat"]}','${params["telefon"]}');";
            $res=$con->exec($sql);
            
            $to      = $params["email"];
            $subject = 'Sol.licitut Tastet EPSEV';
            $message = $params["nomicognoms"].', gràcies per enviar-nos la sol.licitud per a aquest tastet. En breu ens posarem en contacte amb tu';
            $headers = 'From: Escola Politècnica Superior d\'Enginyeria de Vilanova i la Geltrú' . "\r\n" .
            'Reply-To: fravase76@gmail.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
              
            return $response->withRedirect('/Francesc/Tastets/controlador.php/detallsactivitat?id='.$params['id_activitat'].'&inscrit=si');
              
              
          });
          

$app->run();
?>