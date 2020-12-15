<?php

include_once('Entrega.php');
include_once('EntregaDAO.php');

class EntregaController {

    public function listar($request, $response, $args){
        $dao= new EntregaDAO;    
        $entregas = $dao->listarEntrega();
    
        return $response->withJSON($entregas);
    
    }

    public function inserir($request, $response, $args) {
        $data = $request->getParsedBody();
        $entrega = new Entrega(0,$data['id_d'],$data['id_v'],$data['qtde_cesta']);
    
        $dao = new EntregaDao;
        $entrega = $dao->inserirEntrega($entrega);
    
        return $response->withJson($entrega,201);
    }

    public function buscarPorId($request, $response, $args) {
        $id = $args['id'];
        
        $dao= new EntregaDao;    
        $entrega = $dao->buscarEntregaPorId($id);
        
        return $response->withJson($entrega);
    }
    
    public function atualizar($request, $response, $args) {
        $id = $args['id'];
        $data = $request->getParsedBody();
        $entrega = new Entrega($id, $data['id_d'],$data['id_v'],$data['qtde_cesta']);
    
        $dao = new EntregaDao;
        $entrega = $dao->atualizarEntrega($entrega);
    
        return $response->withJson($entrega);
    }
    
    public function deletar($request, $response, $args) {
        $id = $args['id'];
    
        $dao = new EntregaDao;
        $entrega = $dao->deletarEntrega($id);
    
        return $response->withJson($entrega);
    }
}
?>