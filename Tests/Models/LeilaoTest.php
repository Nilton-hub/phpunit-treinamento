<?php

namespace TrainingPHPUnit\Tests\Models;
use PHPUnit\Framework\TestCase;
use TrainingPHPUnit\Models\Usuario;
use TrainingPHPUnit\Models\Leilao;
use PhpParser\Node\Stmt\Label;
use TrainingPHPUnit\Models\Lance;
use PhpParser\Node\Stmt\Use_;

class Leilaotest extends TestCase
{
    public function testLeilaoNaoDeveReceberMaisDeUmLanceDoMesoUsuarioSeguido()
    {
        $leilao = new Leilao('Variante');
        $ana = new Usuario('Ana');
        $leilao->recebeLances(new Lance($ana, 1000));
        $leilao->recebeLances(new Lance($ana, 1500));
        static::assertCount(1, $leilao->getLances());
        static::assertEquals(1000, $leilao->getLances()[0]->getValor());
    }

    public function testLeilaoNaoDeveAceotarMaisDe5LancesPorUsuario()
    {
        $leilao = new Leilao("Brasília Amarela");
        $maria = new Usuario('Maria');
        $joao = new Usuario('João');

        $leilao->recebeLances(new Lance($maria, 1000));
        $leilao->recebeLances(new Lance($joao, 1500));
        $leilao->recebeLances(new Lance($maria, 2000));
        $leilao->recebeLances(new Lance($joao, 2500));
        $leilao->recebeLances(new Lance($maria, 3000));
        $leilao->recebeLances(new Lance($joao, 3500));
        $leilao->recebeLances(new Lance($maria, 4000));
        $leilao->recebeLances(new Lance($joao, 4500));
        $leilao->recebeLances(new Lance($maria, 5000));
        $leilao->recebeLances(new Lance($joao, 5500));

        $leilao->recebeLances(new Lance($maria, 6000));

        static::assertCount(10, $leilao->getLances());
        static::assertEquals(5500, $leilao->getLances()[array_key_last($leilao->getLances())]->getValor());
    }

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
