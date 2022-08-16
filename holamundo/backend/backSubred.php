<?php
    $inicioListaBits=$_POST['diMask'];

    echo "<select id='chooseMaskSubred'>";

    for ($i=$inicioListaBits;$i<=32;$i++){
        echo "<option>$i</option>>";
    }
    echo "</select>";


?>