<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showAllReports()
    {
        $reports = Auth::user()->reports;


        return view('my-reports', [
            'reports' => $reports,
        ]);
    }

    public function showAllMySiteReports()
    {
        $user = Auth::user();

        $my_site = $user->site;

        $reports = $user->site->reports;


        return view('my-site-reports', [
            'reports' => $reports,
            'my_site' => $my_site,
        ]);
    }

    public function showAllMyPendingSiteReports()
    {
        $user = Auth::user();

        $my_site = $user->site;

        $reports_site = $user->site->reports->where('is_finished', '===', false);
        $my_pending_reports = $user->reports->where('is_finished', '===', false);

        $all_reports = $reports_site->merge($my_pending_reports);


        return view('my-pending-site-reports', [
            'reports' => $all_reports,
            'my_site' => $my_site,
        ]);
    }

    public static function showAllMyActionPlans($user)
    {
        return $user->actionplans->sortBy(['compromise_at', 'asc']);
    }

    public static function showMySitePendingActionPlans()
    {
        $action_plans = Auth::user()->site->actionplans->where('done', false)->sortBy(['compromise_at', 'asc']);


        return view('my-pending-action-plans', [
            'pendingactionplans' => $action_plans,
        ]);
    }

    public static function showMySiteReportsWithoutActionPlans()
    {
        $reports = Auth::user()->site->reports->where('is_finished', true)->where('has_actionplans', false)->sortBy(['updated_at', 'asc']);


        return view('reports-without-action-plans', [
            'reports' => $reports,
        ]);
    }

    public static function getMySitePendingActionPlans()
    {
        return Auth::user()->site->actionplans->where('done', false)->sortBy(['compromise_at', 'asc']);

    }

    public function updateLayoutMode($mode)
    {
        $user = Auth::user();

        $user->layout_mode = $mode;

        $user->save();
    }

}

