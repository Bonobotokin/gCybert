<?php

namespace App\Interfaces;

interface PersonnelRepositoryInterfaces 
{
    public function getAll();

    public function getSalaire($id);

    public function getAllPayement();
}