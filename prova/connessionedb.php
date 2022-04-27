<?php
function connectdb()
{
    $link=mysqli_connect("localhost","cele99","password","try");

    if(!$link) {
        echo "Si e' verificato un errore: non riesco a collegarmi al database",PHP_EOL;
        exit(-1);
    }
    return $link;
}
?>

