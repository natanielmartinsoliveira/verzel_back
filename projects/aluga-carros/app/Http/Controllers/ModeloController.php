<?php

namespace App\Http\Controllers;

use App\Services\ModeloService;
use App\Http\Requests\ModeloRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ModeloController extends Controller
{
    private $modeloService;

    public function __construct(ModeloService $modeloService)
    {
        $this->modeloService = $modeloService;
    }

    public function index(): JsonResponse
    {
        try {
            $modelos = $this->modeloService->listarModelos();
            return response()->json($modelos);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao listar modelos'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function indexMarcas($marcas): JsonResponse
    {
        try {
            $modelos = $this->modeloService->listarModelosByMarcas($marcas);
            return response()->json($modelos);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao listar modelos'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(ModeloRequest $request): JsonResponse
    {
        try {
            $modelo = $this->modeloService->criarModelo($request->validated());
            return response()->json($modelo, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar modelo'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $modelo = $this->modeloService->buscarModeloPorId($id);
            return response()->json($modelo);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao buscar modelo'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(ModeloRequest $request, $id): JsonResponse
    {
        try {
            $modelo = $this->modeloService->atualizarModelo($id, $request->validated());
            return response()->json($modelo);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar modelo'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->modeloService->excluirModelo($id);
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao excluir modelo'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
