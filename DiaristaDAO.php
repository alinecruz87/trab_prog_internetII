<?php
    include_once 'Diarista.php';
    include_once 'PDOFactory.php';

    class DiaristaDAO {

        public function inserirDiarista(Diarista $diarista){
                $qInserir = ("INSERT INTO diaristas (nome, endereco, telefone, qte_pessoas, ponto_ref, cpf)
                VALUES (:nome, :endereco, :telefone, :qte_pessoas, :ponto_ref, :cpf)");
                $pdo = PDOFactory::getConexao();
                $comando = $pdo->prepare($qInserir);    
                $comando->bindParam(':nome',           $diarista->nome);
                $comando->bindParam(':endereco',       $diarista->endereco);
                $comando->bindParam(':telefone',       $diarista->fone);
                $comando->bindParam(':qte_pessoas',    $diarista->qte_pessoas);
                $comando->bindParam(':ponto_ref',      $diarista->ponto_ref);
                $comando->bindParam(':cpf',            $diarista->cpf);
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
                    $diaristas[] = new Diarista($row->id,$row->nome,$row->endereco,$row->telefone,$row->qte_pessoas,$row->ponto_ref,$row->cpf);
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
            return new Diarista($result->id,$result->nome,$result->endereco,$result->telefone,$result->qte_pessoas,$result->ponto_ref,$result->cpf);
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
            $qAtualizar = "UPDATE diaristas SET nome=:nome, endereco=:endereco, telefone=:telefone, qte_pessoas=:qte_pessoas, ponto_ref=:ponto_ref, cpf=:cpf WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
        
            $comando->bindParam(":nome",                $diarista->nome);
            $comando->bindParam(":endereco",            $diarista->endereco);
            $comando->bindParam(":telefone",            $diarista->fone);
            $comando->bindParam(":qte_pessoas",         $diarista->qte_pessoas);
            $comando->bindParam(":ponto_ref",           $diarista->ponto_ref);
            $comando->bindParam(":cpf",                 $diarista->cpf);
            $comando->bindParam(":id",                  $id);
            $comando->execute();
            return($diarista);       
        }
    }
    ?>
