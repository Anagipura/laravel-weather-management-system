<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Alert;
use App\Models\RiskLevel;

class AlertRiskController extends Controller
{

    public function index() // main admin dashboard load
    {
        $alerts = Alert::latest()->get();
        $riskLevels = RiskLevel::latest()->get();
        return view('admin.alerts.index', compact('alerts', 'riskLevels'));
    }

    public function create() { // create static alerts
        return view('admin.alerts.create');
    }

    public function manageAlerts() { // for alert management view

        $alerts = Alert::latest()->get();
        return view('admin.alerts.manage', compact('alerts'));
    }

    public function store(Request $request) { // store alerts
        Alert::create($request->only([
            'title',
            'message',
            'type',
            'location',
            'severity',
        ]));

        return redirect()->route('admin.alerts.manage')
            ->with('success', 'Alert created!');
    }

    public function destroy($id) // remove alerts from the db
    {
        Alert::findOrFail($id)->delete();

        return back()->with('success', 'Alert deleted!');
    }

    public function search(Request $request) { // search my title + location
        $query = Alert::query(); //query instance for the Alert class

        if($request->search) { // for the search-box in  the front-end
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%'. $request->search . '%') // check is there Title parameter
                    ->orWhere('location', 'like', '%'. $request->search.'%'); // check is there Location parameter

            });
        }
        //check is there 'type' parameter (Filter by alert type)
        if($request->type) {
            $query->where('type', $request->type);
        }

        // Filter by country
        if($request->country) {
            $query->where('location', $request->country);
        }

        $alerts = $query->latest()->get();

        return view('partials.alertTable', compact('alerts'));
    }
}

