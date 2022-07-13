<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CriarTabelaLivros extends Migration
{
    public function up()
    {
        // Cria uma tabela chamada "livros"        
        $this->forge->addField('id');
        $this->forge->addField([                    
            'titulo' => ['type' => 'VARCHAR', 'constraint' => 255],            
            'autor' => ['type' => 'VARCHAR', 'constraint' => 255],            
            'isbn' => ['type' => 'INT'],            
            'paginas' => ['type' => 'INT'],            
            'ano' => ['type' => 'INT'],            
            'created_at' => ['type' => 'DATETIME', 'null' => TRUE],            
            'updated_at' => ['type' => 'DATETIME', 'null' => TRUE],            
            'deleted_at' => ['type' => 'DATETIME', 'null' => TRUE]        
        ])->createTable('livros');
    }

    public function down()
    {
        // deleta a tabela livros        
        $this->forge->dropTable('livros');
    }
}
