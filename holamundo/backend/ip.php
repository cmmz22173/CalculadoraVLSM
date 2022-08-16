<?php
class ip{
    /**
     * @param int|mixed $oct1
     */
    public function setOct1($oct1)
    {
        $this->oct1 = $oct1;
    }

    /**
     * @param int|mixed $oct2
     */
    public function setOct2($oct2)
    {
        $this->oct2 = $oct2;
    }

    /**
     * @param int|mixed $oct3
     */
    public function setOct3($oct3)
    {
        $this->oct3 = $oct3;
    }

    /**
     * @param int|mixed $oct4
     */
    public function setOct4($oct4)
    {
        $this->oct4 = $oct4;
    }
    /**
     * @return int|mixed
     */
    public function getOct1()
    {
        return $this->oct1;
    }

    /**
     * @return int|mixed
     */
    public function getOct2()
    {
        return $this->oct2;
    }

    /**
     * @return int|mixed
     */
    public function getOct3()
    {
        return $this->oct3;
    }

    /**
     * @return int|mixed
     */
    public function getOct4()
    {
        return $this->oct4;
    }


    public $oct1;
    public $oct2;
    public $oct3;
    public $oct4;

    /**
     * @param $oct1
     * @param $oct2
     * @param $oct3
     * @param $oct4
     */
    public function __construct($oct1, $oct2, $oct3, $oct4)
    {
        $this->oct1 =  ($oct1<=255)?$oct1:255;
        $this->oct2 =  ($oct2<=255)?$oct2:255;
        $this->oct3 =  ($oct3<=255)?$oct3:255;
        $this->oct4 =  ($oct4<=255)?$oct4:255;
    }

    public function calcularClase(){
        $valor=null;

        switch ($this->oct1){
            case (($this->oct1>=0 &&  $this->oct1<=126) && ($this->oct2>=0 &&$this->oct2<=255)&&
                ($this->oct3>=0 &&$this->oct3<=255)&&($this->oct4>=0 &&$this->oct4<=255)):
                $valor='Clase A';
                break;
            case (($this->oct1>=128 &&  $this->oct1<=191) && ($this->oct2>=0 &&$this->oct2<=255)&&
                ($this->oct3>=0 &&$this->oct3<=255)&&($this->oct4>=0 &&$this->oct4<=255)):
                $valor='Clase B';
                break;
            case (($this->oct1>=192 &&  $this->oct1<=223) && ($this->oct2>=0 &&$this->oct2<=255)&&
                ($this->oct3>=0 &&$this->oct3<=255)&&($this->oct4>=0 &&$this->oct4<=255)):
                $valor='Clase C';
                break;
            case (($this->oct1>=224 &&  $this->oct1<=239) && ($this->oct2>=0 &&$this->oct2<=255)&&
                ($this->oct3>=0 &&$this->oct3<=255)&&($this->oct4>=0 &&$this->oct4<=255)):
                $valor='Clase D';
                break;
            case (($this->oct1>=240 &&  $this->oct1<=255) && ($this->oct2>=0 &&$this->oct2<=255)&&
                ($this->oct3>=0 &&$this->oct3<=255)&&($this->oct4>=0 &&$this->oct4<=255)):
                $valor='Clase E';
                break;

        }
        return $valor;

    }

    public function calcularClasePoP(){
        $valor='Publica';

            if( (($this->oct1==10) && ($this->oct2>=0 &&$this->oct2<=255)&&
                ($this->oct3>=0 &&$this->oct3<=255)&&($this->oct4>=0 &&$this->oct4<=255)) ||

              (($this->oct1==172) && ($this->oct2>=16 &&$this->oct2<=31)&&
                ($this->oct3>=0 &&$this->oct3<=255)&&($this->oct4>=0 &&$this->oct4<=255)) ||

              (($this->oct1==192) && ($this->oct2>=168 &&$this->oct2<=255)&&
                ($this->oct3>=0 &&$this->oct3<=255)&&($this->oct4>=0 &&$this->oct4<=255))){
                $valor='Privada';
            }

        return $valor;

    }

    public function retornarHosts($bits){
        $res=0;
        switch ($bits){
            case $bits<=30:
                $res=pow(2,32-$bits)-2;
                break;
            case $bits==31 || $bits==32:
                $res=pow(2,32-$bits);
                break;
        }
        return $res;
    }

    public function retornarSubredes($bits,$bitsRef){
        return pow(2,$bits-$bitsRef);
    }


}


?>


