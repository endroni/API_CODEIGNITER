<?php

namespace App\Controllers;

use App\Models\LivrosModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\API\ResponseTrait;

class Livros extends BaseController
{
    use ResponseTrait;

    public function postInserir(){
        /*
        * Insere um item no banco de dados
        * Requer:
        * titulo, autor, isbn, paginas, ano
        */
        
        $request = \Config\Services::request();

        header('Access-Control-Allow-Origin: *');

        $titulo = $request->getVar('titulo');
        $autor = $request->getVar('autor');
        $isbn = $request->getVar('isbn');
        $paginas = $request->getVar('paginas');
        $ano = $request->getVar('ano');

        // Grava dados no banco de dados        
        $livrosModel = new LivrosModel();

        $livrosModel->save([
            'titulo'=>$titulo,
            'autor'=>$autor,
            'isbn'=>$isbn,
            'paginas'=>$paginas,
            'ano'=>$ano
        ]);

        $this->respondCreated($livrosModel->getInsertID());

    }

    public function postDeletar(){
        /* Deleta uma linha no banco de dados de acordo com o id passado via request post */

        # $id = $_POST['id'];

        $request = \Config\Services::request();

        $id = $request->getVar('id');

        $livrosModel = new LivrosModel();
        
        $livrosModel->delete(['id'=>$id]);

        $this->respondDeleted($id);
    }

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

    public function getListar($paginacao = 1, $ordem = 'asc'){

         /*
            * Lista todos os livros 
            * Uso: /listar/[página]/[ordem]/
            * Exemplo: /listar/1/desc
            * Exemplificação: Retorna o último item
        */

        header('Access-Control-Allow-Origin: *'); // Restrição de segurança(evitar invasão) - diretriz que me permite acessar os dados na própria máquina. 

        $livrosModel = new LivrosModel();
        $itens = 10;
        $dados = $livrosModel
                    ->orderBy('id', $ordem)
                    ->findAll($itens, $paginacao * $itens - $itens);

        //dd($dados); // Retorna os dados em formato de array
        return $this->respond($dados, 200); // Retorna os dados em forma de Jason. Obs. Precisa da biblioteca ResponseTrait para utilizar o método respond
    }

    public function getLivro($id){
        header('Access-Control-Allow-Origin: *');

        $livrosModel = new LivrosModel();
        $dados = $livrosModel->find($id);

        return $this->respond($dados, 200);
    }

    public function getBuscar($query){
        
        /*
            * Realizando busca por: 
            * título, autor, isbn ou período (ano_inicio e ano_fim)
            * Exemplo: http://localhost:8080/livros/buscar/
            * query?itens_por_pagina=10 & titulo=sociedade do anel
            * & isbn=123 & autor=tolkien & ano_inicio=200 & ano_fim=2020
        */

        header('Access-Control-Allow-Origin: *');

        // paginação
        $itens = isset($_GET['itens_por_pagina'])?$_GET['itens_por_pagina']:10;
        $pagina = isset($_GET['pagina'])?$_GET['pagina']:1;

        // busca por título, autor e isbn
        $titulo = isset($_GET['titulo'])?$_GET['titulo']:'';
        $autor = isset($_GET['autor'])?$_GET['autor']:'';
        $isbn = isset($_GET['isbn'])?$_GET['isbn']:'';

        // período
        $ano_inicio = isset($_GET['ano_inicio'])?$_GET['ano_inicio']:0;
        $ano_fim = isset($_GET['ano_fim'])?$_GET['ano_fim']:date('Y');

        // cláusulas where
        $periodo = ['ano >='=>$ano_inicio, 'ano <='=>$ano_fim];
        $busca = ['titulo'=>$titulo, 'autor'=>$autor, 'isbn'=>$isbn];

        $livrosModel = new LivrosModel();

        $dados = $livrosModel   
                    ->where($periodo)
                    ->like($busca)
                    ->findAll($itens, $pagina*$itens-$itens);

        return $this->respond($dados, 200);

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

    public function getPagina(){
            echo 'qualquer coisa';
        }


}
