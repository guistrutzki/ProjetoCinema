<?php
/**
 * Created by PhpStorm.
 * User: guilh
 * Date: 16/11/2018
 * Time: 15:57
 */

class Sessao
{
    private $id;
    private $data_sessao;
    private $hora_sessao;
    private $valor_inteira;
    private $valor_meia;
    private $encerrada;
    private $filme;
    private $sala;

    public function __construct(){}

    public function selecionaSessao()
    {
        // Falta fazer
    }

    /**
     * @return mixed
     */
    public function getDataSessao()
    {
        return $this->data_sessao;
    }

    /**
     * @param mixed $data_sessao
     */
    public function setDataSessao($data_sessao)
    {
        $this->data_sessao = $data_sessao;
    }

    /**
     * @return mixed
     */
    public function getHoraSessao()
    {
        return $this->hora_sessao;
    }

    /**
     * @param mixed $hora_sessao
     */
    public function setHoraSessao($hora_sessao)
    {
        $this->hora_sessao = $hora_sessao;
    }

    /**
     * @return mixed
     */
    public function getValorInteira()
    {
        return $this->valor_inteira;
    }

    /**
     * @param mixed $valor_inteira
     */
    public function setValorInteira($valor_inteira)
    {
        $this->valor_inteira = $valor_inteira;
    }

    /**
     * @return mixed
     */
    public function getValorMeia()
    {
        return $this->valor_meia;
    }

    /**
     * @param mixed $valor_meia
     */
    public function setValorMeia($valor_meia)
    {
        $this->valor_meia = $valor_meia;
    }

    /**
     * @return mixed
     */
    public function getEncerrada()
    {
        return $this->encerrada;
    }

    /**
     * @param mixed $encerrada
     */
    public function setEncerrada($encerrada)
    {
        $this->encerrada = $encerrada;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFilme()
    {
        return $this->filme;
    }

    /**
     * @param mixed $filme
     */
    public function setFilme($filme): void
    {
        $this->filme = $filme;
    }

    /**
     * @return mixed
     */
    public function getSala()
    {
        return $this->sala;
    }

    /**
     * @param mixed $sala
     */
    public function setSala($sala): void
    {
        $this->sala = $sala;
    }




}

