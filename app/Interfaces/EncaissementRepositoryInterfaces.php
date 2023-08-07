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

    public function getLastMvm();

    public function getListeFacture($id);
    public function factureById($id);

}