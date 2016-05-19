<?php

/*
 * This file is part of Laravel Dropbox.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Dropbox Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'main' => [
            'token'  => '1j8tpVnhhEAAAAAAAAAADHMN3-5QcjfbSNt3DkIUfsuNFpyP9uGqrCUGA0zjGCtf',
            'app'    => 'je42vovrnr371x9',
        ],

        'alternative' => [
            'token'  => 'your-token',
            'app'    => 'your-app',
        ],

    ],

];
