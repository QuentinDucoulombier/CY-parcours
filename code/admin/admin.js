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