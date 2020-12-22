<?php 
class Diarista{
    public $id;
    public $nome;
    public $endereco; 

    public function __construct($id, $nome, $endereco){
        $this->id               = $id;
        $this->nome             = $nome;
        $this->endereco         = $endereco;
    }
}
?>

