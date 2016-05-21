<?php
$r = shell_exec('/usr/bin/git pull 2>&1');
var_dump($r);

