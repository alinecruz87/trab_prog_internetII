<?php 
class Voluntario{
    public $id_v;
    public $nome_v;
    public $endereco_v;
    public $telefone_v;
    public $automovel;
    public $cpf_v;

    public function __construct($id_v, $nome_v, $endereco_v, $telefone_v, $automovel, $cpf_v){
        $this->id_v              = $id_v;
        $this->nome_v            = $nome_v;
        $this->endereco_v        = $endereco_v;
        $this->telefone_v        = $telefone_v;
        $this->automovel         = $automovel;
        $this->cpf_v             = $cpf_v;
    }
}
?>