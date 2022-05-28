function moyennes(filiere)
{
    xhttp = new XMLHttpRequest();
    

        xhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("stats").innerHTML = this.responseText;
            }

        };
        xhttp.open("POST", "stats.php", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.send("filiere="+filiere);

}    
