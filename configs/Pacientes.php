<?php 
    require("./configs/BancoDados.php");
    class Pacientes{
        public static function idExiste($id){
            try{
                $conexao=Conexao::getConexao();
                $stmt=$conexao->prepare("SELECT id FROM paciente WHERE id=?");
                $stmt->execute([$id]);
                if($stmt->rowCount()>0){
                    return true;
                }else{return false;}
            }catch(Exception $e){
                throw $e;
                exit;
            }
        }
        public static function listarPacientes(){
            try{
                $conexao=Conexao::getConexao();
                $stmt=$conexao->prepare("SELECT * FROM paciente");
                $stmt->execute();
                $resultado=$stmt->fetchAll();
                return $resultado;
            }
            catch(Exception $e){
                throw $e;
                exit;
            }
        }
        public static function adicionarPaciente($nome,$dataNascimento){
            try{
                $conexao=Conexao::getConexao();
                $stmt=$conexao->prepare("INSERT INTO paciente(nome,data_nascimento) VALUES (?,?)");
                $stmt->execute([$nome,$dataNascimento]);
                if($stmt->rowCount()>0){
                    return true;
                }else{
                    return false;
                }

            }catch(Exception $e){
                throw $e;
                exit;
            }
          
        }
        public static function editarPaciente($id,$nome,$dataNascimento){
            try{
                $conexao=Conexao::getConexao();
                if(self::idExiste($id)){
                    $stmt=$conexao->prepare("UPDATE paciente SET nome=?,data_nascimento=? WHERE id=?");
                    $stmt->execute([$nome,$dataNascimento,$id]);
                    if($stmt->rowCount()>0){
                        return true;
                    }else{
                        return false;
                    }
                }
                else{
                    throw new UnexpectedValueException("Id não encontrado");
                    exit;
                }
                
            
            }catch(Exception $e){
                throw $e;
                exit;
            }
        }
        public static function deletarPaciente($id){
            try{
                $conexao=Conexao::getConexao();
                if(self::idExiste($id)){
                    $stmt=$conexao->prepare("DELETE FROM paciente WHERE id=?");
                    $stmt->execute([$id]);
                    if($stmt->rowCount()>0){
                        return true;
                    }else{
                        return false;
                    }
                }
                else{
                    throw new UnexpectedValueException("Id não encontrado");
                    exit;
                }
            }
            catch(Exception $e){
                throw $e;
                exit;
            }

        }
      
    }
?>