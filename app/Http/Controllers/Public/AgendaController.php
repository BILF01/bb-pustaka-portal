<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AgendaController extends Controller
{
    public function byDate(Request $request): JsonResponse
    {
        $date = $request->query('date', now()->toDateString());
        $agendas = Agenda::onDate($date)->get(['title', 'description', 'location', 'starts_at', 'ends_at']);

        return response()->json($agendas);
    }
}