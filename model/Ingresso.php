<?php
/**
 * Created by PhpStorm.
 * User: guilh
 * Date: 16/11/2018
 * Time: 14:35
 */

class Ingresso
{

    private $tipo;
    private $sessao;
    private $assento;
    private $fileira;
    private $idIngresso;


// FALTA FAZER ASSOCIAÇÂO

    public function __construct(){}

    /**
     * @return mixed
     */
    public function getIdIngresso()
    {
        return $this->idIngresso;
    }

    /**
     * @param mixed $idIngresso
     */
    public function setIdIngresso($idIngresso): void
    {
        $this->idIngresso = $idIngresso;
    }

    /**
     * @return mixed
     */



    public function getFileira()
    {
        return $this->fileira;
    }

    /**
     * @param mixed $fileira
     */
    public function setFileira($fileira): void
    {
        $this->fileira = $fileira;
    }

    /**
     * @return mixed
     */



    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }


    /**
     * @return mixed
     */
    public function getSessao()
    {
        return $this->sessao;
    }

    /**
     * @param mixed $sessao
     */
    public function setSessao($sessao)
    {
        $this->sessao = $sessao;
    }

    public function getAssento()
    {
        return $this->assento;
    }

    /**
     * @param mixed $assento
     */
    public function setAssento($assento): void
    {
        $this->assento = $assento;
    }





}