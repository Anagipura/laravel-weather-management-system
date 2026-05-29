<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use App\Models\RiskLevel;
use Illuminate\Http\Request;

class RiskLevelController extends Controller
{
    public function index() {
        $alerts = Alert::latest()->get();
        $riskLevels = RiskLevel::latest()->get();
        return view('admin.alerts.index', compact('alerts', 'riskLevels'));
    }

    public function create() {
        return view("admin.risk.create");
    }

    public function store(Request $request) {
        RiskLevel::create($request->only([
            'country',
            'risklevel',
            'description'
        ]));

        return redirect()->route('admin.risk.index' )->with("Success", "RiskLevel Added");
    }

    public function edit($id)
    {
        $risk = RiskLevel::findOrFail($id);
        return view('admin.risk.edit', compact('risk'));
    }

    public function update(Request $request, $id)
    {
        $risk = RiskLevel::findOrFail($id);

        $risk->update($request->only([
            'country',
            'risklevel',
            'description'
        ]));

        return redirect()->route('admin.risk.index')
            ->with('success', 'Updated successfully!');
    }

    public function destroy($id)
    {
        RiskLevel::findOrFail($id)->delete();

        return back()->with('success', 'Deleted!');
    }

}
