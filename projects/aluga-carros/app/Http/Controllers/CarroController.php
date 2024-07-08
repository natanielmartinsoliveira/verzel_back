<?php

namespace App\Http\Controllers;

use App\Services\CarroService;
use App\Http\Requests\CarroRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Http\Requests\CarroFilterRequest;

class CarroController extends Controller
{
    private $carroService;

    public function __construct(CarroService $carroService)
    {
        $this->carroService = $carroService;
    }

    public function index(CarroFilterRequest $request): JsonResponse
    {
        try {
            $filters = $request->validated();
            $perPage = $request->input('per_page', 8); // Número de itens por página, padrão é 8
            $carros = $this->carroService->getFilteredCarros($filters, $perPage);
            return response()->json($carros);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao listar carros'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(CarroRequest $request): JsonResponse
    {
        try {
            $carro = $this->carroService->criarCarro($request->validated());
            return response()->json($carro, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar carro'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $carro = $this->carroService->buscarCarroPorId($id);
            return response()->json($carro);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar carro'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(CarroRequest $request, $id): JsonResponse
    {
        try {
            $carro = $this->carroService->atualizarCarro($id, $request->validated());
            return response()->json($carro);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar carro'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->carroService->excluirCarro($id);
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir carro'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
