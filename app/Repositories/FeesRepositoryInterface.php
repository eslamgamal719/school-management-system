<?php

namespace App\Repositories;

interface FeesRepositoryInterface 
{
    
    public function index();

    public function create();

    public function store($request);

    public function edit($id);

    public function update($request, $id);

    public function destroy($id);
}