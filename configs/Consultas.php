<?php 
    require("./configs/BancoDados.php");
    class Consultas{

        public static function idExiste($id){
            try{
                $conexao=Conexao::getConexao();
                $stmt=$conexao->prepare("SELECT id FROM consulta WHERE id=?"); 
                $stmt->execute([$id]);
                if($stmt->rowCount()>0){
                    return true;
                }else{return false;}

            }catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
          
        }
        public static function listarConsultas(){
            try{
                $conexao=Conexao::getConexao();
                $stmt=$conexao->prepare("SELECT * FROM consulta");
                $stmt->execute();
                $resultado=$stmt->fetchAll();
                return $resultado;
            }catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }
        public static function adicionarConsulta($idPaciente,$idMedico,$data){
            try{
                $conexao=Conexao::getConexao();
                $stmt=$conexao->prepare("INSERT INTO consulta (id_paciente,id_medico,data_consulta) VALUES (?,?,?)");
                $stmt->execute([$idPaciente,$idMedico,$data]);
                if($stmt->rowCount()>0){
                    return true;
                }
                else{
                    return false;
                }
            }catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }
        public static function atualizarConsulta($id,$idPaciente,$idMedico,$data){
            try{
                $conexao=Conexao::getConexao();
                if(self::idExiste($id)){
                    $stmt=$conexao->prepare("UPDATE consulta SET id_paciente=?,id_medico=?,data_consulta=? WHERE id=?");
                    $stmt->execute([$idPaciente,$idMedico,$data,$id]);
                    if($stmt->rowCount()>0){
                        return true;
                    }
                    else{
                        return false;
                    }
                }else{
                    return false;
                }
              
            }catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }
        public static function deletarConsulta($id){
            try{
                $conexao=Conexao::getConexao();
                if(self::idExiste($id)){
                    $stmt=$conexao->prepare("DELETE FROM consulta WHERE id=?");
                    $stmt->execute([$id]);
                    if($stmt->rowCount()>0){
                        return true;
                    }
                    else{
                        return false;
                    }

                }
                else{
                    throw new UnexpectedValueException("Consulta não existe");
                }
            }catch(Exception $e){
                echo $e->getMessage();
                exit;   
            }
        }
        
    }
?>
