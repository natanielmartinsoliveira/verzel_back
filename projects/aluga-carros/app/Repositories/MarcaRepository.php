<?php

namespace App\Repositories;

use App\Models\Marca;
use Illuminate\Database\QueryException;

class MarcaRepository
{
    public function listar()
    {
        return Marca::all();
    }

    public function criar(array $dados)
    {
        return Marca::create($dados);
    }

    public function buscarPorId($id)
    {
        return Marca::findOrFail($id);
    }

    public function atualizar($id, array $dados)
    {
        $marca = Marca::findOrFail($id);
        $marca->update($dados);
        return $marca;
    }

    public function excluir($id)
    {
        $marca = Marca::findOrFail($id);
        $marca->delete();
    }
}
