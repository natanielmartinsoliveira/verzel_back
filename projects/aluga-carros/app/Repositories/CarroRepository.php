<?php

namespace App\Repositories;

use App\Models\Carro;
use Illuminate\Support\Facades\DB;

class CarroRepository
{
    public function getFilteredCarros(array $filters, $perPage = 10)
    {
        DB::enableQueryLog();
        $query = Carro::query();

        if (isset($filters['marca'])) {
            $query->where('marca_id', $filters['marca']);
        }

        if (isset($filters['modelo'])) {
            $query->where('modelo_id', $filters['modelo']);
        }

        if (isset($filters['ano'])) {
            $query->where('ano', $filters['ano']);
        }

        if (isset($filters['quilometragem_min'])) {
            $query->where('quilometragem', '>=', $filters['quilometragem_min']);
        }

        if (isset($filters['quilometragem_max'])) {
            $query->where('quilometragem', '<=', $filters['quilometragem_max']);
        }

        return $query->with(['marca', 'modelo'])->paginate($perPage);
    }

    public function listar()
    {
        return Carro::with(['marca', 'modelo'])->all();
    }

    public function criar(array $dados)
    {
        return Carro::create($dados);
    }

    public function buscarPorId($id)
    {
        return Carro::with(['marca', 'modelo'])->findOrFail($id);
    }

    public function atualizar($id, array $dados)
    {
        $carro = Carro::findOrFail($id);
        $carro->update($dados);
        return $carro;
    }

    public function excluir($id)
    {
        $carro = Carro::findOrFail($id);
        $carro->delete();
    }
}
