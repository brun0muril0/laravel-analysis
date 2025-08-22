<?php

namespace App\Services;

use App\Models\Data;

class AnalysisService
{
    /**
     * Calcula o total dos valores dos últimos 10 anos multiplicando
     * pelo fator de 1.07 e retorna o resultado.
     */
    public function calculate(): float
    {
        $result = Data::where('date', '>=', now()->subYears(10))
                      ->selectRaw('ROUND(SUM(value * 1.07), 2) as total')
                      ->value('total');

        return (float) ($result ?? 0);
    }
}
