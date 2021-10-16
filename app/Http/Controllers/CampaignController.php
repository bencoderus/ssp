<?php

namespace App\Http\Controllers;

use App\Http\Requests\Campaign\CreateCampaignRequest;
use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use App\Models\CampaignImage;
use App\Services\FileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class CampaignController extends Controller
{
    /**
     * Get all the campaigns associated with a user.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        $campaign = Campaign::where('user_id', Auth::id())->latest()->paginate();

        $campaignResource = CampaignResource::collection($campaign)->response()->getData();

        return Inertia::render('Campaign/Index', [
            'campaigns' => $campaignResource,
        ]);
    }

    /**
     * Create a campaign (Render the interface that allows users create a new campaign).
     *
     * @return \Inertia\Response
     */
    public function create(): Response
    {
        return Inertia::render('Campaign/Create');
    }

    /**
     * Edit a campaign (Render the interface that allows users edit their campaign).
     *
     * @param \App\Models\Campaign $campaign
     *
     * @return \Illuminate\Http\RedirectResponse|\Inertia\Response
     */
    public function edit(Campaign $campaign)
    {
        if (Auth::id() !== $campaign->user_id) {
            return redirect()->back()->with('error', __('constants.unauthorized'));
        }

        $campaignResource = new CampaignResource($campaign);

        return Inertia::render('Campaign/Edit', [
            'campaign' => $campaignResource,
        ]);
    }

    /**
     * Create a new campaign.
     *
     * @param \App\Http\Requests\Campaign\CreateCampaignRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCampaignRequest $request): RedirectResponse
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

        if ($request->hasFile('images')) {
            $this->uploadMultiple($request->file('images'), $campaign);
        }

        return redirect()->route('campaign.index')->with('success', 'Campaign created successfully.');
    }

    /**
     * Upload multiple images.
     *
     * @param array $files
     * @param \App\Models\Campaign $campaign
     */
    private function uploadMultiple(array $files, Campaign $campaign): void
    {
        foreach ($files as $file) {
            $image = FileService::upload($file, CampaignImage::IMAGE_PATH);

            $campaign->images()->create(['title' => $image]);
        }
    }

    /**
     * Delete an image.
     *
     * @param \App\Models\CampaignImage $image
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteImage(CampaignImage $image): RedirectResponse
    {
        if (Auth::id() !== $image->campaign->user_id) {
            return redirect()->back()->with('error', __('constants.unauthorized'));
        }

        FileService::deleteFile(CampaignImage::IMAGE_PATH, $image->title);
        $image->delete();

        return redirect()->back()->with('success', 'Image removed successfully');
    }

    /**
     * Update a campaign record.
     *
     * @param \App\Models\Campaign $campaign
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Campaign $campaign, Request $request): RedirectResponse
    {
        if (Auth::id() !== $campaign->user_id) {
            return redirect()->back()->with('error', __('constants.unauthorized'));
        }

        $campaign->update([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'daily_budget' => $request->daily_budget,
            'total_budget' => $request->total_budget,
        ]);

        if ($request->hasFile('images')) {
            $this->uploadMultiple($request->file('images'), $campaign);
        }

        return redirect()->route('campaign.index')->with('success', __('constants.unauthorized'));
    }
}
