<?php 

namespace App\Interfaces;

interface CaisseRepositoryInterfaces
{
    public function getdefault();

    public function getSumEncaissement();
    public function getSumDecaissement();
    public function getSolde();

    public function getCaisse();

    public function lookResteClient(string $client);
}