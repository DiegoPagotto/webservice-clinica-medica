<?php 
require_once("./configs/Medicos.php");
require_once("./configs/header.php");
require_once("./configs/utils.php");
require_once("./configs/verbs.php");
session_start();

if(!isset($_SESSION['tipo'])){
    header("HTTP/1.1 401 Unauthorized");
    echo json_encode([
        "status" => "erro",
        "mensagem" => "Você não tem permissão para acessar essa página!"
    ]);
    exit;
}
if(isMetodo("GET")){
    try{
        $listarMedicos = Medicos::listarMedicos();
        if(!empty($listarMedicos)){

            $resposta = [
                "status" => "sucesso",
                "pacientes" => $listarMedicos
            ];
            header("HTTP/1.1 200 OK");
            echo json_encode($resposta);
        }else{
            $resposta = [
                "status" => "erro",
                "mensagem" => "Nenhum medico cadastrado!"
            ];
            echo json_encode($resposta);
            exit;
        }
    }catch(Exception $e){
        $resposta = [
            "status" => "erro",
            "mensagem" => $e->getMessage()
        ];
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode($resposta);
        exit;
    }
}
else if(isMetodo("POST")){
    if(parametrosValidos($_POST,["nome","id_especialidade"])){
        $nome=$_POST["nome"];
        $idEspecialidade=$_POST["id_especialidade"];
        try{
            $adicionarMedico = Medicos::adicionarMedico($nome,$idEspecialidade);
            if($adicionarMedico){
                $resposta = [
                    "status" => "sucesso",
                    "mensagem" => "Medico cadastrado com sucesso!"
                ];
                header("HTTP/1.1 201 Created");
                echo json_encode($resposta);
            }else{
                $resposta = [
                    "status" => "erro",
                    "mensagem" => "Erro ao cadastrar medico!"
                ];
                echo json_encode($resposta);
            }
        }catch(Exception $e){
            $resposta = [
                "status" => "erro",
                "mensagem" => $e->getMessage()
            ];
            header("HTTP/1.1 500 Internal Server Error");
            echo json_encode($resposta);
            exit;
        }
        catch(UnexpectedValueException $e){
            $resposta = [
                "status" => "erro",
                "mensagem" => $e->getMessage()
            ];
            header("HTTP/1.1 400 Bad Request");
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
else if (isMetodo("PUT")) {
    if(parametrosValidos($_PUT,["id","nome","id_especialidade"])){
        try{
            $idMedico=$_PUT["id"];
            $nome=$_PUT["nome"];
            $idEspecialidade=$_PUT["id_especialidade"];
            $atualizarMedico = Medicos::editarMedico($idMedico,$nome,$idEspecialidade);
            if($atualizarMedico){
                $resposta = [
                    "status" => "sucesso",
                    "mensagem" => "Medico atualizado com sucesso!"
                ];
                header("HTTP/1.1 200 OK");
                echo json_encode($resposta);
            }else{
                $resposta = [
                    "status" => "erro",
                    "mensagem" => "Erro ao atualizar medico!"
                ];
                echo json_encode($resposta);
            }
        }catch(Exception $e){
            $resposta = [
                "status" => "erro",
                "mensagem" => $e->getMessage()
            ];
            header("HTTP/1.1 500 Internal Server Error");
            echo json_encode($resposta);
            exit;
        }
        catch(UnexpectedValueException $e){
            $resposta = [
                "status" => "erro",
                "mensagem" => $e->getMessage()
            ];
            header("HTTP/1.1 400 Bad Request");
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
else if(isMetodo("DELETE")){
    if(parametrosValidos($_DELETE,["id"])){
        try{
            $idMedico=$_DELETE["id"];
            $deletarMedico = Medicos::removerMedico($idMedico);
            if($deletarMedico){
                $resposta = [
                    "status" => "sucesso",
                    "mensagem" => "Medico deletado com sucesso!"
                ];
                header("HTTP/1.1 200 OK");
                echo json_encode($resposta);
            }else{
                $resposta = [
                    "status" => "erro",
                    "mensagem" => "Erro ao deletar medico!"
                ];
                echo json_encode($resposta);
            }
        }catch(Exception $e){
            $resposta = [
                "status" => "erro",
                "mensagem" => $e->getMessage()
            ];
            header("HTTP/1.1 500 Internal Server Error");
            echo json_encode($resposta);
            exit;
        }
        catch(UnexpectedValueException $e){
            $resposta = [
                "status" => "erro",
                "mensagem" => $e->getMessage()
            ];
            header("HTTP/1.1 400 Bad Request");
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

else{
    $resposta = [
        "status" => "erro",
        "mensagem" => "Metodo não encontrado!"
    ];
    header("HTTP/1.1 400 Bad Request");
    echo json_encode($resposta);
}
?>