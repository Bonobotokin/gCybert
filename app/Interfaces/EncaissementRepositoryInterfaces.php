<?php 

namespace App\Interfaces;

interface EncaissementRepositoryInterfaces 
{

    public function getDefault();   
    public function getAllToDay();
    public function getRecetteToDay();
    public function getSumEncaissement();
    public function getResteToDay();
    public function getAllSumReste();

}