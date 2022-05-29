function getRandomInt(max) {
  return Math.floor(Math.random() * max);
}

function popup()
{
  let memes = ['http://ide.perso.eisti.fr/images/meme/FB_IMG_1603379068877.jpg', 'http://ide.perso.eisti.fr/images/meme/FB_IMG_1633586363675.jpg', 'http://ide.perso.eisti.fr/images/meme/code.jpg', 'http://ide.perso.eisti.fr/images/meme/FB_IMG_1634585807659.jpg', 'http://ide.perso.eisti.fr/images/meme/FB_IMG_1595858106610.jpg','http://ide.perso.eisti.fr/images/meme/FB_IMG_1603379027833.jpg', 'http://ide.perso.eisti.fr/images/meme/cotelf1qxem51.jpg', 'http://ide.perso.eisti.fr/images/meme/FB_IMG_1616618850067.jpg', 'http://ide.perso.eisti.fr/images/meme/FB_IMG_1630136333764.jpg', 'http://ide.perso.eisti.fr/images/meme/FB_IMG_1602319185874.jpg','http://ide.perso.eisti.fr/images/meme/css_meme.jpg', 'http://ide.perso.eisti.fr/images/meme/lol.jpg', 'http://ide.perso.eisti.fr/images/meme/FB_IMG_1595085874321.jpg', 'http://ide.perso.eisti.fr/images/meme/jack.jpg', 'http://ide.perso.eisti.fr/images/meme/ei.png','http://ide.perso.eisti.fr/images/meme/FB_IMG_1603745428295.jpg', 'http://ide.perso.eisti.fr/images/meme/FB_IMG_1606602264414.jpg', 'http://ide.perso.eisti.fr/images/meme/java.jpg', 'http://ide.perso.eisti.fr/images/meme/FB_IMG_1602107646849.jpg', 'http://ide.perso.eisti.fr/images/meme/strong.jpg','http://ide.perso.eisti.fr/images/meme/localhost.jpg'];
  Swal.fire({
    imageUrl: memes[getRandomInt(20)],
    //imageHeight: 1500,
    imageAlt: 'A really nice meme'
  })
}

function test()
{
    xhttp = new XMLHttpRequest();
    

        xhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {
                window.alert(this.responseText);
                document.getElementById("loading").classList.add("hidden");
            }
            else {

                document.getElementById("loading").classList.remove("hidden");

                //document.getElementById("meme").classList.remove("hidden");

            }

        };
    xhttp.open("GET", "createEleve.php", true); //jsp si on est obligé d'envoyer des trucs avec le GET
    xhttp.send();

}

function ticket(){


    bug=document.getElementById("bug").value;
    rowPost=document.getElementById("rowPost").value;


   xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {

        if (this.readyState == 4 && this.status == 200)
        {
            document.getElementById("actualisation").innerHTML = this.responseText; //renvoyer la meme fonction pour faire le tab en html avant + rajouter l'etat en gros faire presque comme dans le td9

        }


    };

    xhttp.open("POST", "ticket.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("bug="+bug+"&rowPost="+rowPost);

}
