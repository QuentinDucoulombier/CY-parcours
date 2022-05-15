function test()
{
    xhttp = new XMLHttpRequest();
    xhttp = new XMLHttpRequest(); 
                                                                                            
        xhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {		
                window.alert(this.responseText);
            }
               
        };
    xhttp.open("GET", "createEleve.php", true); //jsp si on est obligé d'envoyer des trucs avec le GET
    xhttp.send();

}

function ticket(){
																
    bug=document.getElementById("bug").value;                                  
                                                                                    
   xhttp = new XMLHttpRequest(); 
                                                                                     
    xhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) 
        {		
            document.getElementById("etat").innerHTML = this.responseText;
        }
    };
                                                                                      
    xhttp.open("POST", "ticket.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("bug="+bug);
                                                                                 
}