<?php

/*
 * para o laravel reconhecer seu helper você precisa adiciona-lo no composer.json:
 * 
  "psr-4": {
  "App\\": "app/"
  },
  "files": [
  "app/Helpers/MyHelper.php"
  ]

  rode via console o comando:

  composer dump

 */


//função usada para transformar um array multidimensional
//em unidimensional, testado por exemplo, nos selects de um item só
if (!function_exists('array_smples')) {

    function array_simples($array) {
        if ($array !== [] ) {
            foreach ($array as $subArray) {
                foreach ($subArray as $val) {
                    $newArray[] = $val;
                }
            }
            return $newArray;
        }
        return false;
    }

}

