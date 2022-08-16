<?php

class mascara{


    /**
     * @return int
     */
    public function getOctM1()
    {
        return $this->octM1;
    }

    /**
     * @return int
     */
    public function getOctM2()
    {
        return $this->octM2;
    }

    /**
     * @return int
     */
    public function getOctM3()
    {
        return $this->octM3;
    }

    /**
     * @return int
     */
    public function getOctM4()
    {
        return $this->octM4;
    }
    public $ip;
    public $octM1;
    public $octM2;
    public $octM3;
    public $octM4;

    public function __construct(ip $ip)
    {
        $this->ip =$ip;
        $this->octM1=0;
        $this->octM2=0;
        $this->octM3=0;
        $this->octM4=0;
    }

    public function setOctetos($oct1,$oct2,$oct3,$oct4){
        $this->octM1=$oct1;
        $this->octM2=$oct2;
        $this->octM3=$oct3;
        $this->octM4=$oct4;

    }

    public function genDefaultMask(){
        $this->octM1=$this->ip->oct1>0?255:0;
        $this->octM2=$this->ip->oct1!=0 &&$this->ip->oct2>0?255:0;
        $this->octM3=$this->ip->oct3>0?255:0;
        $this->octM4=$this->ip->oct4>254?255:0;

    }

    public function bitsMask($bit){

        switch ($bit){
            case $bit<8:
                $this->octM1=$this->calcularBit($bit);
            break;
            case $bit>=8:
                $this->octM1=255;
                break;
        }

        switch ($bit){
            case $bit>8 && $bit<16:
                $this->octM2=$this->calcularBit($bit);
                break;
            case $bit>=16:
                $this->octM2=255;
                break;
            case $bit<=8:
                $this->octM2=0;
                break;
        }

        switch ($bit){
            case $bit>16 && $bit<24:
                $this->octM3=$this->calcularBit($bit);
                break;
            case $bit>=24:
                $this->octM3=255;
                break;
            case $bit<=16:
                $this->octM3=0;
                break;
        }

        switch ($bit){
            case $bit>24 && $bit<32:
                $this->octM4=$this->calcularBit($bit);
                break;
            case $bit==32:
                $this->octM4=255;
                break;
            case $bit<=24:
                $this->octM4=0;
                break;
        }
    }

    public function calcularBit($bit){

        $bitTrunk=$bit<=8?$bit:$bit%8;
        $total = 0;

            for ($i =8-$bitTrunk; $i<8; $i++) {
                $total =pow(2,$i)+$total;
        }
        return ($bit==32 || $bit==16 || $bit==24 || $bit==8)?255:$total;
    }

    public function numeroHosts($bit){
        $valor=0;
        switch ($bit){
            case $bit>=1 && $bit<=30:
                $valor=pow(2,32-$bit)-2;
                break;
            case $bit==31:
                $valor=pow(2,32-$bit);
                break;
            case $bit==32:
                $valor=1;
                break;
        }
        return $valor;
    }







}

?>
