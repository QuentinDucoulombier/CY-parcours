

function tri(pathfile, delimiter = ";") {

    var client = new XMLHttpRequest();
    client.open('GET', pathfile);
    client.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var str = this.responseText;
            var str_return = "";
            const header = str.slice(0, str.indexOf("\n"));
            str_return = new_return(str_return + header);
            
            var rows = str.slice(str.indexOf("\n") + 1).split("\n");


            while(rows[rows.length -1] == "" ){
                rows.pop();
            }

            rows.sort((a,b)=>{
                return  parseFloat(a.split(delimiter)[4].replace(",",".")) - parseFloat(b.split(delimiter)[4].replace(",","."));
            });
            rows.reverse();

            rows.forEach(element => {
                str_return = new_return(str_return+element);
            });
            console.log(str_return);
            var xhttp =new XMLHttpRequest();
            xhttp.open('GET', "ecriredansfic.php?letext="+str_return+"&path="+pathfile+"&delim"+delimiter);
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                }
            };
            xhttp.send();

        }
    }
    client.send();
}

function new_return(str_return) {
    return str_return + ";";
}


