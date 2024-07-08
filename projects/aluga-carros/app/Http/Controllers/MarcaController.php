<?php

namespace App\Http\Controllers;

use App\Services\MarcaService;
use App\Http\Requests\MarcaRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class MarcaController extends Controller
{
    private $marcaService;

    public function __construct(MarcaService $marcaService)
    {
        $this->marcaService = $marcaService;
    }

    public function index(): JsonResponse
    {
        try {
            $marcas = $this->marcaService->listarMarcas();
            return response()->json($marcas);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao listar marcas'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(MarcaRequest $request): JsonResponse
    {
        try {
            $marca = $this->marcaService->criarMarca($request->validated());
            return response()->json($marca, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar marca'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $marca = $this->marcaService->buscarMarcaPorId($id);
            return response()->json($marca);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar marca'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(MarcaRequest $request, $id): JsonResponse
    {
        try {
            $marca = $this->marcaService->atualizarMarca($id, $request->validated());
            return response()->json($marca);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar marca'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->marcaService->excluirMarca($id);
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir marca'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
