<?php

namespace App\Controllers;

class Livros extends BaseController
{
    public function getIndex()
    {
        echo 'API de consulta de livros';
    }

    public function getListar(){
        echo 'Listando todos os livros';
    }

}
