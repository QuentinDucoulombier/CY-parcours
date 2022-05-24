function envoyer(){
																
    titre=document.getElementById("titre").value;	  
    description=document.getElementById("description").value;	    
                                                                          
                                                                                    
   xhttp = new XMLHttpRequest(); 
                                                                                     
    xhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) 
        {		
            document.getElementById("etat").innerHTML = this.responseText;
        }
    };
                                                                                      
    xhttp.open("POST", "envoie.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("titre="+titre+"&description="+description);
                                                                                 
}