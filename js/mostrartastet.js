function cargar(id) {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function(){
        if(ajax.readyState==4){
            var datos = JSON.parse(ajax.responseText);
            mostrarLista(datos);
        }
    }
    ajax.open("get", "cargar.php?id="+id, true);
    ajax.send();
}

function mostrarLista(d){
    

    
    var res  = document.querySelector("#resultado");
    res.innerHTML="<span>Id: </span>"+d.id+"<br><span>Nom: </span>"+d.nom+"<br><span>Responsable: </span>"+d.responsable+"<br><span>DNI: </span>"+d.dni+"<br><span>Departament: </span>"+d.departament+"<br><span>Lloc: </span>"+d.lloc+"<br><span>Foto: </span><img alt='foto'  class='fototastet' src='"+d.foto+"'><br><span>Descripció: </span>"+d.descripcio+"<br><span>Comentaris Interns: </span>"+d.int_comentari+"<br><span>Nombre Màxim d'Alumnes per Sessió: </span>"+d.int_maxim_alu+"<br><span>Nivell mínim (o òptim) d&#39;edat o formació per fer el taller: </span>"+d.int_nivell+"<br><span>Períodes de l&#39;any en que està disponible: </span>"+d.int_dispany+"<br><span>Quantitat màxima de tallers en un any acadèmic: </span>"+d.int_max_tallers_any+"<br><span>Suggeriments i comentaris: </span>"+d.int_sugg+"<br>";
        
     
    
}