<?php
/**
 * Created by PhpStorm.
 * User: guilh
 * Date: 20/11/2018
 * Time: 09:32
 */

include_once ('ConexaoDB.php');

// FUNCIONA INSERT ~~~ FALTA FAZER O RESTO


class SessaoPDO
{

    private $conn;
    private $salaPDO;
    private $filmePDO;

    public function __construct()
    {
        $this->conn = ConexaoDB::getInstance();
        $this->salaPDO = new SalaPDO();
        $this->filmePDO = new FilmePDO();
    }

    public function insert($sessao)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO sessoes (data_sessao, hora_sessao, valor_inteira, valor_meia, id_filme, id_sala, encerrada) VALUES (?, ?, ?, ?, ?, ?, false)");

            $stmt->bindValue(1, $sessao->getDataSessao());
            $stmt->bindValue(2, $sessao->getHoraSessao());
            $stmt->bindValue(3, $sessao->getValorInteira());
            $stmt->bindValue(4, $sessao->getValorMeia());
            $stmt->bindValue(5, $sessao->getFilme()->getIdFilme());
            $stmt->bindValue(6, $sessao->getSala()->getIdSala());



            return $stmt->execute();

        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
            return false;
        }

        return false;
    }

    public function delete($sessao) {
        try {
            //prepara o sql para executar no banco de dados
            $stmt = $this->conn->prepare("UPDATE sessoes SET encerrada = true WHERE id_sessao=?");
            $stmt->bindValue(1, $sessao->getId());
            return $stmt->execute();
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
            return false;
        }
    }

    public function findAll() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM sessoes WHERE encerrada = FALSE ORDER BY id_sessao");
            if ($stmt->execute()) {
                $sessoes = Array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    array_push($sessoes, $this->resultSetToSessao($rs));
                }
                return $sessoes;
            } else {
                echo "Erro: Não foi possível recuperar os dados do banco de dados";
                return null;
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
            return null;
        }
    }

    public function update($sessao){
        try{
            //prepara o sql para executar no banco de dados
            $stmt = $this->conn->prepare("UPDATE sessoes SET data_sessao=?, hora_sessao=?, valor_inteira=?, valor_meia=?, encerrada=FALSE, id_filme=?, id_sala=? WHERE id_sessao = ?");
            $stmt->bindValue(1, $sessao->getDataSessao());
            $stmt->bindValue(2, $sessao->getHoraSessao());
            $stmt->bindValue(3, $sessao->getValorInteira());
            $stmt->bindValue(4, $sessao->getValorMeia());
            $stmt->bindValue(5, $sessao->getFilme()->getIdFilme());
            $stmt->bindValue(6, $sessao->getSala()->getIdSala());
            $stmt->bindValue(7, $sessao->getId());


            return $stmt->execute();
        } catch (PDOException $ex) {
            echo "Exceção: " . $ex->getMessage();
            return false;
        }
    }


    public function findById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM sessoes WHERE id_sessao=?");
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                if($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    return $this->resultSetToSessao($rs);
                }else{
                    return null;
                }
            } else {
                echo "Erro: Não foi possível recuperar os dados do banco de dados";
                return null;
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
            return null;
        }
    }


    private function resultSetToSessao($rs) {
        $sessao = new Sessao();
        $sessao->setId($rs->id_sessao);
        $sessao->setDataSessao($rs->data_sessao);
        $sessao->setHoraSessao($rs->hora_sessao);
        $sessao->setValorInteira($rs->valor_inteira);
        $sessao->setValorMeia($rs->valor_meia);
        $sessao->setEncerrada($rs->encerrada);

        $sessao->setSala($this->salaPDO->findById($rs->id_sala));
        $sessao->setFilme($this->filmePDO->findById(($rs->id_filme)));

        return $sessao;
    }


}
