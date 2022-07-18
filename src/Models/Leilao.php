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
        if (!empty($this->lances) && $lance->getUsuario() == $this->ehDoUltimoUsuario($lance)) {
            return;
        }
        $totalLancesPorUsuario = $this->qtdLancesPorUsuario($lance->getUsuario());
        if ($totalLancesPorUsuario >= 5) {
            return;
        }
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

    private function ehDoUltimoUsuario(Lance $lance): bool
    {
        $ultimoLance = $this->lances[array_key_last($this->lances)];
        return $lance->getUsuario() == $ultimoLance->getUsuario();
    }

    private function qtdLancesPorUsuario(Usuario $usuario): int
    {
        return array_reduce(
            $this->lances,
            function (int $totalAcumulado, Lance $lanceAtual) use ($usuario) {
                if ($lanceAtual->getUsuario() == $usuario) {
                    return $totalAcumulado + 1;
                }
                return $totalAcumulado;
            },
            0
        );
    }
}
