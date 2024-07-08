<?php

namespace App\Services;

use App\Models\Carro;
use App\Repositories\CarroRepository;

class CarroService
{
    private $carroRepository;

    public function __construct(CarroRepository $carroRepository)
    {
        $this->carroRepository = $carroRepository;
    }
    
    public function getFilteredCarros(array $filters, $perPage)
    {
        return $this->carroRepository->getFilteredCarros($filters, $perPage);
    }

    public function listarCarros()
    {
        return $this->carroRepository->listar();
    }

    public function criarCarro(array $dados)
    {
        return $this->carroRepository->criar($dados);
    }

    public function buscarCarroPorId($id)
    {
        return $this->carroRepository->buscarPorId($id);
    }

    public function atualizarCarro($id, array $dados)
    {
        return $this->carroRepository->atualizar($id, $dados);
    }

    public function excluirCarro($id)
    {
        $this->carroRepository->excluir($id);
    }
}
