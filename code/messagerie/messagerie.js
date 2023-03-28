//variables globales
var id_dernier_message = -1; // id du dernier message traité par la fonction recup_messages
var is_blocked = 0;


const annuler_signal = () => {document.getElementById("signalement").classList.add("hidden");}

const envoyer_signal = (e) => {
    document.getElementById("signalement").classList.add("hidden");

    var les_boutons = document.getElementById("les-boutons");
    les_boutons.children[0].removeEventListener("click",envoyer_signal);

    var id = e.currentTarget.parametre;
    var motif = document.getElementById("motif").value;
    var description = document.getElementById("description").value;


    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          if(this.responseText != 1){
            alert("Impossible du supprimer le message");
          }
        }
    }

    xhttp.open("POST", "../messagerie/nouv_ticket_signal.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("id="+id +"&motif="+motif +"&description="+description);
}

//fonction qui fait apparaitre le bouton suprimer ou signaler
const plus_menu = (obj) =>{
    obj.stopPropagation();

    var clicked_button_message = obj.composedPath().reverse()[8] ;


    var clicked_button_message_id = clicked_button_message.children[3].innerHTML;


    var signalement = document.getElementById("signalement");
    var option_plus = document.getElementById("option-plus");

    var supp_button = option_plus.children[0];
    var signal_button = option_plus.children[1];

    let posx = obj.x //clicked_button.getBoundingClientRect().left;
    let posy = obj.y     //clicked_button.getBoundingClientRect().top;

    option_plus.classList.remove("hidden");
    option_plus.style.left = (posx-77) +"px";
    option_plus.style.top = posy+"px";

    function supp_button_event(e){

        var xhttp = new XMLHttpRequest();

        xhttp.open("POST", "../messagerie/supp_message.php", true);
        xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhttp.send("id="+clicked_button_message_id);

        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
              console.log(this.responseText);
                if(this.responseText != 1){
                  alert("Impossible du supprimer le message");
                }else{
                  id_dernier_message =-1;
                  recup_messages();
                }
            }
        };

        supp_button.removeEventListener("click",supp_button_event);
    }

    function signal_button_event(e){
        // TODO : faire un ajax pour creer le ticket de signalement
        signalement.classList.remove("hidden");
        var les_boutons = document.getElementById("les-boutons");


        les_boutons.children[0].addEventListener("click",envoyer_signal);
        les_boutons.children[0].parametre = clicked_button_message_id;


        signal_button.removeEventListener("click",signal_button_event);
    }


    if(clicked_button_message.classList[1] == 'envoye'){
        supp_button.classList.remove("hidden");
        signal_button.classList.add("hidden");

        supp_button.addEventListener("click",supp_button_event);

    }else if(clicked_button_message.classList[1] == 'recu'){
        supp_button.classList.add("hidden");
        signal_button.classList.remove("hidden");

        signal_button.addEventListener("click",signal_button_event);
    }



    //Pour faire disparaitre le bouton quand on click à coté
    document.addEventListener("click",function supp_plus_menu(e){
        if(!(e.target == (option_plus))){
            option_plus.classList.add("hidden");
        }
        //option_plus.classList.add("hidden");
        document.removeEventListener("click",supp_plus_menu);
        supp_button.removeEventListener("click",supp_button_event);
        signal_button.removeEventListener("click",signal_button_event);
    });

    //console.log(posx,posy);
}

/* Affiche le message dans la div#message-zone
 * statut : le statut de message (envoyé ou reçu)
 * message : les infos du message :
 *    - "auteur" : info de l'auteur ("nom","prenom","adresse_mail","statut"),
 *    - "destinataire" : info du destinataire ("nom","prenom","adresse_mail","statut"),
 *    - "id" : id,
 *    - "infos" : infos du message ("date" , "heure"),
 *    - "message":texte du message,
 *    - "supprime" : booleen si le message est supprimé.
 */
const afficher_message = (statut, message) => {

    let message_zone = document.getElementById("message-zone");

    let nv_message = document.createElement("div");
    nv_message.classList.add("message");
    nv_message.classList.add(statut);

    let id = document.createElement("p");
    id.classList.add("hidden");
    id.innerHTML = message["id"];


    let prem_ligne = document.createElement("div");
    prem_ligne.classList.add("premiere-ligne");

    let p_auteur = document.createElement("p");
    p_auteur.classList.add("auteur");
    p_auteur.innerHTML = message["auteur"]["nom"] + " " + message["auteur"]["prenom"];

    prem_ligne.appendChild(p_auteur );

    let plus = document.createElement("div");
    plus.classList.add("plus");
    plus.innerHTML = "<div></div><div></div><div></div>";



    let p_infos = document.createElement("p");
    p_infos.classList.add("infos");
    p_infos.innerHTML = message["infos"]["date"] + " " + message["infos"]["heure"];

    let p_text = document.createElement("p");
    p_text.classList.add("text");
    if(!message["supprime"]){
        p_text.innerHTML = message["message"];

        plus.addEventListener("click",plus_menu);
        prem_ligne.appendChild(plus);
    }else{
        p_text.innerHTML = "<i>Message supprimé.</i>";


    }

    nv_message.appendChild(prem_ligne);
    nv_message.appendChild(p_infos);
    nv_message.appendChild(p_text);
    nv_message.appendChild(id);

    message_zone.appendChild(nv_message);
}

/*  Recupère les messages envoyés et reçus
 *
 */
const recup_messages = () => {
    if(id_dernier_message == -1){
      document.getElementById("message-zone").innerHTML = "";
    }

    if(!is_blocked){
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                JSON.parse(this.responseText).forEach(message => {
                    id = message["message"]["id"];

                    if(id > id_dernier_message){

                    afficher_message(message["statut"], message["message"]);

                    id_dernier_message = id;
                    }
                });
            }
        };

        xhttp.open("GET", "../messagerie/fetch_message.php", true);
        xhttp.send();
    }else{
        document.getElementById("message-zone").innerHTML = "Cet utilisateur est bloqué";
    }

}


/*  Change l'interlocuteur et verifie s'il est bloqué
 *
 */
const nouv_autre = (nom,prenom,mail,statut) => {

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            is_blocked = parseInt(this.responseText);
            var button_bloque = document.getElementById("button-bloque");
            var button_debloque = document.getElementById("button-debloque");

            if(is_blocked){

                button_bloque.classList.add("hidden");
                button_debloque.classList.remove("hidden");
            }else{
                button_bloque.classList.remove("hidden");
                button_debloque.classList.add("hidden");
            }
            id_dernier_message = -1;
            recup_messages();
        }
    }

    xhttp.open("POST", "../messagerie/nouv_autre.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("nom="+nom +"&prenom="+prenom +"&mail="+mail +"&statut="+statut);
}


/*
 *
 */
const nouveau_message = () => {
    let message_text = document.getElementById("message-text").value;
    if(!is_blocked){
      var xhttp = new XMLHttpRequest();


      xhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
              console.log(this.responseText);
              recup_messages();
          }
      };

      xhttp.open("POST", "../messagerie/nouv_message.php", true);

      xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhttp.send("message=" + message_text);
    }

}

const bloquer_utilisateur = ()=>{
    var button_bloque = document.getElementById("button-bloque");
    var button_debloque = document.getElementById("button-debloque");


    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            button_bloque.classList.add("hidden");
            button_debloque.classList.remove("hidden");
            is_blocked = 1;


            id_dernier_message = -1;
            recup_messages();
        }
    };

    xhttp.open("GET", "../messagerie/bloquage.php", true);

    xhttp.send();
}

const debloquer_utilisateur = ()=>{
    var button_bloque = document.getElementById("button-bloque");
    var button_debloque = document.getElementById("button-debloque");

    var xhttp = new XMLHttpRequest();


    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // console.log(this.responseText);
            button_bloque.classList.remove("hidden");
            button_debloque.classList.add("hidden");
            is_blocked = 0;

            id_dernier_message = -1;
            recup_messages();
        }
    };

    xhttp.open("GET", "../messagerie/debloquage.php", true);

    xhttp.send();
}
