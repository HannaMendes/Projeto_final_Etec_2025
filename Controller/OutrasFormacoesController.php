<?php

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
class OutrasFormacoesController{
    
    public function inserir($inicio, $fim, $descricao,$idusuario) {
        if(file_exists(__DIR__ . '/../Model/OutrasFormacoes.php')) {
            require_once __DIR__ . '/../Model/OutrasFormacoes.php';
        } else {
            require_once 'Model/OutrasFormacoes.php';
        }
        $formacao = new OutrasFormacoes();
        $formacao->setInicio($inicio);
        $formacao->setFim($fim);
        $formacao->setDescricao($descricao); 
        $formacao->setIdUsuario($idusuario);    
        $r = $formacao->inserirBD();
   
        return $r;     
    }
    public function remover($id) {
        require_once '../Model/OutrasFormacoes.php';
        $formacao = new OutrasFormacoes();
        $r = $formacao->excluirBD($id);
        return $r;     
    }
    public function gerarLista($idusuario)
    {
        require_once '../Model/OutrasFormacoes.php';
        $formacao = new OutrasFormacoes();
        
        return $results = $formacao->listaFormacoes($idusuario);
       
        
        
    }
}

?>