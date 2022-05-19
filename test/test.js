/*test present sur le site d'ines pour Gale/Shapley algorithme https://rosettacode.org/wiki/Stable_marriage_problem#JavaScript */


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

function isStable(guys, gals) {
    for (var i = 0; i < guys.length; i++)
        for (var j = 0; j < gals.length; j++)
            if (guys[i].prefers(gals[j]) && gals[j].prefers(guys[i]))
                return false;
    return true;
}

function engageBIryone(guys) {
    var done;
    do {
        done = true;
        for (var i = 0; i < guys.length; i++) {
            var guy = guys[i];
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

    var Dupre  = new Person("Dupre");
    var Ribeiro  = new Person("Ribeiro");
    var Sauvage  = new Person("Sauvage");
    var Alves  = new Person("Alves");
    var Levy   = new Person("Levy");
    var Boulay = new Person("Boulay");
    var Seguin  = new Person("Seguin");
    var IAC  = new Person("IAC");
    var HPDA  = new Person("HPDA");
    var IAP  = new Person("IAP");
    var BI  = new Person("BI");
    var VISUA  = new Person("VISUA");
    var ICC  = new Person("ICC");
    var INEM = new Person("INEM");
    var CS  = new Person("CS");

    Dupre.candidates  = [IAC ,HPDA ,IAP ,BI ,VISUA ,ICC ,INEM ,CS];
    Ribeiro.candidates  = [ICC ,IAP ,HPDA ,IAC ,VISUA ,INEM ,CS ,BI];
    Sauvage.candidates  = [IAC ,BI ,HPDA ,IAP ,ICC ,CS ,INEM ,VISUA];
    Alves.candidates  = [BI ,IAC ,CS ,VISUA ,ICC ,INEM ,HPDA ,IAP];
    Levy.candidates   = [IAC ,IAP ,CS ,ICC ,INEM ,VISUA ,HPDA ,BI];
    Boulay.candidates = [IAC ,IAP ,HPDA ,BI ,CS ,VISUA ,ICC ,INEM];
    Seguin.candidates  = [CS ,ICC ,IAP ,IAC ,INEM ,VISUA ,BI ,HPDA];
    IAC.candidates  = [Dupre, Ribeiro, Sauvage, Alves, Levy, Boulay, Seguin];
    HPDA.candidates  = [Dupre, Ribeiro, Sauvage, Alves, Levy, Boulay, Seguin];
    IAP.candidates  = [Dupre, Ribeiro, Sauvage, Alves, Levy, Boulay, Seguin];
    BI.candidates  = [Dupre, Ribeiro, Sauvage, Alves, Levy, Boulay, Seguin];
    VISUA.candidates  = [Dupre, Ribeiro, Sauvage, Alves, Levy, Boulay, Seguin];
    ICC.candidates  = [Dupre, Ribeiro, Sauvage, Alves, Levy, Boulay, Seguin];
    INEM.candidates = [Dupre, Ribeiro, Sauvage, Alves, Levy, Boulay, Seguin];
    CS.candidates  = [Dupre, Ribeiro, Sauvage, Alves, Levy, Boulay, Seguin];

    var guys = [Dupre, Ribeiro, Sauvage, Alves, Levy, Boulay, Seguin];
    var gals = [IAC, HPDA, IAP, BI, VISUA, ICC, INEM, CS];

    engageBIryone(guys);

    for (var i = 0; i < guys.length; i++) {
        console.log("%s is engaged to %s", guys[i].name, guys[i].fce.name);
    }
    console.log("Stable = %s", isStable(guys, gals) ? "Yes" : "No");
    /*.swapWith(Boulay);
    console.log("Stable = %s", isStable(guys, gals) ? "Yes" : "No");*/
}

doMarriage();
