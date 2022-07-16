<?php

namespace TrainingPHPUnit\Tests\Models;
use PHPUnit\Framework\TestCase;
use TrainingPHPUnit\Models\Usuario;
use TrainingPHPUnit\Models\Leilao;
use PhpParser\Node\Stmt\Label;
use TrainingPHPUnit\Models\Lance;

class Leilaotest extends TestCase
{
    
    /**
     * @dataProvider geraLances
     */
    public function testLeilaoDeveReceberLances(int $qtdLances, Leilao $leilao, array $valores)
    {
        static::assertCount($qtdLances, $leilao->getLances());
        foreach ($valores as $i => $valorEsperado) {
            static::assertEquals($valorEsperado, $leilao->getLances()[$i]->getValor());
        }
    }

    public function geraLances()
    {
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');
        
        $leilaoCom2Lance = new Leilao('Fiat 147 0km');
        $leilaoCom2Lance->recebeLances(new Lance($maria, 1000));
        $leilaoCom2Lance->recebeLances(new Lance($joao, 2000));
        
        
        $leilaoCom1Lance = new Leilao('Fusca 1972 0km');
        $leilaoCom1Lance->recebeLances(new Lance($maria, 3000));
        
        return[
            '2-lances' => [2, $leilaoCom2Lance, [1000, 2000]],
            '1-lances' => [1, $leilaoCom1Lance, [3000]]
        ];
    }
}
