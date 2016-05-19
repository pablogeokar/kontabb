<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use GrahamCampbell\Dropbox\Facades\Dropbox;

class ArquivosController extends Controller {

    public function getIndex() {


        $busca = Dropbox::searchFileNames('/FGTS/2016/032016', 'GPS_07754759000109');

        if ($busca) {
            $f = fopen('./documentos/GPS07754759000109.pdf', 'wd');
            $ultimoElemento = count($busca);
            Dropbox::getFile($busca[$ultimoElemento - 1]['path'], $f);
            fclose($f);

            return redirect('/arquivos/download');
        }
        
        return "Arquivo não Encontrado!";
    }

    public function getDownload() {
        header('Content-Type: application/pdf; charset:utf-8;');
        readfile(url('documentos/GPS07754759000109.pdf'));
    }

}
