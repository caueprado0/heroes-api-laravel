<?php

namespace Heroes\RequisicaoHttp\Model;

use Heroes\Common\PropriedadeDadosTrait;

class Requisicao
{
    use PropriedadeDadosTrait;

    private $corpo;
    private $status;

    public function setCorpo($requesicaoCorpo)
    {
        $this->corpo = $requesicaoCorpo;
    }

    public function getCorpo()
    {
        return $this->corpo;
    }

    public function setStatus($requesicaoStatus)
    {
        $this->status = $requesicaoStatus;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
