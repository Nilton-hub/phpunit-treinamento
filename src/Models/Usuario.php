<?php

namespace TrainingPHPUnit\Models;

class Usuario
{
    private string $nome;

    public function __construct(string $nome)
    {
        $this->nome = $nome;
    }
    
	/**
	 * @return string
	 */
	function getNome(): string
    {
		return $this->nome;
	}
}
