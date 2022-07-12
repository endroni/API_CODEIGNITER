<?php

namespace App\Controllers;

class Teste extends BaseController
{    
    public function getFuncaoteste($id){
        echo 'qualquer coisa'.$id;
    }
    public function getHome(){
        echo 'home';
    }
}
