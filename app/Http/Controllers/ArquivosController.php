<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use GrahamCampbell\Dropbox\Facades\Dropbox;

class ArquivosController extends Controller {

    
    //http://kontabb.local/arquivos/gps/busca/2016/04/03198283000116
    public function getBusca($documento, $ano, $mes, $cnpj) {

        switch ($documento) {
            case 'gps':
                $doc = 'GPS_';
                break;
        }


        if (isset($doc)) {
            $busca = Dropbox::searchFileNames('/SEFIP/'.$ano.'/'.$mes.$ano, $doc . $cnpj);

            if ($busca) {
                $f = fopen('./documentos/'.$doc.$cnpj.'.pdf', 'wd');
                $ultimoElemento = count($busca);
                Dropbox::getFile($busca[$ultimoElemento - 1]['path'], $f);
                fclose($f);                
                return redirect('/arquivos/download/'.$doc.$cnpj.'.pdf');
            }
        }

        return "Arquivo não Encontrado!";
    }

    public function getDownload($nomeDocumento) {
        header('Content-Type: application/pdf; charset:utf-8;');
        readfile(url('documentos/'.$nomeDocumento));
    }

}
