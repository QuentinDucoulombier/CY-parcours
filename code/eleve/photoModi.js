/*copier coller de l'autre fonction parce qu'il arriver pas a changer de fichier mais y a moy de changer ca si vous etes deter */

$(document).ready(function() {

    
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
                
                
                    var xhttp = new XMLHttpRequest();
    

                    xhttp.onreadystatechange = function() {
                        if(this.readyState == 4 && this.status ==200){
                            console.log(this.responseText);
                        }
                        
                    };
                
                    xhttp.open("POST","photoModifPHP.php",true);
                
                    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                
                    xhttp.send("pp="+e.target.result);
                
                
                
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".input").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $(".input").click();
    });
});