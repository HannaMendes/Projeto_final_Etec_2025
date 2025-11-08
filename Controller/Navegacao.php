<?php
    session_start();

    // Detectar o diretório base correto
    $currentDir = __DIR__;
    $projectRoot = dirname($currentDir);

    // Se estamos no diretório Controller, voltar um nível
    if (basename($currentDir) === 'Controller') {
        $basePath = '../';
    } else {
        $basePath = '';
    }

    if(isset($_POST["btnPrimeiroAcesso"])) {
        include_once $basePath . 'View/primeiroAcesso.php';
    }
    else if(isset($_POST["btnLogin"])) {
        require_once $basePath . 'Controller/UsuarioController.php';
    
        $uController = new UsuarioController();
        
        if($uController->login($_POST['txtLogin'], $_POST['txtSenha'])) {           
            include_once $basePath . 'View/principal.php';
        } else {
            include_once $basePath . 'View/cadastroNaoRealizado.php';
        }
    }
    else if(isset($_POST["btnADM"])) {
        include_once $basePath . 'View/ADMLogin.php';
    }
    else if(isset($_POST["btnCadastrar"])) {
        require_once $basePath . 'Controller/UsuarioController.php';
        $uController = new UsuarioController();
        
        if($uController->inserir($_POST["txtNome"], $_POST["txtCPF"], $_POST["txtEmail"], $_POST['txtSenha'])) {           
            include_once $basePath . 'View/cadastroRealizado.php';
        } else {
            include_once $basePath . 'View/cadastroNaoRealizado.php';
        }
    }
    else if(isset($_POST["btnCadRealizado"])) {
        include_once $basePath . 'View/principal.php';
    }
    else if(isset($_POST["btnCadNRealizado"])) {
        include_once $basePath . 'View/primeiroAcesso.php';
    }
    else if(isset($_POST["btnAtualizar"])) {
        require_once $basePath . 'Controller/UsuarioController.php';
    
        $uController = new UsuarioController();
        
        if($uController->atualizar($_POST["txtID"], $_POST["txtNome"], $_POST["txtCPF"], $_POST["txtEmail"],
        date('Y-m-d', strtotime($_POST['txtData'])))) {           
            include_once $basePath . 'View/atualizacaoRealizada.php';
        } else {
            include_once $basePath . 'View/operacaoNaoRealizada.php';
        }
    }
    else if(isset($_POST["btnAddFormacao"])) {
        require_once $basePath . 'Controller/FormacaoAcadController.php';
        include_once $basePath . 'Model/Usuario.php';
    
        $fController = new FormacaoAcadController();
        
        if($fController->inserir(
            date('Y-m-d', strtotime($_POST['txtInicioFA'])),
            date('Y-m-d', strtotime($_POST["txtFimFA"])),
            $_POST["txtDescFA"],
            unserialize($_SESSION['Usuario'])->getID()
        )) {           
            include_once $basePath . 'View/cadastroRealizado.php';
        } else {
            include_once $basePath . 'View/cadastroNaoRealizado.php';
        }
    }
    else if(isset($_POST["btnExcluirFA"])) {
        require_once $basePath . 'Controller/FormacaoAcadController.php';
        include_once $basePath . 'Model/Usuario.php';
    
        $fController = new FormacaoAcadController();
        
        if($fController->remover($_POST['id'])) {           
            include_once $basePath . 'View/informacaoExcluida.php';
        } else {
            include_once $basePath . 'View/operacaoNaoRealizada.php';
        }
    }
    else if(isset($_POST["btnAddEP"])) {
        require_once $basePath . 'Controller/ExperienciaProfissionalController.php';
        include_once $basePath . 'Model/Usuario.php';
    
        $epController = new ExperienciaProfissionalController();
        
        if($epController->inserir(
            date('Y-m-d', strtotime($_POST['txtInicioEP'])),
            date('Y-m-d', strtotime($_POST["txtFimEP"])),
            $_POST["txtEmpEP"], $_POST["txtDescEP"],
            unserialize($_SESSION['Usuario'])->getID()
        )) {           
            include_once $basePath . 'View/informacaoInserida.php';
        } else {
            include_once $basePath . 'View/operacaoNaoRealizada.php';
        }
    }
    else if(isset($_POST["btnExcluirEP"])) {
        require_once $basePath . 'Controller/ExperienciaProfissionalController.php';
        include_once $basePath . 'Model/Usuario.php';
    
        $epController = new ExperienciaProfissionalController();
        
        if($epController->remover($_POST['idEP'])) {           
            include_once $basePath . 'View/informacaoExcluida.php';
        } else {
            include_once $basePath . 'View/operacaoNaoRealizada.php';
        }
    }
    else if(isset($_POST["btnAddOF"])) {
        require_once $basePath . 'Controller/OutrasFormacoesController.php';
        include_once $basePath . 'Model/Usuario.php';
    
        $fController = new OutrasFormacoesController();
        
        if($fController->inserir(
            date('Y-m-d', strtotime($_POST['txtInicioOF'])),
            date('Y-m-d', strtotime($_POST["txtFimOF"])),
            $_POST["txtDescOF"],
            unserialize($_SESSION['Usuario'])->getID()
        )) {           
            include_once $basePath . 'View/informacaoInserida.php';
        } else {
            include_once $basePath . 'View/operacaoNaoRealizada.php';
        }
    }
    else if(isset($_POST["btnExcluirOF"])) {
        require_once $basePath . 'Controller/OutrasFormacoesController.php';
        include_once $basePath . 'Model/Usuario.php';
    
        $fController = new OutrasFormacoesController();
        
        if($fController->remover($_POST['id'])) {           
            include_once $basePath . 'View/informacaoExcluida.php';
        } else {
            include_once $basePath . 'View/operacaoNaoRealizada.php';
        }
    }
    else if(isset($_POST["btnLoginADM"])) {
        require_once $basePath . 'Controller/AdministradorController.php';
    
        $aController = new AdministradorController();
        
        if($aController->login($_POST['txtLoginADM'], $_POST['txtSenhaADM'])) {           
            include_once $basePath . 'View/ADMPrincipal.php';
        } else {
            include_once $basePath . 'View/cadastroNaoRealizado.php';
        }
    }
    else if(isset($_POST["btnListarCadastrados"]) || isset($_POST["btnVoltarLista"])) {
        include_once $basePath . 'View/ADMListarCadastrados.php';
    }
    else if(isset($_POST["btnListarAdministradores"])) {
        include_once $basePath . 'View/ADMListarAdministradores.php';
    }
    else if(isset($_POST["btnVoltar"])) {
        include_once $basePath . 'View/ADMPrincipal.php';
    }
    else if(isset($_POST["btnVisualizar"])) {
        $_SESSION["IDUsuario"] = $_POST['id'];
        include_once $basePath . 'View/ADMVisualizarCadastro.php';
    }
    else if(isset($_POST["btnPrincipal"]) || isset($_POST["btnAtualizacaoCadastro"]) || isset($_POST["btnCadRealizado"])
         || isset($_POST["btnInfInserir"]) || isset($_POST["btnInfExcluir"])) {
        include_once $basePath . 'View/principal.php';
    }
    else {
        include_once $basePath . 'View/login.php';
    }
?>
