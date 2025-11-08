<?php

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
class UsuarioController{
    
    
    public function inserir($nome, $cpf, $email,$senha) {
        if(file_exists(__DIR__ . '/../Model/Usuario.php')) {
            require_once __DIR__ . '/../Model/Usuario.php';
        } else {
            require_once 'Model/Usuario.php';
        }
        $usuario = new Usuario();
        $usuario->setNome($nome);
        $usuario->setCPF($cpf);
        $usuario->setEmail($email); 
        $usuario->setSenha($senha);    
        //return $usuario->getNome();
        $r = $usuario->inserirBD();
        $_SESSION['Usuario'] = serialize($usuario);
        return $r;     
    }

    public function atualizar($id, $nome, $cpf, $email, $dataNascimento) {
        if(file_exists(__DIR__ . '/../Model/Usuario.php')) {
            require_once __DIR__ . '/../Model/Usuario.php';
        } else {
            require_once 'Model/Usuario.php';
        }
        $usuario = new Usuario();
        $usuario->setId($id);
        $usuario->setNome($nome);
        $usuario->setCPF($cpf);
        $usuario->setEmail($email);
        $usuario->setDataNascimento($dataNascimento);
        $r = $usuario->atualizarBD();
        $_SESSION['Usuario'] = serialize($usuario);
        return $r;
    }
    public function login($cpf, $senha)
    {
        if(file_exists(__DIR__ . '/../Model/Usuario.php')) {
            require_once __DIR__ . '/../Model/Usuario.php';
        } else {
            require_once 'Model/Usuario.php';
        }
        $usuario = new Usuario();
        $usuario->carregarUsuario($cpf);
        if($usuario->getSenha() == $senha)
        {
            $_SESSION['Usuario'] = serialize($usuario);
            return true;
        }
        else
        {
            return false;
        }
        
        
    }
    public function gerarLista()
    {
        if(file_exists(__DIR__ . '/../Model/Usuario.php')) {
            require_once __DIR__ . '/../Model/Usuario.php';
        } else {
            require_once 'Model/Usuario.php';
        }
        
        if(file_exists(__DIR__ . '/../Model/ConexaoBD.php')) {
            require_once __DIR__ . '/../Model/ConexaoBD.php';
        } else {
            require_once 'Model/ConexaoBD.php';
        }
        
        $con = new ConexaoBD();
        $conn = $con->conectar();
        
        if ($conn->connect_error) {
            return false;
        }
        
        $sql = "SELECT idusuario, nome, cpf, email FROM usuario ORDER BY nome";
        $result = $conn->query($sql);
        $conn->close();
        
        return $result;
    }
}

?>