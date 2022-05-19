function Person(name) {

    var candidateIndex = 0;

    this.name = name;
    this.fiance = null;
    this.candidates = [];

    this.rank = function(p) {
        for (i = 0; i < this.candidates.length; i++)
            if (this.candidates[i] === p) return i;
        return this.candidates.length + 1;
    }

    this.prefers = function(p) {
        return this.rank(p) < this.rank(this.fiance);
    }

    this.nextCandidate = function() {
        if (candidateIndex >= this.candidates.length) return null;
        return this.candidates[candidateIndex++];
    }

    this.engageTo = function(p) {
        if (p.fiance) p.fiance.fiance = null;
        p.fiance = this;
        if (this.fiance) this.fiance.fiance = null;
        this.fiance = p;
    }

    this.swapWith = function(p) {
        console.log("%s & %s swap partners", this.name, p.name);
        var thisFiance = this.fiance;
        var pFiance = p.fiance;
        this.engageTo(pFiance);
        p.engageTo(thisFiance);
    }
}

function isStable(guys, gals) {
    for (var i = 0; i < guys.length; i++)
        for (var j = 0; j < gals.length; j++)
            if (guys[i].prefers(gals[j]) && gals[j].prefers(guys[i]))
                return false;
    return true;
}

function engageEveryone(guys) {
    var done;
    do {
        done = true;
        for (var i = 0; i < guys.length; i++) {
            var guy = guys[i];
            if (!guy.fiance) {
                done = false;
                var gal = guy.nextCandidate();
                if (!gal.fiance || gal.prefers(guy))
                    guy.engageTo(gal);
            }
        }
    } while (!done);
}

function doMarriage() {
    var gals = [];
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


    var guys = [HPDA, BI, DS, IAP, FT, IAC];
    for (var i = 0; i < data.length; i++) {
      //console.log(data[i]["prenom"]+"_"+data[i]["nom"]);
      var test = new Person(data[i]["prenom"]+"_"+data[i]["nom"]);
      test.candidates = [data[i]["Choix"]["Choix1"],data[i]["Choix"]["Choix2"],data[i]["Choix"]["Choix3"],data[i]["Choix"]["Choix4"],data[i]["Choix"]["Choix5"],data[i]["Choix"]["Choix6"]];
      gals[i]=test;
    }

    for (var i = 0; i < guys.length; i++) {
      for (var j = 0; j < gals.length; j++) {
        guys[i].candidates[j] = gals[j].name;
      }
    }

    engageEveryone(guys);

    for (var i = 0; i < guys.length; i++) {
        console.log("%s is engaged to %s", guys[i].name, guys[i].fiance.name);
    }
    console.log("Stable = %s", isStable(guys, gals) ? "Yes" : "No");

    xhttp.open("POST", "recupJSON.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send();
  }
}
}
