<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Services\CollaboratorService;
use Illuminate\Http\Request;

class CollaboratorController extends Controller
{
    private $collaboratorService;

    public function __construct(CollaboratorService $collaboratorService)
    {
        $this->collaboratorService = $collaboratorService;
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $collaborators = $this->collaboratorService->index($params);

        return view('collaborators.index', compact('params', 'collaborators'));
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit(int $id)
    {

    }

    public function update(Request $request, int $id)
    {

    }

    public function delete(int $id)
    {

    }

    public function batch(Request $request)
    {
        
    }
}
