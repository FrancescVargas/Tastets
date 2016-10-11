function cargar(id) {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function(){
        if(ajax.readyState==4){
            var datos = JSON.parse(ajax.responseText);
            mostrarLista(datos);
        }
    }
    ajax.open("get", "ajax-cargar.php?id="+id, true);
    ajax.send();
}



function mostrarLista(d){
    

    
    var res  = document.querySelector("#resultado"); 
    res.innerHTML="<h4>Detalls Tastet "+d.nom+"</h4><table id='tablecargar'><tr><td><img alt='foto'  class='fototastet' src='"+d.foto+"'><span>Id: </span>"+d.id+"<br><span>Nom: </span>"+d.nom+"<br><span>Responsable: </span>"+d.responsable+"<br><span>DNI: </span>"+d.dni+"<br><span>Departament: </span>"+d.departament+"<br><span>Lloc: </span>"+d.lloc+"<br></td><tr><td><span>Descripció: </span>"+d.descripcio+"<br></td></tr><tr><td><span>Comentaris Interns: </span>"+d.int_comentari+"<br></td></tr><tr><td><span>Nombre Màxim d'Alumnes per Sessió: </span>"+d.int_maxim_alu+"<br><span>Nivell mínim (o òptim) d&#39;edat o formació per fer el taller: </span>"+d.int_nivell+"<br><span>Períodes de l&#39;any en que està disponible: </span>"+d.dispany.disp+"<br><span>Quantitat màxima de tallers en un any acadèmic: </span>"+d.int_max_tallers_any+"<br></td></tr><tr><td><span>Suggeriments i comentaris: </span>"+d.int_sugg+"<br></td></tr></table>";
     
    
}


function peticio(id) {
 

 var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function(){
        if(ajax.readyState==4){
            var datos = JSON.parse(ajax.responseText);
            mostrarPeticions(datos);
        }
    }
    ajax.open("get", "ajax-peticions.php?id="+id, true);
    ajax.send();
}



function mostrarPeticions(d){
    

    
    var res  = document.querySelector("#resultado"); 
    var cad="";
    
    if(typeof d=="object")
    {
        cad+="<h4>Detalls Peticions</h4><table id='tablecargar'><tr>";
         for(j in d[0])
                    {
                        cad+="<th>"+j+"</th>";
                    }
        cad+="<th>Detalls Tastet Realitzat</th>"
        cad+="</tr>";
        for(i in d)
            {
               cad+="<tr>";
                for(j in d[i])
                {
                    cad+="<td>"+d[i][j]+"</td>";
                }
                if(d[i]["realitzada"]=="1") cad+="<td><a href='editartastetfet.php?id_activitat="+d[i]["activitat_id"]+"&id_solicitut="+d[i]["id"]+"'>Edita Detalls</a></td>";
                if(d[i]["realitzada"]=="0") cad+="<td><a href='afegirtastetfet.php?id_activitat="+d[i]["activitat_id"]+"&id_solicitut="+d[i]["id"]+"'>Afegeix Detalls</a></td>";
                
            cad+="</tr>";
            }
        cad+="</table>";
    }
    if(typeof d=="string") 
    {
        cad+="<h4>No hi han peticions</h4>";
    }
    
    res.innerHTML=cad;
     
    
}