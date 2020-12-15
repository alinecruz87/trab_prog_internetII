<?php 
class Entrega{
    public $id_e;
    public $id_v;
    public $id_d;
    public $qtde_cesta;

    public function __construct($id_e, $id_v, $qtde_cesta){
        $this->id_e              = $id_e;
        $this->id_v              = $id_v;
        $this->qtde_cesta        = $qtde_cesta;
    }
}
?>