<?php

namespace App\Services;

use App\Models\Marca;
use App\Repositories\MarcaRepository;

class MarcaService
{
    private $marcaRepository;

    public function __construct(MarcaRepository $marcaRepository)
    {
        $this->marcaRepository = $marcaRepository;
    }

    public function listarMarcas()
    {
        return $this->marcaRepository->listar();
    }

    public function criarMarca(array $dados)
    {
        return $this->marcaRepository->criar($dados);
    }

    public function buscarMarcaPorId($id)
    {
        return $this->marcaRepository->buscarPorId($id);
    }

    public function atualizarMarca($id, array $dados)
    {
        return $this->marcaRepository->atualizar($id, $dados);
    }

    public function excluirMarca($id)
    {
        $this->marcaRepository->excluir($id);
    }
}
