<?php

class Material
{
    private $titulo;
    private $autor;
    private $ISBN;
    private $disponible;


    public function __construct($titulo, $autor, $ISBN, $disponible)
    {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->ISBN = $ISBN;
        $this->disponible = $disponible;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }
    public function getAutor()
    {
        return $this->autor;
    }
    public function getISBN()
    {
        return $this->ISBN;
    }
    public function getDisponible()
    {
        return $this->disponible;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    public function setISBN($ISBN)
    {
        $this->ISBN = $ISBN;
    }

    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;
    }

    public function prestar()
    {
        if ($this->disponible) {
            $this->disponible = false;
            return "El material ha sido prestado correctamente";
        } else {
            return "No se ha tomado prestado";
        }
    }

    public function devolver()
    {
        if (!$this->disponible) {
            $this->disponible = true;
            return "Devuelto correctamente";
        } else {
            return "No se puede devolver";
        }
    }


    public function __toString()
    {
        return "Título: {$this->titulo}, Autor: {$this->autor}, ISBN: {$this->ISBN}, Disponible: " . ($this->disponible ? 'Sí' : 'No');
    }

}

class Libro extends Material
{
    private $numPaginas;

    public function __construct($titulo, $autor, $ISBN, $disponible, $numPaginas)
    {
        parent::__construct($titulo, $autor, $ISBN, $disponible);
        $this->numPaginas = $numPaginas;
    }

    public function getNumPaginas()
    {
        return $this->numPaginas;
    }

    public function setNumPaginas($numPaginas)
    {
        $this->numPaginas = $numPaginas;
    }

    public function __toString()
    {
        return parent::__toString() . ", Número de páginas: {$this->numPaginas}";
    }
}

class DVD extends Material
{
    private $duracion;
    private $genero;

    public function __construct($titulo, $autor, $ISBN, $disponible, $duracion, $genero)
    {
        parent::__construct($titulo, $autor, $ISBN, $disponible);
        $this->duracion = $duracion;
        $this->genero = $genero;
    }

    public function getDuracion()
    {
        return $this->duracion;
    }

    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    public function __toString()
    {
        return parent::__toString() . ", Duración: {$this->duracion}, Género: {$this->genero}";
    }
}

$libro1 = new Libro("La última rosa de Shangai", "Weina dai Randell", "9788419767141", true, 360);
$libro2 = new Libro("Uzumaki", "Junji Ito", "9788491465843", true, 656);
$dvd1 = new DVD("Buscando a Nemo", "Andrew Stanton", "9788491463455", true, "121min", "Infantil");
$dvd2 = new DVD("Rush", "Ron Howard", "97884914658423", true, "123min", "Acción");

$biblioteca = [$libro1, $libro2, $dvd1, $dvd2];

require "index.view.php";
?>