<?php
    include_once 'Voluntario.php';
    include_once 'PDOFactory.php';

    class VoluntarioDAO 
    {    
        public function inserirVoluntario(Voluntario $voluntario)
        {
            $qInserir = "INSERT INTO voluntarios(nome_v, endereco_v, telefone_v, automovel, cpf_v)
            VALUES (:nome_v, :endereco_v, :telefone_v, :automovel, :cpf_v)";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":nome_v",           $voluntario->nome_v);
            $comando->bindParam(":endereco_v",       $voluntario->endereco_v);
            $comando->bindParam(":telefone_v",       $voluntario->telefone_v);
            $comando->bindParam(":automovel",        $voluntario->automovel);
            $comando->bindParam(":cpf_v",            $voluntario->cpf_v);
            $comando->execute();
            $voluntario->id_v = $pdo->lastInsertId();
            return $voluntario;
        }
        
        public function listarVoluntario()
        {
            $query = "SELECT * FROM voluntarios";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->execute();
            $voluntarios = array();
            while($row = $comando->fetch(PDO::FETCH_OBJ)){
                $voluntarios[] = new Voluntario($row->id_v,$row->nome_v,$row->endereco_v,$row->telefone_v,$row->automovel,$row->cpf_v);
            }
            return $voluntarios;
        }
        
        public function buscarVoluntarioPorId($id){
            $query = "SELECT * FROM voluntarios WHERE id_v=:id";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->bindParam('id', $id);
            $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);
            return new Voluntario($result->id_v,$result->nome_v,$result->endereco_v,$result->telefone_v,$result->automovel,$result->cpf_v);
        }
        
        public function deletarVoluntario($id)
        {
            $qDeletar = "DELETE from voluntarios WHERE id_v=:id";
            $voluntario = $this->buscarVoluntarioPorId($id);
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
            return $voluntario;
        }
        
        public function atualizarVoluntario(Voluntario $voluntario)
        {    
            $qAtualizar = "UPDATE voluntarios SET nome_v=:nome_v, endereco_v=:endereco_v, telefone_v=:telefone_v, automovel=:automovel WHERE id_v=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
        
            $comando->bindParam(":nome_v",                $voluntario->nome_v);
            $comando->bindParam(":endereco_v",            $voluntario->endereco_v);
            $comando->bindParam(":telefone_v",            $voluntario->telefone_v);
            $comando->bindParam(":automovel",             $voluntario->automovel);
            $comando->bindParam(":cpf_v",                 $voluntario->cpf_v);
            $comando->bindParam(":id_v",                  $id);
            $comando->execute(); 
            return($voluntario);      
        }
    }
?>