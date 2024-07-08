<?php

namespace App\Repositories;

use App\Models\Modelo;

class ModeloRepository
{
    public function listar()
    {
        return Modelo::all();
    }

    public function listarByMarcas($marca)
    {
        return Modelo::where('marca_id', $marca)->get();
    }

    public function criar(array $dados)
    {
        return Modelo::create($dados);
    }

    public function buscarPorId($id)
    {
        return Modelo::findOrFail($id);
    }

    public function atualizar($id, array $dados)
    {
        $modelo = Modelo::findOrFail($id);
        $modelo->update($dados);
        return $modelo;
    }

    public function excluir($id)
    {
        $modelo = Modelo::findOrFail($id);
        $modelo->delete();
    }
}
