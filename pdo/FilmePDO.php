<?php
/**
 * Created by PhpStorm.
 * User: guilh
 * Date: 20/11/2018
 * Time: 09:32
 */

include_once ('ConexaoDB.php');


class FilmePDO
{

    private $conn;

    public function __construct()
    {
        $this->conn = ConexaoDB::getInstance();
    }

    public function insert($filme)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO filmes (titulo, duracao, deletado) VALUES (?, ?, false)");

            $stmt->bindValue(1, $filme->getTitulo());
            $stmt->bindValue(2, $filme->getDuracao());

            return $stmt->execute();

        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
            return false;
        }

        return false;
    }


    public function delete($filme) {
        try {
            //prepara o sql para executar no banco de dados
            $stmt = $this->conn->prepare("UPDATE filmes SET deletado=TRUE WHERE id_filme=?");

            $stmt->bindValue(1, $filme->getIdFilme());
            return $stmt->execute();
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
            return false;
        }

        return false;
    }


    public function update($filme){
        try{
            //prepara o sql para executar no banco de dados
            $stmt = $this->conn->prepare("UPDATE filmes SET titulo=?, duracao=?, deletado = FALSE  WHERE id_filme = ?");

            $stmt->bindValue(1, $filme->getTitulo());
            $stmt->bindValue(2, $filme->getDuracao());
            $stmt->bindValue(3, $filme->getIdFilme());
            return $stmt->execute();
        } catch (PDOException $ex) {
            echo "Exceção: " . $ex->getMessage();
            return false;
        }
    }

    public function findAll() {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM filmes WHERE deletado=FALSE ORDER BY id_filme ");
            if ($stmt->execute()) {
                $filmes = Array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    array_push($filmes, $this->resultSetToFilme($rs));
                }
                return $filmes;
            } else {
                echo "Erro: Não foi possível recuperar os dados do banco de dados";
                return null;
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
            return null;
        }
    }

    public function findByNome($filme) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM filmes WHERE titulo LIKE ? ORDER BY titulo");
            $stmt->bindValue(1, $filme . '%');
            if ($stmt->execute()) {
                $filmes = Array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    array_push($filmes, $this->resultSetToFilme($rs));
                }
                return $filmes;
            }
        } catch (PDOException $ex) {
            echo "Exceção: " . $ex->getMessage();
            return null;
        }
    }


    public function findById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM filmes WHERE id_filme=?");
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                if($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    return $this->resultSetToFilme($rs);
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


    private function resultSetToFilme($rs) {
        $filme = new Filme();
        $filme->setIdFilme($rs->id_filme);
        $filme->setTitulo($rs->titulo);
        $filme->setDuracao($rs->duracao);
        $filme->setDeletado($rs->deletado);

        return $filme;
    }


}