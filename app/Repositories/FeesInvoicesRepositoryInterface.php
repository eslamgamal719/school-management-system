<?php

namespace App\Repositories;

interface FeesInvoicesRepositoryInterface 
{
    
    public function index();

    public function show($id);

    public function store($request);

    public function feesAmount($id);

    public function edit($id);

    public function update($request, $id);

    public function destroy($id);
}