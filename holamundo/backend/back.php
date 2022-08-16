
<?php
    require 'ip.php';
    require 'mascara.php';
    $ip=explode(".",$_POST['newIP']);
    $mask=explode(".",$_POST['newMask']);
    $bits=$_POST['newBits'];

$ip1=new ip($ip[0],$ip[1],$ip[2],$ip[3]);
$mask1=new mascara($ip1);

$mask1->bitsMask($bits);


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

 function cuantosBits($unknownMask){


 }

$ipTemp2=calculoRed($ip1,$bits);

echo "<label id='rIp'>".$ipTemp2->getOct1().'.'.$ipTemp2->getOct2().'.'.$ipTemp2->getOct3().'.'.$ipTemp2->getOct4()."/".$bits."</label>".
    "<label id='rHosts'>".$mask1->numeroHosts($bits)."</label>".
    "<label id='decMask'>".$mask1->getOctM1().'.'.$mask1->getOctM2().'.'.$mask1->getOctM3().'.'.$mask1->getOctM4()."</label>".
    "<label id='hexMask'>".dechex($mask1->getOctM1()).'.'.dechex($mask1->getOctM2()).'.'.dechex($mask1->getOctM3()).'.'.dechex($mask1->getOctM4()).
    "</label>".
    "<label id='binMask'>".decbin($mask1->getOctM1()).'.'.decbin($mask1->getOctM2()).'.'.decbin($mask1->getOctM3()).'.'.decbin($mask1->getOctM4()).
    "</label>".
    "<label id='binIp'>".decbin($ip1->getOct1()).'.'.decbin($ip1->getOct2()).'.'.decbin($ip1->getOct3()).'.'.decbin($ip1->getOct4()).
    "</label>".
    "<label id='tipoIPtext'>".$ip1->calcularClase().' '.$ip1->calcularClasePoP()."</label>";





?>
