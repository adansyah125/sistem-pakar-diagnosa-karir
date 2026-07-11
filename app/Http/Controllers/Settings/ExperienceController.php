<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\StoreExperienceRequest;
use App\Http\Requests\Settings\UpdateExperienceRequest;
use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExperienceController extends Controller
{
    public function store(StoreExperienceRequest $request): RedirectResponse
    {
        $request->user()->experiences()->create($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Pengalaman berhasil ditambahkan.')]);

        return to_route('profile.edit');
    }

    public function update(UpdateExperienceRequest $request, Experience $experience): RedirectResponse
    {
        abort_if($experience->user_id !== $request->user()->id, 403);

        $experience->update($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Pengalaman berhasil diperbarui.')]);

        return to_route('profile.edit');
    }

    public function destroy(Request $request, Experience $experience): RedirectResponse
    {
        abort_if($experience->user_id !== $request->user()->id, 403);

        $experience->delete();

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Pengalaman berhasil dihapus.')]);

        return to_route('profile.edit');
    }
}
