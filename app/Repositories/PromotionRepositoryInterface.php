<?php

namespace App\Repositories;

interface PromotionRepositoryInterface 
{

    public function index();

    public function allPromotions();

    public function store($request);

    public function destroy($request);
}