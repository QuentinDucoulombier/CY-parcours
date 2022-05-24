//test present sur le site d'ines pour Gale/Shapley algorithme https://rosettacode.org/wiki/Stable_marriage_problem#JavaScript

function Person(name) {

    var candidateIndex = 0;

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



function create_array_spe(filiere){
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200) {

      }


  xhttp.open("POST", "recupJSON.php", true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send("");
}
}



function doMarriage(filiere) {
  var eleves = [];
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);
          //var Actu = new Person("Actu");
          var HPDA  = new Person("HPDA");
          var BI_1  = new Person("BI_1");
          var BI_2  = new Person("BI_2");
          var BI_3  = new Person("BI_3");
          //var CS  = new Person("CS");
          var DS = new Person("DS");
          var FT = new Person("FT");
          var IAC  = new Person("IAC");
          var IAP  = new Person("IAP");
          //var ICC  = new Person("ICC");
          //var INEM = new Person("INEM");
          //var MMF = new Person("MMF");
          //var VISUA  = new Person("VISUA");

          var spe = create_array_spe();

          for (var i = 0; i < data.length; i++) {
            //console.log(data[i]["prenom"]+"_"+data[i]["nom"]);
            var eleve = new Person(data[i]["prenom"]+"_"+data[i]["nom"]);
            eleve.candidates = [];
            var choix = data[i]["Choix"];

            for (var j = 1; j < Object.keys(choix).length+1; j++) {
              var choix_spe = choix["Choix"+j];

              for (var h = 0; h < spe.length; h++) {
                var la_spe = spe[h];
                if(choix_spe == la_spe.name.substring(0, 2) || choix_spe == la_spe.name){
                  eleve.candidates.push(la_spe);
                }
              }
            }
            eleves[i]=eleve;
          }
          console.log(spe);
          console.log(eleves);

          for (var i = 0; i < spe.length; i++) {
            for (var j = 0; j < eleves.length; j++) {
              spe[i].candidates[j] = eleves[j];
            }
          }



          engageBIryone(eleves);

          for (var i = 0; i < eleves.length; i++) {
              console.log("%s is engaged to %s", eleves[i].name, eleves[i].fce.name);
              //console.log(eleves[i].fce);
          }

      }
      console.log("Stable = %s", isStable(eleves, spe) ? "Yes" : "No");
  };

  xhttp.open("POST", "recupJSON.php", true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send(filiere);
}
