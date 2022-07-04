<?php

namespace TrainingPHPUnit\Models;

class Lance
{
    private Usuario $usuario;
    private float $valor;

    public function __construct(Usuario $usuario, float $valor)
    {
        $this->usuario = $usuario;
        $this->valor = $valor;
    }

    
	/**
	 * @return Usuario
	 */
	function getUsuario(): Usuario
    {
		return $this->usuario;
	}

	/**
	 * @return float
	 */
	function getValor(): float
    {
		return $this->valor;
	}
}
