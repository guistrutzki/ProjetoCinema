<?php
/**
 * Created by PhpStorm.
 * User: guilh
 * Date: 20/11/2018
 * Time: 09:32
 */

include_once ('ConexaoDB.php');

class SalaPDO {

    private $conn;

    public function __construct()
    {
        $this->conn = ConexaoDB::getInstance();
    }

    public function insert($sala){
        try{
            $stmt = $this->conn->prepare("INSERT INTO salas (num_sala, capacidade, deletado) VALUES (?, ?, FALSE)");

            $stmt->bindValue(1, $sala->getNumSala());
            $stmt->bindValue(2, $sala->getCapacidade());


            return $stmt->execute();

        }catch (PDOException $ex){
            echo "Erro: ". $ex->getMessage();
            return false;
        }

        return false;
    }


    public function delete($sala) {
        try {
            //prepara o sql para executar no banco de dados
            $stmt = $this->conn->prepare("UPDATE salas SET deletado=TRUE WHERE id_sala=?");

            $stmt->bindValue(1, $sala->getIdSala());
            return $stmt->execute();
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
            return false;
        }

        return false;
    }


    public function findAll() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM salas WHERE deletado=FALSE ORDER BY id_sala ");
            if ($stmt->execute()) {
                $salas = Array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    array_push($salas, $this->resultSetToSala($rs));
                }
                return $salas;
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
            $stmt = $this->conn->prepare("SELECT * FROM salas WHERE id_sala=?");
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                if($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    return $this->resultSetToSala($rs);
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


    public function findByNome($sala) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM salas WHERE num_sala = ?");
            $stmt->bindValue(1, $sala);
            if ($stmt->execute()) {
                $salas = Array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    array_push($salas, $this->resultSetToSala($rs));
                }
                return $salas;
            }
        } catch (PDOException $ex) {
            echo "Exceção: " . $ex->getMessage();
            return null;
        }
    }


    public function update($sala){
        try{
            //prepara o sql para executar no banco de dados
            $stmt = $this->conn->prepare("UPDATE salas SET num_sala=?, capacidade=?, deletado = FALSE  WHERE id_sala = ?");

            $stmt->bindValue(1, $sala->getNumSala());
            $stmt->bindValue(2, $sala->getCapacidade());
            $stmt->bindValue(3, $sala->getIdSala());
            return $stmt->execute();
        } catch (PDOException $ex) {
            echo "Exceção: " . $ex->getMessage();
            return false;
        }
    }

    private function resultSetToSala($rs) {
        $sala = new Sala();
        $sala->setIdSala($rs->id_sala);
        $sala->setNumSala($rs->num_sala);
        $sala->setCapacidade($rs->capacidade);
        $sala->setDeletado($rs->deletado);

        return $sala;
    }

}