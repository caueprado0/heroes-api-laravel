<?php

namespace Heroes\Common;

trait PropriedadeDadosTrait
{
    public function __get($propriedade)
    {
        if (property_exists($this, $propriedade)) {
            $methodName = "get".ucfirst($propriedade);
            return $this->$methodName;
        }
    }
}
