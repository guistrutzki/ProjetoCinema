<?php
/**
 * Created by PhpStorm.
 * User: guilh
 * Date: 16/11/2018
 * Time: 15:52
 */

class Sala
{
    private $num_sala;
    private $capacidade;
    private $idSala;
    private $deletado;

    public function __construct(){}

    public function consultaSala()
    {
        // FALTA FAZER
    }

    /**
     * @return mixed
     */
    public function getNumSala()
    {
        return $this->num_sala;
    }

    /**
     * @param mixed $num_sala
     */
    public function setNumSala($num_sala)
    {
        $this->num_sala = $num_sala;
    }

    /**
     * @return mixed
     */
    public function getCapacidade()
    {
        return $this->capacidade;
    }

    /**
     * @param mixed $capacidade
     */
    public function setCapacidade($capacidade)
    {
        $this->capacidade = $capacidade;
    }

    /**
     * @return mixed
     */
    public function getIdSala()
    {
        return $this->idSala;
    }

    /**
     * @param mixed $idSala
     */
    public function setIdSala($idSala): void
    {
        $this->idSala = $idSala;
    }

    /**
     * @return mixed
     */
    public function getDeletado()
    {
        return $this->deletado;
    }

    /**
     * @param mixed $deletado
     */
    public function setDeletado($deletado): void
    {
        $this->deletado = $deletado;
    }




}