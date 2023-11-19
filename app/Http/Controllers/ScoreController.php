<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ScoreService;

class ScoreController extends Controller
{
    /**
     * @var ScoreService
     */
    protected $scoreService;

    /**
     * @param ScoreService $scoreService
     */
    public function __construct(ScoreService $scoreService)
    {
        $this->scoreService = $scoreService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate and process the request
        $data = $request->validate([
            // Validation rules
        ]);

        $score = $this->scoreService->save($data);

        return response()->json($score, 201);
    }
}
