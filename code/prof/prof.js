function moyennes(filiere)
{
    xhttp = new XMLHttpRequest();
    

        xhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("resultatStats").innerHTML = this.responseText;
            }

        };
        xhttp.open("POST", "stats.php", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.send("filiere="+filiere);

}    

function filiere(filiere)
{
    
    xhttp = new XMLHttpRequest();
    

    xhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("listEleveFiliere").innerHTML = this.responseText;
        }

    };
    xhttp.open("POST", "change.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("filiere="+filiere);

}   

function test()
{
    console.log(document.getElementById("listEleve").value);
    console.log(document.getElementById("spe").value);
    eleve = document.getElementById("listEleve").value;
    spe = document.getElementById("spe").value;
    xhttp = new XMLHttpRequest();
    


    xhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("filiereEleve").innerHTML = this.responseText;
        }

    };
    xhttp.open("POST", "changeFinal.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("eleve="+eleve+"&spe="+spe);
    
    
}   

function final()
{
    console.log(document.getElementById("option").value);
    console.log(document.getElementById("oldOption").value);
    option = document.getElementById("option").value;
    oldOption = document.getElementById("oldOption").value;
    fil = document.getElementById("filiere").value;
    eleve = document.getElementById("eleve").value;
    xhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("etat").innerHTML = this.responseText;
        }

    };
    xhttp.open("POST", "changementOption.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("option="+option+"&oldOption="+oldOption+"&fil="+fil+"&eleve="+eleve);
    
}


function Valider()
{
    xhttp = new XMLHttpRequest();
    

    xhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200) {
            window.alert(this.responseText);
            
        }

    };
    xhttp.open("GET", "confirmation.php", true); //jsp si on est obligé d'envoyer des trucs avec le GET
    xhttp.send();
}


function message(filiere)
{
    window.alert("Mariage stable effectué pour les "+filiere+".");
    
}