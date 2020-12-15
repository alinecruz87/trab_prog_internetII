<?php
include_once 'Entrega.php';
include_once 'PDOFactory.php';

    class EntregaDAO {
        
        public function inserirEntrega(Entrega $entrega){
            $qInserir = ("INSERT INTO entregas (id_v, id_d, qtde_cesta)
                VALUES (:id_v, :id_d, :qtde_cesta, :qte_pessoas, :ponto_ref, :cpf)");
                $pdo = PDOFactory::getConexao();
                $comando = $pdo->prepare($qInserir);
                $comando->bindParam(':id_v',               $entrega->getIdV());
                $comando->bindParam(':id_d',               $entrega->getIdD());
                $comando->bindParam(':qtde_cesta',         $entrega->getQtdeCesta());
                $comando->execute();
                $entrega->id = $pdo->lastInsertId();
                return $entrega;
        }
        
        public function listarEntrega(){
            $query = ("SELECT * FROM entregas");
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
                $comando->execute();
                $entregas=array();
                while($row = $comando->fetch(PDO::FETCH_OBJ)){
                    $entregas[] = new Entrega($row->id_e,$row->id_v,$row->qtde_cesta);
                }
                return $entregas;
        }
        
        public function buscarEntregaPorId($id){
            $query = "SELECT * FROM entregas WHERE id_e =:id";
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($query);
            $comando->bindParam(':id_v', $id);
            $comando->execute();
            $result = $comando->fetch(PDO::FETCH_OBJ);;
            return new Entrega($result->id_e,$result->id_v,$result->id_d,$result->qtde_cesta);
        }
        
        public function deletarEntrega($id)
        {
            $qDeletar = "DELETE FROM entregas WHERE id_e=:id";
            $entrega = $this->buscarEntregaPorId($id);
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(':id_e',$id);
            $comando->execute();
            return $entrega
        }
        
        public function atualizarEntrega(Entrega $entrega)
        {    
            $qAtualizar = "UPDATE entregas SET id_v=:id_v, id_d=:id_d, qtde_cesta=:qtde_cesta WHERE id_e=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":id_v",                $entrega->id_v);
            $comando->bindParam(":id_d",                $entrega->id_d);
            $comando->bindParam(":qtde_cesta",          $entrega->qtde_cesta);
            $comando->bindParam(":id_e",                $id);
            $comando->execute(); 
            return($entrega);      
        }
    }
?>