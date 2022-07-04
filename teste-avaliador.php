<?php
use TrainingPHPUnit\Models\Leilao;
use TrainingPHPUnit\Models\Usuario;
use TrainingPHPUnit\Service\Avaliador;
use TrainingPHPUnit\Models\Lance;
require __DIR__ . "/vendor/autoload.php";
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
$valorEsperado = 2500.00;
if ($maiorValor === $valorEsperado) {
    echo "Teste OK" . PHP_EOL;
} else {
    echo "Teste Falhou" . PHP_EOL;
}

var_dump($maiorValor);
