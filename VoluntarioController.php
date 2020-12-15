<?php
include_once('Voluntario.php');
include_once('VoluntarioDAO.php');

class VoluntarioController {

    public function listar($request, $response, $args){
        $dao= new VoluntarioDAO;    
        $voluntarios = $dao->listarVoluntario();
    
        return $response->withJSON($voluntarios);
    
    }

    public function inserir($request, $response, $args) {
        $data = $request->getParsedBody();
        $voluntario = new Voluntario(0,$data['nome_v'],$data['endereco_v'],$data['telefone_v'],$data['automovel'],$data['cpf_v']);
    
        $dao = new VoluntarioDao;
        $voluntario = $dao->inserirVoluntario($voluntario);
    
        return $response->withJson($voluntario,201);
    }

    public function buscarPorId($request, $response, $args) {
        $id = $args['id'];
        
        $dao= new VoluntarioDao;    
        $voluntario = $dao->buscarVoluntarioPorId($id);
        
        return $response->withJson($voluntario);
    }
    
    public function atualizar($request, $response, $args) {
        $id = $args['id'];
        $data = $request->getParsedBody();
        $voluntario = new Voluntario($id, $data['nome_v'],$data['endereco_v'],$data['telefone_v'],$data['automovel'],$data['cpf_v']);
    
        $dao = new VoluntarioDao;
        $voluntario = $dao->atualizarVoluntario($voluntario);
    
        return $response->withJson($voluntario);
    }
    
    public function deletar($request, $response, $args) {
        $id = $args['id'];
    
        $dao = new VoluntarioDao;
        $voluntario = $dao->deletarVoluntario($id);
    
        return $response->withJson($voluntario);
    }
}
?>