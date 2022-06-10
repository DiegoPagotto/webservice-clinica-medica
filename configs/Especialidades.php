<?php 
    require("./configs/BancoDados.php");

    class Especialidades{
        public static function listarEspecialidades(){
            try{
                $conexao=Conexao::getConexao();
                $stmt=$conexao->prepare("SELECT * FROM especialidade");
                $stmt->execute();   
                $resultado=$stmt->fetchAll();
                return $resultado;
            }
            catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }
    }
?>