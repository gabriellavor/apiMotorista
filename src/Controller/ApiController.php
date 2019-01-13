<?php
namespace App\Controller;

use Cake\Controller\Controller;

class ApiController extends AppController
{
    

    public function initialize()
    {
        parent::initialize();
        //$this->RequestHandler->respondAs('json');
        //$this->response->type('application/json');  
        $this->autoRender = false; 
    }

    public function getMotoristas(){
        $this->loadModel('Motorista');
        $result = $this->Motorista->getMotoristas();
        echo json_encode(['resultado' => $result]);
    }

    public function getTiposVeiculos(){
        $this->loadModel('TipoVeiculo');
        $result = $this->TipoVeiculo->getTIposveiculos();
        echo json_encode(['resultado' => $result]);
    }

    public function getTiposVeiculo(){
        $codigo = $this->request->getParam('id');
        $this->loadModel('TipoVeiculo');
        $result = $this->TipoVeiculo->getTIposveiculo($codigo);
        echo json_encode(['resultado' => $result]);
    }

    public function getCaminhoesCarregados(){
        $this->loadModel('Checkin');
        $result = $this->Checkin->retornaTotalChegada();
        echo json_encode(['resultado' => $result]);
    }

    public function getVeiculosProprios(){
        $this->loadModel('Motorista');
        $result = $this->Motorista->retornaVeiculosProprios();
        echo json_encode(['resultado' => $result]);
    }
    
    public function getOrigemDestinoPorTipo(){
        $this->loadModel('Checkin');
        $result = $this->Checkin->origemDestinoPorTipoVeiculo();
        echo json_encode(['resultado' => $result]);
    }

    public function getOrigemDestinoMotorista(){
        $this->loadModel('Motorista');
        $result = $this->Motorista->getOrigemDestinoMotorista();
        echo json_encode(['resultado' => $result]);
    }

    public function getMotoristaSemCarga(){
        $this->loadModel('Motorista');
        $result = $this->Motorista->getMotoristaSemCarga();
        echo json_encode(['resultado' => $result]);
    }

    public function incluirMotorista(){
        $this->loadModel('Motorista');
        $dado = $this->request->data;
        $result = $this->Motorista->incluirMotorista($dado);
        echo json_encode(['resultado' => $result]);
    }

    public function alterarMotorista(){
        $this->loadModel('Motorista');
        $dado = $this->request->data;
        $result = $this->Motorista->alterarMotorista($dado);
        echo json_encode(['resultado' => $result]);
    }

    
    
}

