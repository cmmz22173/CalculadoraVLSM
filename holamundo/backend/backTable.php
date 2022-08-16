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
$ipTS=calculoRed($ip,$subBit);
$ipTSR=calculoRed($ip,$subBit);
$ipTSB=new ip($ipTemp2[0],$ipTemp2[1],$ipTemp2[2],$ipTemp2[3]);


$host=$ipSubred->retornarHosts($subBit);


echo "<table id='TablaSubredes'>"."<tr id='cabeceraTabla'>"."<th>Red</th>".
    "<th>Rango</th>"."<th>Broadcast</th>"."</tr>";




    for($i=0;$i<$ipSubred->retornarSubredes($subBit,$mascaraRef);$i++) {

        switch ($subBit){
            case ($subBit>=24 && $subBit<=30) && $mascaraRef>=24:

                $ipTS->setOct4($ipTS->getOct4()+$host);

                echo "<td>".$ipTSR->getOct1().'.'.$ipTSR->getOct2().'.'.$ipTSR->getOct3().'.'.$ipTSR->getOct4()."</td>";
                echo "<td>".$ipTSR->getOct1().'.'.$ipTSR->getOct2().'.'.$ipTSR->getOct3().'.'.($ipTSR->getOct4()+1).
                    '   -   '.$ipTS->getOct1().'.'.$ipTS->getOct2().'.'.$ipTS->getOct3().'.'.$ipTS->getOct4()."</td>";

                echo "<td>".$ipTSR->getOct1().'.'.$ipTSR->getOct2().'.'.$ipTSR->getOct3().'.'.($ipTS->getOct4()+1)."</td>";
                echo "</tr>";
                $ipTS->setOct4($ipTS->getOct4()+2);
                $ipTSR->setOct4($ipTSR->getOct4()+$host+2);
                break;
            case $subBit==31 && $mascaraRef>=24:

                $ipTS->setOct4($ipTS->getOct4()+1);

                echo "<td>".$ipTSR->getOct1().'.'.$ipTSR->getOct2().'.'.$ipTSR->getOct3().'.'.$ipTSR->getOct4()."</td>";
                echo "<td>".$ipTSR->getOct1().'.'.$ipTSR->getOct2().'.'.$ipTSR->getOct3().'.'.($ipTSR->getOct4()).
                    '   -   '.$ipTS->getOct1().'.'.$ipTS->getOct2().'.'.$ipTS->getOct3().'.'.$ipTS->getOct4()."</td>";

                echo "<td>".$ipTSR->getOct1().'.'.$ipTSR->getOct2().'.'.$ipTSR->getOct3().'.'.($ipTS->getOct4())."</td>";
                echo "</tr>";
                $ipTS->setOct4($ipTS->getOct4()+1);
                $ipTSR->setOct4($ipTSR->getOct4()+2);
                break;

            case $subBit==32 && $mascaraRef>=24:

                echo "<td>".$ipTSR->getOct1().'.'.$ipTSR->getOct2().'.'.$ipTSR->getOct3().'.'.$ipTSR->getOct4()."</td>";
                echo "<td>".$ipTSR->getOct1().'.'.$ipTSR->getOct2().'.'.$ipTSR->getOct3().'.'.($ipTSR->getOct4()).
                    ' - '.$ipTS->getOct1().'.'.$ipTS->getOct2().'.'.$ipTS->getOct3().'.'.$ipTS->getOct4()."</td>";

                echo "<td>".$ipTSR->getOct1().'.'.$ipTSR->getOct2().'.'.$ipTSR->getOct3().'.'.($ipTS->getOct4())."</td>";
                echo "</tr>";
                $ipTS->setOct4($ipTS->getOct4()+1);
                $ipTSR->setOct4($ipTSR->getOct4()+1);
                break;

        }
    }
   echo "</table>";
?>
