<?php
/**
 * Created by PhpStorm.
 * User: guilh
 * Date: 20/11/2018
 * Time: 09:32
 */

include_once ('ConexaoDB.php');



// FUNCIONA INSERT ~~~ FALTA FAZER O RESTO

class IngressoPDO {

    private $conn;
    private $sessaoPDO;

    public function __construct()
    {
        $this->conn = ConexaoDB::getInstance();
        $this->sessaoPDO = new SessaoPDO();
    }

    public function insert($ingresso){
        try{
            $stmt = $this->conn->prepare("INSERT INTO ingressos (tipo, fileira, assento, sessao) VALUES (?, ?, ?, ?)");

            $stmt->bindValue(1, $ingresso->getTipo());
            $stmt->bindValue(2, $ingresso->getFileira());
            $stmt->bindValue(3, $ingresso->getAssento());
            $stmt->bindValue(4, $ingresso->getSessao()->getId());

            return $stmt->execute();

        }catch (PDOException $ex){
            echo "Erro: ". $ex->getMessage();
            return false;
        }

        return false;
    }

    public function findAll() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM ingressos ORDER BY id_ingresso");
            if ($stmt->execute()) {
                $ingressos = Array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    array_push($ingressos, $this->resultSetToIngresso($rs));
                }
                return $ingressos;
            } else {
                echo "Erro: Não foi possível recuperar os dados do banco de dados";
                return null;
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
            return null;
        }
    }

    public function findById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM ingressos WHERE sessao=? ORDER BY id_ingresso ");
            $stmt->bindValue(1, $id);
            if ($stmt->execute()) {
                $ingressos = Array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    array_push($ingressos, $this->resultSetToIngresso($rs));
                }
                return $ingressos;
            } else {
                echo "Erro: Não foi possível recuperar os dados do banco de dados";
                return null;
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
            return null;
        }
    }

    private function resultSetToIngresso($rs) {
        $ingresso = new Ingresso();
        $ingresso->setIdIngresso($rs->id_ingresso);
        $ingresso->setFileira($rs->fileira);
        $ingresso->setAssento($rs->assento);
        $ingresso->setTipo($rs->tipo);
        $ingresso->setSessao($this->sessaoPDO->findById($rs->sessao));



        return $ingresso;
    }



}