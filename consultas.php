<?php 
require_once("./configs/header.php");
require_once("./configs/utils.php");
require_once("./configs/Consultas.php");
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
        $listarConsultas = Consultas::listarConsultas();
        if(!empty($listarConsultas)){
            $resposta = [
                "status" => "sucesso",
                "consultas" => $listarConsultas
            ];
            header("HTTP/1.1 200 OK");
            echo json_encode($resposta);
        }else{
            $resposta = [
                "status" => "erro",
                "mensagem" => "Nenhuma consulta cadastrada!"
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
if(isMetodo("POST")){
    if(parametrosValidos($_POST,["idPaciente","idMedico","data"])){
        try{
            $idPaciente=$_POST["idPaciente"];
            $idMedico=$_POST["idMedico"];
            $data=$_POST["data"];
            $adicionarConsulta = Consultas::adicionarConsulta($idPaciente,$idMedico,$data);
            if($adicionarConsulta){
                $resposta = [
                    "status" => "sucesso",
                    "mensagem" => "Consulta cadastrada com sucesso!"
                ];
                header("HTTP/1.1 201 Created");
                echo json_encode($resposta);
            }else{
                $resposta = [
                    "status" => "erro",
                    "mensagem" => "Erro ao cadastrar consulta!"
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
    else{
        $resposta = [
            "status" => "erro",
            "mensagem" => "Parametros invalidos!"
        ];
        header("HTTP/1.1 400 Bad Request");
        echo json_encode($resposta);
        exit;
    }
}
elseif(isMetodo("PUT")){
    if(parametrosValidos($_PUT,["id","idPaciente","idMedico","data"])){
        try{
            $idConsulta=$_PUT["id"];
            $idPaciente=$_PUT["idPaciente"];
            $idMedico=$_PUT["idMedico"];
            $data=$_PUT["data"];
            $atualizarConsulta = Consultas::atualizarConsulta($idConsulta,$idPaciente,$idMedico,$data);
            if($atualizarConsulta){
                $resposta = [
                    "status" => "sucesso",
                    "mensagem" => "Consulta atualizada com sucesso!"
                ];
                header("HTTP/1.1 200 OK");
                echo json_encode($resposta);
            }else{
                $resposta = [
                    "status" => "erro",
                    "mensagem" => "Erro ao atualizar consulta!"
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
    else{
        $resposta = [
            "status" => "erro",
            "mensagem" => "Parametros invalidos!"
        ];
        header("HTTP/1.1 400 Bad Request");
        echo json_encode($resposta);
        exit;
    }
}
elseif(isMetodo("DELETE")){
    if(parametrosValidos($_DELETE,["id"])){
        try{
            $idConsulta=$_DELETE["id"];
            $deletarConsulta = Consultas::deletarConsulta($idConsulta);
            if($deletarConsulta){
                $resposta = [
                    "status" => "sucesso",
                    "mensagem" => "Consulta deletada com sucesso!"
                ];
                header("HTTP/1.1 200 OK");
                echo json_encode($resposta);
            }else{
                $resposta = [
                    "status" => "erro",
                    "mensagem" => "Erro ao deletar consulta!"
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
    else{
        $resposta = [
            "status" => "erro",
            "mensagem" => "Parametros invalidos!"
        ];
        header("HTTP/1.1 400 Bad Request");
        echo json_encode($resposta);
        exit;
    }
}
?>