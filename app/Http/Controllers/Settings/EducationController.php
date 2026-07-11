<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\StoreEducationRequest;
use App\Http\Requests\Settings\UpdateEducationRequest;
use App\Models\Education;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EducationController extends Controller
{
    public function store(StoreEducationRequest $request): RedirectResponse
    {
        $request->user()->education()->create($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Pendidikan berhasil ditambahkan.')]);

        return to_route('profile.edit');
    }

    public function update(UpdateEducationRequest $request, Education $education): RedirectResponse
    {
        abort_if($education->user_id !== $request->user()->id, 403);

        $education->update($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Pendidikan berhasil diperbarui.')]);

        return to_route('profile.edit');
    }

    public function destroy(Request $request, Education $education): RedirectResponse
    {
        abort_if($education->user_id !== $request->user()->id, 403);

        $education->delete();

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Pendidikan berhasil dihapus.')]);

        return to_route('profile.edit');
    }
}
