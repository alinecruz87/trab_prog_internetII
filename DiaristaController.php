<?php

include_once('Diarista.php');
include_once('DiaristaDAO.php');

class DiaristaController {

    public function listar($request, $response, $args){
        $dao= new DiaristaDAO;    
        $diaristas = $dao->listarDiarista();
        return $response->withJSON($diaristas);
    
    }

    public function inserir($request, $response, $args) {
        $data = $request->getParsedBody();
        $diarista = new Diarista(0,$data['nome'],$data['endereco']);
    
        $dao = new DiaristaDao;
        $diarista = $dao->inserirDiarista($diarista);
    
        return $response->withJson($diarista,201);
    }

    public function buscarPorId($request, $response, $args) {
        $id = $args['id'];
        
        $dao= new DiaristaDao;    
        $diarista = $dao->buscarDiaristaPorId($id);
        
        return $response->withJson($diarista);
    }
    
    public function atualizar($request, $response, $args) {
        $id = $args['id'];
        $data = $request->getParsedBody();
        $diarista = new Diarista($id, $data['nome'],$data['endereco']);
    
        $dao = new DiaristaDao;
        $diarista = $dao->atualizarDiarista($diarista);
    
        return $response->withJson($diarista);
    }
    
    public function deletar($request, $response, $args) {
        $id = $args['id'];
    
        $dao = new DiaristaDao;
        $diarista = $dao->deletarDiarista($id);
    
        return $response->withJson($diarista);
    }
}
?>