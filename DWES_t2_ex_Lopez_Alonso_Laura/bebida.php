<?php
class Bebida extends Articulo
{
    private $alcholica;

    public function __construct($nombre, $coste, $precio, $contador, $alcholica)
    {
        parent::__construct($nombre, $coste, $precio, $contador);
        $this->alcholica = true;
    }
    public function getAlcholica()
    {
        return $this->alcholica;
    }
    public function setAlcholica($alcholica)
    {
        $this->alcholica = $alcholica;
    }

    public function __toString()
    {
        return parent::__toString() . "alcholica: " . ($this->alcholica);
    }
}
