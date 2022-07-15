<?php

namespace App\Controllers;

use App\Models\LivrosModel;
use CodeIgniter\I18n\Time;

class Livros extends BaseController
{
    public function getPovoar_banco(){
        
        // Função responsável por povoar os dados de dados SQLite
        // Arquivo "livros.csv"
        // Separador ";"

        // return 0;
        
        // Conectando ao banco
        
        $livrosModel = new LivrosModel();
        $agora = new Time('now');        

        // Lendo arquivo csv        
        if (($arquivo = fopen("livros.csv", "r")) !== FALSE) {
            echo '<table border=1>'; // imprime uma tabela no HTML
            
            $id_linha = 1;
            // para cada linha do arquivo csv            
            while(($linha = fgetcsv($arquivo, 4096, ";")) !== FALSE){

                // Para cada coluna da linha                
                for ($i=0; $i < count($linha); $i++) {
                    
                    switch($i){                        
                        case 0: $titulo = $linha[$i]; break;
                        case 1: $autor = $linha[$i]; break;
                        case 2: $isbn = $linha[$i]; break;                                                
                        case 3: $paginas = $linha[$i]; break;                        
                        case 4: $ano = $linha[$i]; break;
                    }
                }

                // grava dados no banco
                if($id_linha != 1){
                
                    $livrosModel->save([   
                        'titulo'=>$titulo,                 
                        'autor'=>$autor,
                        'isbn'=>$isbn,
                        'paginas'=>$paginas,
                        'ano'=>$ano,
                        'created_at'=>$agora,
                        'updated_at'=>$agora                        
                    ]);
                }                
                $id_linha++;
            }
            
            fclose($arquivo); // fecha o arquivo
        }
        
        d($livrosModel->findAll()); // imprime dados na tela
        
        echo "Para limpar a base de dados, execute: ";        
        echo "php spark migrate:refresh";
        
    }

    public function getIndex()
    {
        echo 'API de consulta de livros';
    }

    public function getListar(){
        $livrosModel = new LivrosMOdel();

        $dados = $livrosModel->findAll();

        dd($dados);
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

        // print_r($livrosModel->findAll());
        dd($livrosModel->findAll());
    }

}