<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\Latrine\Setup\FacilityUsed;
use App\Http\Requests\StoreFacilityUsedRequest;
use App\Http\Requests\UpdateFacilityUsedRequest;
use App\Traits\PermissionHandler;
use Exception;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class FacilityUsedController extends Controller
{
    use PermissionHandler;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list-facility-used', FacilityUsed::class);

        $list = FacilityUsed::
            when(request()->has('search'), function($query) {
                $query->where('name', 'LIKE', '%' . request()->search . '%');
            })
            ->when(request()->has('name'), function($query) {
                $query->orderBy(request()->name, request()->sort);
            })
            ->paginate(request()->max_count ?? 10);

        return Inertia::render(
            'Setup/Facility-Used/index',
            [
                'list' => $list,
                'access' => $this->accessLists(FacilityUsed::class, 'facility-used')
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-facility-used', FacilityUsed::class);

        return Inertia::render(
            'Setup/Facility-Used/create'

        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFacilityUsedRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFacilityUsedRequest $request)
    {
        $this->authorize('create-facility-used', FacilityUsed::class);

        try {
            DB::beginTransaction();
            FacilityUsed::create($request->all());

            DB::commit();
            return redirect()->route('setup.facility-used.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Latrine\Setup\FacilityUsed  $facilityUsed
     * @return \Illuminate\Http\Response
     */
    public function show(FacilityUsed $facilityUsed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Latrine\Setup\FacilityUsed  $facilityUsed
     * @return \Illuminate\Http\Response
     */
    public function edit(FacilityUsed $facilityUsed)
    {
        $this->authorize('edit-facility-used', $facilityUsed);

        return Inertia::render(
            'Setup/Facility-Used/edit',
            [
                'facilityUsed' => $facilityUsed
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFacilityUsedRequest  $request
     * @param  \App\Models\Latrine\Setup\FacilityUsed  $facilityUsed
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFacilityUsedRequest $request, FacilityUsed $facilityUsed)
    {
        $this->authorize('edit-facility-used', $facilityUsed);

        try {
            DB::beginTransaction();
            $facilityUsed->update($request->all());

            DB::commit();
            return redirect()->route('setup.facility-used.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Latrine\Setup\FacilityUsed  $facilityUsed
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacilityUsed $facilityUsed)
    {
        $this->authorize('destroy-facility-used', $facilityUsed);

        $facilityUsed->delete();
        return redirect()->route('setup.facility-used.index');
    }
}
