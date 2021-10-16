<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Campaign;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Campaign\CreateCampaignRequest;
use App\Http\Requests\Campaign\UpdateCampaignRequest;

class CampaignController extends Controller
{
    public function index()
    {
        $campaign = Campaign::with(['images'])
            ->where('user_id', Auth::id())
            ->paginate();

        return Inertia::render('Campaign/Index', [
            'campaigns' => $campaign,
        ]);
    }

    public function create()
    {
        return Inertia::render('Campaign/Create');
    }

    public function edit()
    {
        return Inertia::render('Campaign/Edit');
    }

    public function store(CreateCampaignRequest $request)
    {
        $campaign = Campaign::create([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'daily_budget' => $request->daily_budget,
            'total_budget' => $request->total_budget,
            'code' => Campaign::generateCode(),
            'user_id' => Auth::id()
        ]);

        return redirect()->route('campaign.index')->with('success', 'Campaign created successfully.');
    }

    public function update(UpdateCampaignRequest $request)
    {
        $campaign = Campaign::create($request->validated());

        return redirect()->route('campaigns.index')->with('success', 'Campaign created successfully.');
    }
}
