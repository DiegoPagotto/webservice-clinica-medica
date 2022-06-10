<?php
require_once ("./configs/Pacientes.php");
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
        $listarPacientes = Pacientes::listarPacientes();
        if(!empty($listarPacientes)){

            $resposta = [
                "status" => "sucesso",
                "pacientes" => $listarPacientes
            ];
            header("HTTP/1.1 200 OK");
            echo json_encode($resposta);
        }else{
            $resposta = [
                "status" => "erro",
                "mensagem" => "Nenhum paciente cadastrado!"
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
}
else if(isMetodo("POST")){
    if(parametrosValidos($_POST,["nome","dataNascimento"])){
        $nome=$_POST["nome"];
        $dataNascimento=$_POST["dataNascimento"];
        try{
            $adicionarPaciente = Pacientes::adicionarPaciente($nome,$dataNascimento);
            if($adicionarPaciente){
                $resposta = [
                    "status" => "sucesso",
                    "mensagem" => "Paciente cadastrado com sucesso!"
                ];
                header("HTTP/1.1 201 Created");
                echo json_encode($resposta);
            }else{
                $resposta = [
                    "status" => "erro",
                    "mensagem" => "Erro ao cadastrar paciente!"
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
    else{
        $resposta = [
            "status" => "erro",
            "mensagem" => "Parametros invalidos!"
        ];
        header("HTTP/1.1 400 Bad Request");
        echo json_encode($resposta);
    }
}
else if(isMetodo("PUT")){
    if(parametrosValidos($_PUT,["id","nome","dataNascimento"])){
        $id=$_PUT["id"];
        $nome=$_PUT["nome"];
        $dataNascimento=$_PUT["dataNascimento"];
        try{
            $atualizarPaciente = Pacientes::editarPaciente($id,$nome,$dataNascimento);
            if($atualizarPaciente){
                $resposta = [
                    "status" => "sucesso",
                    "mensagem" => "Paciente atualizado com sucesso!"
                ];
                header("HTTP/1.1 200 OK");
                echo json_encode($resposta);
            }else{
                $resposta = [
                    "status" => "erro",
                    "mensagem" => "Erro ao atualizar paciente!"
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
    else{
        $resposta = [
            "status" => "erro",
            "mensagem" => "Parâmetros inválidos!"
        ];
        header("HTTP/1.1 400 Bad Request");
        echo json_encode($resposta);
    }
}
else if(isMetodo("DELETE")){
    if(parametrosValidos($_DELETE,["id"])){
        $id=$_DELETE["id"];
        try{
            $deletarPaciente = Pacientes::deletarPaciente($id);
            if($deletarPaciente){
                $resposta = [
                    "status" => "sucesso",
                    "mensagem" => "Paciente deletado com sucesso!"
                ];
                header("HTTP/1.1 200 OK");
                echo json_encode($resposta);
            }else{
                $resposta = [
                    "status" => "erro",
                    "mensagem" => "Erro ao deletar paciente!"
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
    else{
        $resposta = [
            "status" => "erro",
            "mensagem" => "Parâmetros inválidos!"
        ];
        header("HTTP/1.1 400 Bad Request");
        echo json_encode($resposta);
    }
}
else{
    header("HTTP/1.1 405 Method Not Allowed");
    echo json_encode(["status" => "erro", "mensagem" => "Método não permitido!"]);
}

?>