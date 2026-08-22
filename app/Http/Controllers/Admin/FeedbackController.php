<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    public function index(Request $request): View
    {
        $query = Feedback::query()->latest();

        if ($request->filled('q')) {
            $search = trim((string) $request->query('q'));

            $query->where(function (Builder $query) use ($search): void {
                $query
                    ->where('message', 'like', "%{$search}%")
                    ->orWhere('desired_feature', 'like', "%{$search}%");
            });
        }

        $satisfaction = $request->integer('satisfaction');

        if ($satisfaction >= 1 && $satisfaction <= 5) {
            $query->where('satisfaction_level', $satisfaction);
        }

        $foundInformation = $request->query('found_information');

        if (in_array($foundInformation, ['0', '1'], true)) {
            $query->where(
                'found_information',
                $foundInformation === '1'
            );
        }

        $feedbacks = $query
            ->paginate(15)
            ->withQueryString();

        $totalFeedback = Feedback::query()->count();

        $averageSatisfaction = (float) (
            Feedback::query()->avg('satisfaction_level') ?? 0
        );

        $foundInformationCount = Feedback::query()
            ->where('found_information', true)
            ->count();

        $foundInformationPercentage = $totalFeedback > 0
            ? (int) round(
                ($foundInformationCount / $totalFeedback) * 100
            )
            : 0;

        $desiredFeatureCount = Feedback::query()
            ->whereNotNull('desired_feature')
            ->where('desired_feature', '<>', '')
            ->count();

        return view(
            'admin.feedback.index',
            compact(
                'feedbacks',
                'totalFeedback',
                'averageSatisfaction',
                'foundInformationCount',
                'foundInformationPercentage',
                'desiredFeatureCount'
            )
        );
    }
}