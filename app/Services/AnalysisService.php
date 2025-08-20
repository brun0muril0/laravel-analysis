<?php

namespace App\Services;

use App\Models\Data;

class AnalysisService
{
    /**
     * Realiza o cálculo estatístico diretamente no banco
     * Somando todos os valores dos últimos 10 anos,
     * multiplicados pelo fator de 1.07.
     */
    public function calculate(): float
    {
        $result = Data::where('date', '>=', now()->subYears(10))
                      ->selectRaw('ROUND(SUM(value * 1.07), 2) as total')
                      ->value('total');

        return (float) ($result ?? 0);
    }
}
