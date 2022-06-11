<?php
require_once ("./configs/header.php");
require_once ("./configs/utils.php");
require_once ("./configs/Administradores.php");
require_once ("./configs/verbs.php");

if(isMetodo("PUT")){
    if(parametrosValidos($_PUT,["login","senha"])){
        $login = $_PUT["login"];
        $senha = $_PUT["senha"];
        $hash = password_hash($senha, PASSWORD_BCRYPT, ["cost" => 12]);
        $verificaLogin = Administradores::verificaLogin($login);
        if($verificaLogin){
            $resposta = [
                "status" => "erro",
                "mensagem" => "Login já existe!"
            ];
            echo json_encode($resposta);
        }else{
           
            
                try{
                    $adicionarAdministrador = Administradores::adicionarAdministrador($login,$hash);
                    if($adicionarAdministrador){
                        $resposta = [
                            "status" => "sucesso",
                            "mensagem" => "Administrador cadastrado com sucesso!"
                        ];
                        header("HTTP/1.1 201 Created");
                        echo json_encode($resposta);
                        session_start();
                        $_SESSION["login"] = $login;
                        $_SESSION["senha"] = $hash;
                        $_SESSION["tipo"] = "administrador";

                    }else{
                        $resposta = [
                            "status" => "erro",
                            "mensagem" => "Erro ao cadastrar administrador!"
                        ];
                        echo json_encode($resposta);
                    }
                }catch(UnexpectedValueException $e){
                    $resposta = [
                        "status" => "erro",
                        "mensagem" => $e->getMessage()
                    ];
                    header("HTTP/1.1 400 Bad Request");
                    echo json_encode($resposta);
                }catch(Exception $e){
                    $resposta = [
                        "status" => "erro",
                        "mensagem" => $e->getMessage()
                    ];
                    header("HTTP/1.1 500 Internal Server Error");
                    echo json_encode($resposta);
                }
            
            
        }
        
    }
    else{
        $resposta = [
            "status" => "erro",
            "mensagem" => "Parametros invalidos!"
        ];
        header("HTTP/1.1 400 Bad Request");
        echo json_encode($resposta);
    }
}
if(isMetodo("POST")){
    if(parametrosValidos($_POST,["login","senha"])){
        $login = $_POST["login"];
        $senha = $_POST["senha"];
        $verificaSenha = Administradores::verificaSenha($login,$senha);
        if($verificaSenha){
            $resposta = [
                "status" => "sucesso",
                "mensagem" => "Login e senha válidos!"
            ];
            echo json_encode($resposta);
            session_start();
            $_SESSION["login"] = $login;
            $_SESSION["senha"] = $senha;
            $_SESSION["tipo"] = "administrador";
        }else{
            $resposta = [
                "status" => "erro",
                "mensagem" => "Login e senha inválidos!"
            ];
            echo json_encode($resposta);
        }
    }
    else{
        $resposta = [
            "status" => "erro",
            "mensagem" => "Parametros invalidos!"
        ];
        header("HTTP/1.1 400 Bad Request");
        echo json_encode($resposta);
    }
}
?>
