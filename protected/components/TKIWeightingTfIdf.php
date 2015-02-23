<?php

class TKIWeightingTfIdf
{
    // jumlah dokumen
    public $N;
    
    // term frekuensi
    public $tf;
    
    // dokumen frekuensi
    public $df;
    
    public function setVar($N, $df, $tf)
    {
        $this->N = $N;
        $this->df = $df;
        $this->tf = $tf;
    }
    
    public function getWeight()
    {
        return log($this->N/$this->df, 10) * $this->tf;
    }
    
    public function setN($N)
    {
        $this->N = $N;
    }
    
    public function setDf($df)
    {
        $this->df = $df;
    }
    
    public function setTf($tf)
    {
        $this->tf = $tf;
    }
}

?>
