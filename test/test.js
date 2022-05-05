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

    var Actu = new Person("Actu");
    var HPDA  = new Person("HPDA");
    var BI  = new Person("BI");
    var CS  = new Person("CS");
    var DS = new Person("DS");
    var IAP  = new Person("IAP");
    var FT = new Person("FT");
    var IAC  = new Person("IAC");
    var IAP  = new Person("IAP");
    var ICC  = new Person("ICC");
    var INEM = new Person("INEM");
    var MMF = new Person("MMF");
    var VISUA  = new Person("VISUA");


    /*Dupre.candidates  = [IAC ,HPDA ,IAP ,BI ,VISUA ,ICC ,INEM ,CS];
    Ribeiro.candidates  = [ICC ,IAP ,HPDA ,IAC ,VISUA ,INEM ,CS ,BI];
    Sauvage.candidates  = [IAC ,BI ,HPDA ,IAP ,ICC ,CS ,INEM ,VISUA];
    Alves.candidates  = [BI ,IAC ,CS ,VISUA ,ICC ,INEM ,HPDA ,IAP];
    Levy.candidates   = [IAC ,IAP ,CS ,ICC ,INEM ,VISUA ,HPDA ,BI];
    Boulay.candidates = [IAC ,IAP ,HPDA ,BI ,CS ,VISUA ,ICC ,INEM];
    Seguin.candidates  = [CS ,ICC ,IAP ,IAC ,INEM ,VISUA ,BI ,HPDA];
    IAC.candidates  = [Dupre, Ribeiro, Sauvage, Alves, Levy, Boulay, Seguin];
    HPDA.candidates  = [Dupre, Ribeiro, Sauvage, Alves, Levy, Boulay, Seguin];
    cath.candidates = [Dupre, Ribeiro, Sauvage, Alves, Levy, Boulay, Seguin];
    IAP.candidates  = [Dupre, Ribeiro, Sauvage, Alves, Levy, Boulay, Seguin];
    BI.candidates  = [Dupre, Ribeiro, Sauvage, Alves, Levy, Boulay, Seguin];
    VISUA.candidates  = [Dupre, Ribeiro, Sauvage, Alves, Levy, Boulay, Seguin];
    ICC.candidates  = [Dupre, Ribeiro, Sauvage, Alves, Levy, Boulay, Seguin];
    INEM.candidates = [Dupre, Ribeiro, Sauvage, Alves, Levy, Boulay, Seguin];
    CS.candidates  = [Dupre, Ribeiro, Sauvage, Alves, Levy, Boulay, Seguin];

    var eleve = [Dupre, Ribeiro, Sauvage, Alves, Levy, Boulay, Seguin];
    var spe = [Actu, HPDA, BI, CS, DS, IAP, FT, IAC, IAP, ICC,INEM, MMF, VISUA];

    engageBIryone(eleve);

    for (var i = 0; i < eleve.length; i++) {
        console.log("%s is engaged to %s", eleve[i].name, eleve[i].fce.name);
    }
    console.log("Stable = %s", isStable(eleve, spe) ? "Yes" : "No");
    .swapWith(Boulay);
    console.log("Stable = %s", isStable(eleve, spe) ? "Yes" : "No");*/
}

doMarriage();
