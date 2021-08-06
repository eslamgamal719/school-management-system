<?php

namespace App\Repositories;

interface PromotionRepositoryInterface 
{

    public function index();

    public function store($request);
}