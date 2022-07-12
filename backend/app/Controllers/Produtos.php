<?php

namespace App\Controllers;

class Produtos extends BaseController
{    
    public function getListar($id){
        //return view(''); // ainda não temos uma view
        echo "Listando o produto $id";
    }    
}
