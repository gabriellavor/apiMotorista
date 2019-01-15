<?php
namespace App\Controller;

use Cake\Controller\Controller;

class ApiController extends AppController
{
    

    public function initialize()
    {
        parent::initialize();
        $this->RequestHandler->respondAs('json');
        $this->autoRender = false; 
    }

    public function getMotoristas(){
        $this->response->statusCode(200);
        $this->response->type('application/json');
        $this->loadModel('Motorista');
        $result = $this->Motorista->getMotoristas();
        $this->response->body(json_encode(['resultado' => $result]));
        return $this->response;
    }

    public function getTiposVeiculos(){
        $this->response->statusCode(200);
        $this->response->type('application/json');
        $this->loadModel('TipoVeiculo');
        $result = $this->TipoVeiculo->getTIposveiculos();
        $this->response->body(json_encode(['resultado' => $result]));
    }

    public function getTiposVeiculo(){
        $this->response->statusCode(200);
        $this->response->type('application/json');
        $codigo = $this->request->getParam('id');
        $this->loadModel('TipoVeiculo');
        $result = $this->TipoVeiculo->getTIposveiculo($codigo);
        $this->response->body(json_encode(['resultado' => $result]));
    }

    public function getCaminhoesCarregados(){
        $this->response->statusCode(200);
        $this->response->type('application/json');
        $this->loadModel('Checkin');
        $result = $this->Checkin->retornaTotalChegada();
        $this->response->body(json_encode(['resultado' => $result]));
    }

    public function getVeiculosProprios(){
        $this->response->statusCode(200);
        $this->response->type('application/json');
        $this->loadModel('Motorista');
        $result = $this->Motorista->retornaVeiculosProprios();
        $this->response->body(json_encode(['resultado' => $result]));
    }
    
    public function getOrigemDestinoPorTipo(){
        $this->response->statusCode(200);
        $this->response->type('application/json');
        $this->loadModel('Checkin');
        $result = $this->Checkin->origemDestinoPorTipoVeiculo();
        $this->response->body(json_encode(['resultado' => $result]));
    }

    public function getOrigemDestinoMotorista(){
        $this->response->statusCode(200);
        $this->response->type('application/json');
        $this->loadModel('Motorista');
        $result = $this->Motorista->getOrigemDestinoMotorista();
        $this->response->body(json_encode(['resultado' => $result]));
    }

    public function getMotoristaSemCarga(){
        $this->response->statusCode(200);
        $this->response->type('application/json');
        $this->loadModel('Motorista');
        $result = $this->Motorista->getMotoristaSemCarga();
        $this->response->body(json_encode(['resultado' => $result]));
    }

    public function incluirMotorista(){
        $this->response->statusCode(200);
        $this->response->type('application/json');
        $this->loadModel('Motorista');
        $dado = $this->request->data;
        $result = $this->Motorista->incluirMotorista($dado);
        if(!empty($result['erro'])){
            $this->response->statusCode(400);
        }
        $this->response->body(json_encode(['resultado' => $result]));
    }

    public function alterarMotorista(){
        $this->response->statusCode(200);
        $this->response->type('application/json');
        $this->loadModel('Motorista');
        $dado = $this->request->data;
        $result = $this->Motorista->alterarMotorista($dado);
        if(!empty($result['erro'])){
            $this->response->statusCode(400);
        }
        $this->response->body(json_encode(['resultado' => $result]));
        
    }

    
    
}

