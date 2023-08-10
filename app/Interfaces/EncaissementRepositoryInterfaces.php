<?php 

namespace App\Interfaces;

interface EncaissementRepositoryInterfaces 
{

    public function getDefault();   
    public function getAllToDay();
    public function getAllNotPayed();
    public function getRecetteToDay();
    public function getSumEncaissement();
    public function getResteToDay();
    public function getAllSumReste();

    public function getLastMvm();

    public function getListeFacture($id);
    public function factureById($id);

    public function getDetailsFacture($id);
    public function getDetailsFactureTotalEncaissement($id);

    public function allFacture();

}