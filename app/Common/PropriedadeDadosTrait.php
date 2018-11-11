<?php

namespace Heroes\Common;

trait PropriedadeDadosTrait
{
    public function __get($propriedade)
    {
        if (property_exists($this, $propriedade)) {
            $methodName = "get".ucfirst($propriedade);
            if (method_exists($this, $methodName)) {
                return $this->{$methodName}();
            }
            return $this->$propriedade;
        }
    }
}
