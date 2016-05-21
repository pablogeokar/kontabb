<?php

$key = isset($_GET['k']) ? $_GET['k'] : null;
if (is_null($key))
    $key = isset($argv[1]) ? $argv[1] : null;

if ($key == 'a2cfe19e8065517b655f1360ff4625de') {

    if (php_sapi_name() != "cli") {
        header('Content-Type:text/plain');
    }

    echo 'INICIANDO DEPLOY' . PHP_EOL;
    echo '=======' . PHP_EOL;

    echo 'Atualizando o repositório' . PHP_EOL;
    passthru('git pull');
    echo 'OK' . PHP_EOL;
    echo '=======' . PHP_EOL;

    echo 'Removendo diretório vendor' . PHP_EOL;
    passthru('rm -rf vendor');
    echo 'OK' . PHP_EOL;
    echo '=======' . PHP_EOL;

    echo 'Instalando as dependências' . PHP_EOL;
    echo passthru('composer install');
    echo 'OK' . PHP_EOL;
    echo '=======' . PHP_EOL;
}

echo 'Deploy finalizado!' . PHP_EOL;


