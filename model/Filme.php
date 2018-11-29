<?php
/**
 * Created by PhpStorm.
 * User: guilh
 * Date: 16/11/2018
 * Time: 14:38
 */

class Filme
{

    private $idFilme;
    private $titulo;
    private $duracao;
    private $sessoes; //associação 1..*
    private $deletado;

    public function __construct(){}

    /**
     * @return mixed
     */


    public function consultaFilme()
    {
        // FALTA FAZER
    }


    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getDuracao()
    {
        return $this->duracao;
    }

    /**
     * @param mixed $duracao
     */
    public function setDuracao($duracao)
    {
        $this->duracao = $duracao;
    }


    /**
     * @return mixed
     */
    public function getSessoes()
    {
        return $this->sessoes;
    }

    /**
     * @param mixed $sessoes
     */
    public function setSessoes($sessoes): void
    {
        $this->sessoes = $sessoes;
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

    /**
     * @return mixed
     */
    public function getIdFilme()
    {
        return $this->idFilme;
    }

    /**
     * @param mixed $idFilme
     */
    public function setIdFilme($idFilme): void
    {
        $this->idFilme = $idFilme;
    }


}