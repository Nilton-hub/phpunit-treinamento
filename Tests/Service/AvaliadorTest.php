<?php

namespace TrainingPHPUnit\Tests\Service;

use TrainingPHPUnit\Models\Leilao;
use TrainingPHPUnit\Models\Usuario;
use TrainingPHPUnit\Service\Avaliador;
use TrainingPHPUnit\Models\Lance;

use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    public function testAvaliadorDeLeilaoCrescente()
    {
        // Arrumo a casa para o teste (Arrange - Given)
        $leilao = new Leilao('Fiat 147 0km');
        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        // Executo o código a ser testado (Act - When)
        $leilao->recebeLances(new Lance($joao, 2000));
        $leilao->recebeLances(new Lance($maria, 2500));
        $leiloeiro  = new Avaliador();
        $leiloeiro->avalia($leilao);
        $maiorValor = $leiloeiro->getMaiorValor();
        // Verifico se a saída é a esperada (Assert - Then)
        self::assertEquals(2500, $maiorValor);
    }
    
    public function testAvaliadorDeLeilaoDecrescente()
    {
        // Arrumo a casa para o teste (Arrange - Given)
        $leilao = new Leilao('Fiat 147 0km');
        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        // Executo o código a ser testado (Act - When)
        $leilao->recebeLances(new Lance($maria, 2500));
        $leilao->recebeLances(new Lance($joao, 2000));
        $leiloeiro  = new Avaliador();
        $leiloeiro->avalia($leilao);
        $maiorValor = $leiloeiro->getMenorValor();
        // Verifico se a saída é a esperada (Assert - Then)
        self::assertEquals(2000, $maiorValor);
    }
}
