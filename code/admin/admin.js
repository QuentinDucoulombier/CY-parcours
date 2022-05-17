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
            document.getElementById("actualisation").innerHTML = this.responseText; //renvoyer la meme fonction pour faire le tab en html avant + rajouter l'etat en gros faire presque comme dans le td9
        }
    };
    console.log(bug);
                                                                                      
    xhttp.open("POST", "ticket.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("bug="+bug);
                                                                                 
}