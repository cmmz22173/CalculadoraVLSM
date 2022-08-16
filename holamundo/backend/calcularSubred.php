<?php
    require 'mascara.php';
    require 'ip.php';
    $subBit=$_POST['suMask'];
    $ipTemp2=explode(".",$_POST['redA']);
    $mascaraRef=$_POST['mRef'];

    $ip=new ip($ipTemp2[0],$ipTemp2[1],$ipTemp2[2],$ipTemp2[3]);

    function calculoRed($ip1,$bit){
    $ipTemp=new ip($ip1->getOct1(),$ip1->getOct2(),$ip1->getOct3(),$ip1->getOct4());

    switch ($bit){

        case $bit<=8 && $bit>1:
            $ipTemp->setOct2(0);
            $ipTemp->setOct4(0);
            $ipTemp->setOct3(0);
            break;
        case $bit==1 && $ipTemp->getOct1()>=128:
            $ipTemp->setOct1(128);
            $ipTemp->setOct2(0);
            $ipTemp->setOct4(0);
            $ipTemp->setOct3(0);
            break;
        case $bit==1 && $ipTemp->getOct1()<128:
            $ipTemp->setOct1(0);
            $ipTemp->setOct2(0);
            $ipTemp->setOct4(0);
            $ipTemp->setOct3(0);
            break;


        case $bit>8 && $bit<=16:
            $ipTemp->setOct4(0);
            $ipTemp->setOct3(0);

            break;
        case $bit>16 && $bit<=31:
            $ipTemp->setOct4(0);
            break;

    }
    return $ipTemp;
}

    $ipSubred=calculoRed($ip,$subBit);



    echo "<label id='nHostsSubred'>".$ipSubred->retornarHosts($subBit). "</label>".
        "<label id='cantidadSubredesMostrar'>". $ipSubred->retornarSubredes($subBit,$mascaraRef)."<label>";





?>
