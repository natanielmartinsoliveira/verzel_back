<?php

namespace App\Services;

use App\Models\Modelo;
use App\Repositories\ModeloRepository;

class ModeloService
{
    private $modeloRepository;

    public function __construct(ModeloRepository $modeloRepository)
    {
        $this->modeloRepository = $modeloRepository;
    }

    public function listarModelos()
    {
        return $this->modeloRepository->listar();
    }

    public function listarModelosByMarcas($marcas)
    {
        return $this->modeloRepository->listarByMarcas($marcas);
    }

    public function criarModelo(array $dados)
    {
        return $this->modeloRepository->criar($dados);
    }

    public function buscarModeloPorId($id)
    {
        return $this->modeloRepository->buscarPorId($id);
    }

    public function atualizarModelo($id, array $dados)
    {
        return $this->modeloRepository->atualizar($id, $dados);
    }

    public function excluirModelo($id)
    {
        $this->modeloRepository->excluir($id);
    }
}
