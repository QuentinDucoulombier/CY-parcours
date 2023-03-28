<?php
    session_start();
    $new = str_replace (" ", "+",  $_POST["pp"]); //https://www.google.com/search?q=application%2Fx-www-form-urlencoded+plus+sign&client=opera&hs=UXi&sxsrf=APq-WBt6_Fy_ITm2PmA3KoqBZXWV-dJTyw%3A1650498140735&ei=XJpgYsrELNaFur4Ptrm0-Ac&oq=application%2Fx-www-form-urlencoded+plus&gs_lcp=Cgdnd3Mtd2l6EAMYADIFCAAQywEyBggAEBYQHjIGCAAQFhAeOgcIIxCwAxAnOgcIABBHELADOgUIABCABDoICAAQFhAKEB5KBAhBGABKBAhGGABQwAFYrQ5g1RZoAXABeACAAWmIAeIDkgEDMi4zmAEAoAEByAEJwAEB&sclient=gws-wiz

    $_SESSION["pp"] = $new;
    
    echo $new;
    /*function base64_to_jpeg($base64_string, $output_file) { /*ne sert a rien dans notre cas mais jvoulais savoir comment ca marche 
        // open the output file for writing
        $ifp = fopen( $output_file, 'wb' ); 
    
        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode( ',', $base64_string );
    
        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );
    
        // clean up the file resource
        fclose( $ifp ); 
    
        return $output_file; 
    }
    base64_to_jpeg($new, 'tmp.jpg');*/

?>