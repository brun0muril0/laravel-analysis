<?php

namespace App\Http\Controllers;

use App\Services\AnalysisService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Throwable;
use Illuminate\Support\Facades\Log;

class AnalysisController extends Controller
{
    public function __construct(
        private AnalysisService $analysisService
    ) {}

    /**
     * Executa o cálculo de análise chamando o service
     * e retorna o resultado em formato JSON.
     * Em caso de erro, registra no log e retorna status 500.
     */
    public function getAnalysis(): JsonResponse
    {
        try {
            $result = $this->analysisService->calculate();

            return response()->json(['result' => $result], 200);
        } catch (Throwable $e) {
            Log::error('Erro ao calcular análise: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Não foi possível calcular a análise no momento.'
            ], 500);
        }
    }
}