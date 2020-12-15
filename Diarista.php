<?php 
class Diarista{
    public $id;
    public $nome; 
    public $endereco;
    public $telefone;
    public $qte_pessoas;
    public $ponto_ref;
    public $cpf;

    public function __construct($id, $nome, $endereco, $telefone, $qte_pessoas, $ponto_ref, $cpf){
        $this->id               = $id;
        $this->nome             = $nome;
        $this->endereco         = $endereco;
        $this->telefone         = $telefone;
        $this->qte_pessoas      = $qte_pessoas;
        $this->ponto_ref        = $ponto_ref;
        $this->cpf              = $cpf;
    }
}
?>

