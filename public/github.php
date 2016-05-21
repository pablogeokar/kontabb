<?php
//?k=a2cfe19e8065517b655f1360ff4625de

$key = isset($_GET['k']) ? $_GET['k'] : null;

chdir(__DIR__.'/..');

exec('php github.php '.$key.' > deploy.log &');

