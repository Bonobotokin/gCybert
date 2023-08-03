<?php 

namespace App\Interfaces;

interface MaterielsRepositoryInterfaces 
{

    public function getAll();
    public function stock();
    public function etatStock();

}