<?php

namespace TrainingPHPUnit\Service;

use TrainingPHPUnit\Models\Leilao;
use TrainingPHPUnit\Models\Lance;
use DomainException;

class Avaliador
{
    private float $maiorValor = -INF;

    private float $menorValor = INF;

    private $maioresLances;
    
    public function avalia(Leilao $leilao): void
    {
        if (empty($leilao->getLances())) {
            throw new DomainException("Não é possível avaliar um leilão vazio.");
        }
        /** @var TrainingPHPUnit\Models\Lance $lance */
        foreach ($leilao->getLances() as $lance) {
            if ($lance->getValor() > $this->maiorValor) {
                $this->maiorValor = $lance->getValor();
            }
            if ($lance->getValor() < $this->menorValor) {
                $this->menorValor = $lance->getValor();
            }
        }
        $lances = $leilao->getLances();
        usort($lances, function(Lance $lance1, Lance $lance2) {
            return $lance2->getValor() - $lance1->getValor();
        });
        $this->maioresLances = array_slice($lances, 0, 3);
    }

	/**
	 * @return float
	 */
	function getMaiorValor(): float
    {
		return $this->maiorValor;
	}

    /**
     * @return float
     */
    public function getMenorValor(): float
    {
        return $this->menorValor;
    }
    
    public function getMaioresLances(): ?array
    {
        return $this->maioresLances;
    }
}
