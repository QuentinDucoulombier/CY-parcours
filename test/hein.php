<?php
if (isset($_FILES['monFichier'])) {
    // Exemple :
    move_uploaded_file($_FILES['monFichier']['tmp_name'], "uploads/" . $_FILES['monFichier']['name']);
    exit;
}
?><!DOCTYPE html>
<html>
<head>
    <title>dnd binary upload</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script type="application/javascript">
        function sendFile(file) {
            const uri = "index.php";
            const xhr = new XMLHttpRequest();
            const fd = new FormData();

            xhr.open("POST", uri, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText); // gestion de la réponse.
                }
            };
            fd.append('monFichier', file);
            // Initier un upload multipart/form-data
            xhr.send(fd);
        }

        window.onload = function() {
            const dropzone = document.getElementById("dropzone");
            dropzone.ondragover = dropzone.ondragenter = function(event) {
                event.stopPropagation();
                event.preventDefault();
            }

            dropzone.ondrop = function(event) {
                event.stopPropagation();
                event.preventDefault();

                const filesArray = event.dataTransfer.files;
                for (let i=0; i<filesArray.length; i++) {
                    sendFile(filesArray[i]);
                }
            }
        }
    </script>
</head>
<body>
    <div>
        <div id="dropzone" style="margin:30px; width:500px; height:300px; border:1px dotted grey;">Glisser-déposer votre fichier ici…</div>
    </div>
</body>
</html>