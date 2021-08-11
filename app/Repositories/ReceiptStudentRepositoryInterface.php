<?php

namespace App\Repositories;

interface ReceiptStudentRepositoryInterface 
{
    public function index();

    public function show($id);

    public function store($request);

    public function edit($id);

    public function update($request, $id);

    public function destroy($id);
}