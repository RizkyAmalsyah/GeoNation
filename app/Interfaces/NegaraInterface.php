<?php

namespace App\Interfaces;

use App\Http\Requests\NegaraRequest;

interface NegaraInterface
{
    public function getAllNegara();
    public function getById($id);
    public function create(NegaraRequest $request);
    public function delete($id);
}
