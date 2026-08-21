<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    private const ACTION_LABELS = [
        'user.created' => 'Akun Dibuat',
        'user.updated' => 'Data Akun Diubah',
        'user.role_changed' => 'Role Diubah',
        'user.status_changed' => 'Status Diubah',
        'user.password_reset' => 'Password Direset',
        'profile.updated' => 'Profil Diubah',
        'profile.password_changed' => 'Password Sendiri Diubah',
    ];

    public function index(Request $request): View
    {
        $query = ActivityLog::query()
            ->with('actor')
            ->latest('id');

        if ($request->filled('q')) {
            $search = trim((string) $request->query('q'));

            $query->where(function (Builder $query) use ($search): void {
                $query
                    ->where('description', 'like', "%{$search}%")
                    ->orWhere('subject_name', 'like', "%{$search}%")
                    ->orWhere('ip_address', 'like', "%{$search}%")
                    ->orWhereHas('actor', function (Builder $query) use ($search): void {
                        $query
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        $action = (string) $request->query('action');

        if (array_key_exists($action, self::ACTION_LABELS)) {
            $query->where('action', $action);
        }

        $logs = $query
            ->paginate(25)
            ->withQueryString();

        $actions = self::ACTION_LABELS;

        return view('admin.activity-logs.index', compact('logs', 'actions'));
    }
}