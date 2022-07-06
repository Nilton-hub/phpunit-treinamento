<?php

namespace TrainingPHPUnit\Service;

use TrainingPHPUnit\Models\Leilao;

class Avaliador
{
    private float $maiorValor = -INF;

    private float $menorValor = INF;
    
    public function avalia(Leilao $leilao): void
    {
        /** @var TrainingPHPUnit\Models\Lance $lance */
        foreach ($leilao->getLances() as $lance) {
            if ($lance->getValor() > $this->maiorValor) {
                $this->maiorValor = $lance->getValor();
            }
            if ($lance->getValor() < $this->menorValor) {
                $this->menorValor = $lance->getValor();
            }
        }
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
    
}
