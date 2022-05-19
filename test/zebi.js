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

function isStable(eleve, spe) {
    for (var i = 0; i < eleve.length; i++)
        for (var j = 0; j < spe.length; j++)
            if (eleve[i].prefers(spe[j]) && spe[j].prefers(eleve[i]))
                return false;
    return true;
}

function engageBIryone(eleve) {
    var done;
    do {
        done = true;
        for (var i = 0; i < eleve.length; i++) {
            var guy = eleve[i];
            if (!guy.fce) {
                done = false;
                var gal = guy.nextCandidate();
                if (!gal.fce || gal.prefers(guy))
                    guy.engageTo(gal);
            }
        }
    } while (!done);
}


function doMarriage() {
  var eleve = [];
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function(){
      if (this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);


          //var Actu = new Person("Actu");
          var HPDA  = new Person("HPDA");
          var BI  = new Person("BI");
          //var CS  = new Person("CS");
          var DS = new Person("DS");
          var FT = new Person("FT");
          var IAC  = new Person("IAC");
          var IAP  = new Person("IAP");
          //var ICC  = new Person("ICC");
          //var INEM = new Person("INEM");
          //var MMF = new Person("MMF");
          //var VISUA  = new Person("VISUA");

          var spe = [HPDA, BI, DS, IAP, FT, IAC];


          for (var i = 0; i < data.length; i++) {
            //console.log(data[i]["prenom"]+"_"+data[i]["nom"]);
            var test = new Person(data[i]["prenom"]+"_"+data[i]["nom"]);
            //test.candidates = [new Person(data[i]["Choix"]["Choix1"]),new Person (data[i]["Choix"]["Choix2"]),new Person (data[i]["Choix"]["Choix3"]),new Person (data[i]["Choix"]["Choix4"]),new Person (data[i]["Choix"]["Choix5"]),new Person (data[i]["Choix"]["Choix6"])];
            eleve[i]=test;
          }

          for (var i = 0; i < eleve.length; i++) {
            for (var h = 1; h < data[i]["Choix"].length+1; h++) {
              var j = 0;
              while (data[i]["Choix"]["Choix"+h] != spe[j]) {
                j++;
              }
              eleve[i].candidates[h]=spe[j];
            }

          }

          for (var i = 0; i < spe.length; i++) {
            for (var j = 0; j < eleve.length; j++) {
              spe[i].candidates[j] = eleve[j].name;
            }
          }

          console.log(eleve);
          console.log(spe);

          engageBIryone(eleve);

          for (var i = 0; i < eleve.length; i++) {
              console.log("%s is engaged to %s", eleve[i].name, eleve[i].fce.name);
              //console.log(eleve[i].fce);
          }

      }
      console.log("Stable = %s", isStable(eleve, spe) ? "Yes" : "No");
  };

  xhttp.open("POST", "recupJSON.php", true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.send();
}

//doMarriage();
