<?php

namespace TrainingPHPUnit\Service;

use TrainingPHPUnit\Models\Leilao;

class Avaliador
{
    private float $maiorValor;
    
    public function avalia(Leilao $leilao): void
    {
        $lances = $leilao->getLances();
        $ultimoLance = $lances[count($lances) - 1];
        $this->maiorValor = $ultimoLance->getValor();
    }

	/**
	 * @return float
	 */
	function getMaiorValor(): float
    {
		return $this->maiorValor;
	}
}
