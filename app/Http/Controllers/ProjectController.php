<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function store(CreateProjectRequest $request, $portfolio_id)
    {
        // Cria um novo projeto dentro de um portfólio
        $project = Project::create([
            'portfolio_id' => $portfolio_id,
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'link' => $request->link,
        ]);

        return response()->json($project, 201);
    }

    public function update(UpdateProjectRequest $request, $id)
    {
        // Atualiza um projeto
        $project = Project::findOrFail($id);
        $project->update([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'link' => $request->link,
        ]);

        return response()->json($project);
    }

    public function destroy($id)
    {
        // Deleta um projeto
        Project::destroy($id);
        return response()->json(['message' => 'Projeto deletado com sucesso!']);
    }
}
