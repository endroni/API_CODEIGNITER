<?php

namespace App\Controllers;

use App\Models\LivrosModel;
use CodeIgniter\I18n\Time;

class Livros extends BaseController
{
    public function getIndex()
    {
        echo 'API de consulta de livros';
    }

    public function getListar(){
        echo 'Listando todos os livros';
    }

    public function getInserir_teste2(){
        $livrosModel = new LivrosModel();

        $livrosModel->save([
            'titulo'=>'Teste',
            'autor'=>'Autor teste',
            'isbn'=>'1234',
            'paginas'=>'123',
            'ano'=>'2025'
        ]);

        dd($livrosModel->findAll());
    }

    public function getInserir_teste(){
        $livrosModel = new LivrosModel();
        $agora = new Time('now');

        $livrosModel->save([
            'titulo' => 'Teste',
            'autor' => 'Autor Teste',
            'isbn' => '123456789012',
            'paginas' => '1234',
            'ano' => '2022',
            'created_at' => $agora,
            'updated_at' => $agora
        ]);

        print_r($livrosModel->findAll());
    }

}
