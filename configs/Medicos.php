<?php
    require("./configs/BancoDados.php");

    class Medicos{

        public static function idExiste($id){
            try{
                $conexao=Conexao::getConexao();
                $stmt=$conexao->prepare("SELECT id FROM medico WHERE id=?");
                $stmt->execute([$id]);
                if($stmt->rowCount()>0){
                    return true;
                }else{return false;}
            }catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }

        
        public static function listarMedicos(){
            try{
                $conexao=Conexao::getConexao();
                $stmt=$conexao->prepare("SELECT * FROM medico");
                $stmt->execute();
                $resultado=$stmt->fetchAll();
                return $resultado;
            }
            catch(Exception $e){
                echo $e->getMessage();
                exit;
            }

            
           
        }
        public static function adicionarMedico($nome,$idEspecialidade){
            try{
                $conexao=Conexao::getConexao();
                $stmt=$conexao->prepare("INSERT INTO medico(nome,id_especialidade) VALUES (? ,?)");
                $stmt->execute([$nome,$idEspecialidade]);
                if($stmt->rowCount()>0){
                    return true;
                }
                else{
                    return false;
                }
            }
            catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }
        public static function editarMedico($id,$nome,$idEspecialidade){
            try{
                $conexao=Conexao::getConexao();
                if(self::idExiste($id)){
                    $stmt=$conexao->prepare("UPDATE medico SET nome=?,id_especialidade=? WHERE id=?");
                    $stmt->execute([$nome,$idEspecialidade,$id]);
                    if($stmt->rowCount()>0){
                        return true;
                    }
                    else{
                        return false;
                    }
                }
                else{
                    return false;
                }
            }
            catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }
        public static function removerMedico($id){
            try{
                $conexao=Conexao::getConexao();
                if(self::idExiste($id)){
                    $stmt=$conexao->prepare("DELETE FROM medico WHERE id=?");
                    $stmt->execute([$id]);
                    if($stmt->rowCount()>0){
                        return true;
                    }
                    else{
                        return false;
                    }
                }
                else{
                    throw new UnexpectedValueException("Id não encontrado");
                }
            }
            catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }
    }

?>
