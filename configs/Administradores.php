<?php 

require_once("BancoDados.php");
    class Administradores{
        public static function adicionarAdministrador($login,$senha){
            try{
                $conexao=Conexao::getConexao();
                $stmt=$conexao->prepare("INSERT INTO administrador (login,senha) VALUES (?,?)");
                $stmt->execute([$login,$senha]);

                if($stmt->rowCount()>0){
                    return true;
                }else{return false;}

            }
            catch(Exception $e){
                throw $e;
                exit;
            }
           
        }
        public static function verificaLogin($login){
            try{
                $conexao=Conexao::getConexao();
                $stmt=$conexao->prepare("SELECT login FROM administrador WHERE login=?");
                $stmt->execute([$login]);
                if($stmt->rowCount()>0){
                    return true;
                }else{return false;}

            }
            catch(Exception $e){
                throw $e;
                exit;
            }
        }
        public static function verificaSenha($login,$senhaDigitada){
            try{
                $conexao=Conexao::getConexao();
                $stmt=$conexao->prepare("SELECT senha FROM administrador WHERE login=?");
                $stmt->execute([$login]);
                $resultado=$stmt->fetch();

                if($resultado){
                    if(password_verify($senhaDigitada,$resultado["senha"])){
                        $_SESSION['login']=$login;
                        $_SESSION['senha']=$senhaDigitada;
                        return true;
                    }else{return false;}
                }
                else{
                    return false;
                }
            }catch(Exception $e){
                throw $e;
                exit;
            }
        }
    }
