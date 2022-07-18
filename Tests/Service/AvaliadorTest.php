<?php

namespace TrainingPHPUnit\Tests\Service;

use TrainingPHPUnit\Models\Leilao;
use TrainingPHPUnit\Models\Usuario;
use TrainingPHPUnit\Service\Avaliador;
use TrainingPHPUnit\Models\Lance;

use PHPUnit\Framework\TestCase;
use phpDocumentor\Reflection\Types\Void_;

class AvaliadorTest extends TestCase
{
    private $leiloeiro;

    # executado antes da instância da classe
    public static function setUpBeforeClass(): void
    {

    }
    
    # executado antes da chamada de qualquer método
    protected function setUp(): void
    {
        $this->leiloeiro = new Avaliador();
    }

    protected function tearDown(): void
    {

    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testAvaliadorDeLeilao(Leilao $leilao)
    {
        // Arrumo a casa para o teste (Arrange - Given)
        // Executo o código a ser testado (Act - When)
        $this->leiloeiro->avalia($leilao);
        $maiorValor = $this->leiloeiro->getMaiorValor();
        // Verifico se a saída é a esperada (Assert - Then)
        self::assertEquals(2500, $maiorValor);
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testAvaliadorPegaOs3MaioresLances(Leilao $leilao)
    {
        $this->leiloeiro->avalia($leilao);
        $maiores = $this->leiloeiro->getMaioresLances();

        static::assertCount(3, $maiores);
        static::assertEquals(2500, $maiores[0]->getValor());
        static::assertEquals(2000, $maiores[1]->getValor());
        static::assertEquals(1700, $maiores[2]->getValor());
    }

    public function testLeilaoVazioNaoPodeSerAvaliado(Type $var = null)
    {
        $leilao = new Leilao("Fusca Azul");
        $this->leiloeiro->avalia($leilao);
    }

    public function leilaoEmOrdemCrescente()
    {
        $leilao = new Leilao('Fiat 147 0km');
        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $ana = new Usuario('Ana');
        
        $leilao->recebeLances(new Lance($ana, 1700));
        $leilao->recebeLances(new Lance($joao, 2000));
        $leilao->recebeLances(new Lance($maria, 2500));
        
        return [
            'ordem-crescente' => [$leilao]
        ];
    }

    public function leilaoEmOrdemDecrescente()
    {
        $leilao = new Leilao('Fiat 147 0km');
        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $ana = new Usuario('Ana');
        
        $leilao->recebeLances(new Lance($maria, 2500));
        $leilao->recebeLances(new Lance($joao, 2000));
        $leilao->recebeLances(new Lance($ana, 1700));
        
        return [
            'ordem-decrescente' => [$leilao]
        ];
    }

    public function leilaoEmOrdemAleatoria()
    {
        $leilao = new Leilao('Fiat 147 0km');
        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $ana = new Usuario('Ana');
        
        $leilao->recebeLances(new Lance($joao, 2000));
        $leilao->recebeLances(new Lance($ana, 1700));
        $leilao->recebeLances(new Lance($maria, 2500));
        
        return [
            'ordem-aleatoria' => [$leilao]
        ];
    }
}
