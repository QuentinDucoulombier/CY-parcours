//test present sur le site d'ines pour Gale/Shapley algorithme https://rosettacode.org/wiki/Stable_marriage_problem#JavaScript

function Person(name, moyenne ,mail) {

    var candidateIndex = 0;

    this.moyenne = moyenne;
    this.mail = mail;
    this.name = name;
    this.fce = null;
    this.candidates = [];

    this.rank = function(p) {
        for (i = 0; i < this.candidates.length; i++)
            if (this.candidates[i] === p) return i;
        return this.candidates.length + 1;
    }

    this.prefers = function(p) {
        return this.rank(p) < this.rank(this.fce);
    }

    this.nextCandidate = function() {
        if (candidateIndex >= this.candidates.length) return null;
        return this.candidates[candidateIndex++];
    }

    this.engageTo = function(p) {
        if (p.fce) p.fce.fce = null;
        p.fce = this;
        if (this.fce) this.fce.fce = null;
        this.fce = p;
    }

    this.swapWith = function(p) {
        console.log("%s & %s swap partners", this.name, p.name);
        var thisFce = this.fce;
        var pFce = p.fce;
        this.engageTo(pFce);
        p.engageTo(thisFce);
    }
}

function isStable(eleves, spe) {
    for (var i = 0; i < eleves.length; i++)
        for (var j = 0; j < spe.length; j++)
            if (eleves[i].prefers(spe[j]) && spe[j].prefers(eleves[i]))
                return false;
    return true;
}

function engageBIryone(eleves) {
    var done;
    do {
        done = true;
        for (var i = 0; i < eleves.length; i++) {
            var guy = eleves[i];
            if (!guy.fce) {
                done = false;
                var gal = guy.nextCandidate();
                if (!gal.fce || gal.prefers(guy))
                    guy.engageTo(gal);
            }
        }
    } while (!done);
}



function create_array_spe(filiere, callback){
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200) {
        callback(this.responseText, filiere);
      }

    };

  xhttp.open("POST", "../mariageStable/recup_nb_place.php", true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send("filiere="+filiere);

}



function doMarriage(filiere) {
  var eleves = [];
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);

          data.sort((a,b)=>{
            return  parseFloat(a["moyenne"].replace(",",".")) - parseFloat(b["moyenne"].replace(",","."));
          });
          data.reverse();



          create_array_spe(filiere, function(text,filiere){
            var data_spe = [];
            var spe = [];

            data_spe = JSON.parse(text);
            for (var i = 0; i < data_spe.length; i++) {
              for (var j = 1; j <= data_spe[i]["nbPlace"]; j++) {
                 var spec = new Person(data_spe[i]["spe"].toUpperCase()+"_"+j, 0,0);
                 for (var h = 0; h < spe.length; h++) {
                   for (var l = 0; l < eleves.length; l++) {
                     spe[h].candidates[l] = eleves[l];
                   }
                 }
                 spe.push(spec);
              }
            }

            for (var i = 0; i < data.length; i++) {
              //console.log(data[i]["prenom"]+"_"+data[i]["nom"]);
              var eleve = new Person(data[i]["prenom"]+"_"+data[i]["nom"], data[i]["moyenne"],data[i]["mail"]);
              eleve.candidates = [];
              var choix = data[i]["Choix"];

              for (var j = 1; j < Object.keys(choix).length+1; j++) {
                var choix_spe = choix["Choix"+j].toUpperCase();

                for (var h = 0; h < spe.length; h++) {
                  var la_spe = spe[h];
                  if(choix_spe == la_spe.name.substring(0,choix_spe.length)){
                    eleve.candidates.push(la_spe);
                  }
                }
              }
              eleves[i]=eleve;
            }


            for (var i = 0; i < spe.length; i++) {
              for (var j = 0; j < eleves.length; j++) {
                spe[i].candidates[j] = eleves[j];
              }
            }



            engageBIryone(eleves);

            
            var resultat_marriage = [];
            for (var i = 0; i < eleves.length; i++) {
              resultat_marriage[i]={ eleve : eleves[i].name , option: eleves[i].fce.name.split('_'), moyenne: eleves[i].moyenne, mail: eleves[i].mail};
            }

            resultat_marriage = JSON.stringify(resultat_marriage);
            console.log(resultat_marriage);
            console.log(filiere);

            resultat = new XMLHttpRequest();
            resultat.open("POST", "../mariageStable/resultat.php", true);
            resultat.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            resultat.send("resultat="+resultat_marriage+"&filiere="+filiere);

            /*for (var i = 0; i < eleves.length; i++) {
                console.log("%s is engaged to %s", eleves[i].name, eleves[i].fce.name.split('_',1));
                //console.log(eleves[i].fce);
            }*/


          console.log("Stable = %s", isStable(eleves, spe) ? "Yes" : "No");




        });

      }
  };

  xhttp.open("POST", "../mariageStable/recupJSON.php", true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send("filiere="+filiere);
}
