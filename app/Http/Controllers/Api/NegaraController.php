<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NegaraRequest;
use App\Interfaces\NegaraInterface;

class NegaraController extends Controller
{

  protected $negaraRepository;

  /**
   * Create a new constructor for this controller
   */
  public function __construct(NegaraInterface $negaraRepository)
  {
    $this->negaraRepository = $negaraRepository;
  }

  public function index()
  {
    return $this->negaraRepository->getAllNegara();
  }

  public function store(NegaraRequest $request)
  {
    return $this->negaraRepository->create($request);
  }

  public function show($id)
  {
    return $this->negaraRepository->getById($id);
  }

  public function destroy($id)
  {
    return $this->negaraRepository->delete($id);
  }
}
