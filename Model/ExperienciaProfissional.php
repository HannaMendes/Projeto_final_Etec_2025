<?php

class ExperienciaProfissional
{
    private $id;
    private $usuario_id;
    private $inicio;
    private $fim;
    private $empresa;
    private $descricao;
    
    // ID
    public function setID($id)
    {
        $this->id = $id;
    }
    public function getID()
    {
        return $this->id;
    }

    // usuario_id
    public function setUsuarioId($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }
    public function getUsuarioId()
    {
        return $this->usuario_id;
    }

    // inicio
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;
    }
    public function getInicio()
    {
        return $this->inicio;
    }

    // fim
    public function setFim($fim)
    {
        $this->fim = $fim;
    }
    public function getFim()
    {
        return $this->fim;
    }

    // Empresa
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    }
    public function getEmpresa()
    {
        return $this->empresa;
    }

    // Descrição
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }

    // Métodos Banco de Dados
    public function inserirBD()
    {
        require_once 'ConexaoBD.php';   
        
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO experienciaprofissional (usuario_id, inicio, fim, empresa, descricao) 
                VALUES ('".$this->usuario_id."','".$this->inicio."','".$this->fim."','".$this->empresa."','".$this->descricao."')";

        if ($conn->query($sql) === true) {
            $this->id = mysqli_insert_id($conn);
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }
    }

    public function excluirBD($id)
    {
        require_once 'ConexaoBD.php';   
        
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "DELETE FROM experienciaprofissional WHERE idexperienciaprofissional = '".$id."';";

        if ($conn->query($sql) === true) {
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }
    }

    public function listaExperiencias($usuario_id)
    {
        require_once 'ConexaoBD.php';   
        
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "SELECT * FROM experienciaprofissional WHERE usuario_id = '".$usuario_id."'";
        $re = $conn->query($sql);
        $conn->close();
        return $re;
    }
}
?>
