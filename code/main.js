function connex(){
																
    pseudo=document.getElementById("pseudo").value;	  
    password=document.getElementById("password").value;	    
    console.log(pseudo);
    console.log(password);
                                                                          
                                                                                    
   xhttp = new XMLHttpRequest(); 
                                                                                     
    xhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) 
        {		
            document.getElementById("etat").innerHTML = this.responseText;
        }
    };
                                                                                      
    xhttp.open("POST", "verifConnexion.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("pseudo="+pseudo+"&password="+password);
                                                                                 
}
/*Ca marche pas dans l'idéé j'aurais bien fait un input hyde mais jsp si ca marche*/