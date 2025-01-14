<?php

namespace App\Http;

use App\Core\Support\Controller;
use App\Exceptions\CollaboratorNotFoundException;
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
        return view('collaborators.create');
    }

    public function store()
    {

    }

    public function edit(int $id)
    {
        try {
            $collaborator = $this->collaboratorService->edit($id);

            return view('collaborators.edit', compact('collaborator'));
        } catch (CollaboratorNotFoundException $e) {
            return redirect(route('home.collaborators.index'))
                ->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, int $id)
    {

    }

    public function status(int $id)
    {
        try {
            $message = $this->collaboratorService->status($id);

            return $this->sendJsonSuccessResponse($message);
        } catch (CollaboratorNotFoundException $e) {
            return $this->sendJsonErrorResponse($e);
        }
    }

    public function batch(Request $request)
    {
        
    }

    protected function tovalidate()
    {

    }
}
