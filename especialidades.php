<?php

require_once("./configs/header.php");
require_once("./configs/utils.php");
require_once("./configs/Especialidades.php");
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
        $listarEspecialidades = Especialidades::listarEspecialidades();
        if(!empty($listarEspecialidades)){

            $resposta = [
                "status" => "sucesso",
                "especialidades" => $listarEspecialidades
            ];
            header("HTTP/1.1 200 OK");
            echo json_encode($resposta);
        }else{
            $resposta = [
                "status" => "erro",
                "mensagem" => "Nenhuma especialidade cadastrada!"
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
        "mensagem" => "Metodo não encontrado!"
    ];
    header("HTTP/1.1 404 Not Found");
    echo json_encode($resposta);
    exit;
}
?>