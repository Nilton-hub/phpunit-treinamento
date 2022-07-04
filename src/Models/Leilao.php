<?php

namespace TrainingPHPUnit\Models;

class Leilao
{
    private array $lances;
    
    private string $descricao;

    /**
     * @param string $descricao
     */
    public function __construct(string $descricao)
    {
        $this->descricao = $descricao;
        $this->lances = [];
    }

    /**
     * @param Lance $lance
     * @return void
     */
    public function recebeLances(Lance $lance): void
    {
        $this->lances[] = $lance;
    }

    /**
     * @return Lance[]
     * @return array
     */
    public function getLances(): array
    {
        return $this->lances;
    }
}
