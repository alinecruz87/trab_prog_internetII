<?php
    include_once 'Diarista.php';
    include_once 'PDOFactory.php';

    class DiaristaDAO {

        public function inserirDiarista(Diarista $diarista){
                $qInserir = ("INSERT INTO diaristas (nome, endereco)
                VALUES (:nome, :endereco)");
                $pdo = PDOFactory::getConexao();
                $comando = $pdo->prepare($qInserir);    
                $comando->bindParam(':nome',           $diarista->nome);
                $comando->bindParam(':endereco',       $diarista->endereco);
                $comando->execute();   
                $diarista->id = $pdo->lastInsertId();
                return $diarista;
        }
        
        public function listarDiarista(){
            $query = 'SELECT * FROM diaristas';
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
                $comando->execute();
                $diaristas=array();	
                while($row = $comando->fetch(PDO::FETCH_OBJ)){
                    $diaristas[] = new Diarista($row->id,$row->nome,$row->endereco);
                }
                return $diaristas;
        }
        
        public function buscarDiaristaPorId($id){
            $query = "SELECT * FROM diaristas WHERE id=:id";
            $pdo = PDOFactory::getConexao(); 
            $comando = $pdo->prepare($query);
            $comando->bindParam('id', $id);
            $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            return new Diarista($result->id,$result->nome,$result->endereco);
        }
        
        public function deletarDiarista($id)
        {
            $qDeletar = "DELETE from diaristas WHERE id=:id";
            $diarista = $this->buscarDiaristaPorId($id);
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
            return $diarista;
        }
        
        function atualizarDiarista(Diarista $diarista)
        {    
            $qAtualizar = "UPDATE diaristas SET nome=:nome, endereco=:endereco WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
        
            $comando->bindParam(":nome",                $diarista->nome);
            $comando->bindParam(":endereco",            $diarista->endereco);
            $comando->bindParam(":id",                  $diarista->id);
            $comando->execute();
            return($diarista);       
        }
    }
    ?>
