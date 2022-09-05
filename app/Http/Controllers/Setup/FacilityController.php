<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\Latrine\Setup\Facility;
use App\Http\Requests\StoreFacilityRequest;
use App\Http\Requests\UpdateFacilityRequest;
use App\Traits\FormateDropDown;
use App\Traits\PermissionHandler;
use Exception;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class FacilityController extends Controller
{
    use FormateDropDown, PermissionHandler;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list-facility', Facility::class);

        $facility = DB::table('facility_types as ft')
            ->leftJoin('facility_types as ft2', 'ft2.parent_id', 'ft.id')
            ->select('ft.id', 'ft2.name as parent', 'ft.name', 'ft.active')
            ->when(request()->has('search'), function ($query) {
                $query->where('ft.name', 'LIKE', '%' . request()->search . '%');
            })
            ->when(request()->has('name'), function ($query) {
                $query->orderBy(request()->name, request()->sort);
            })
            ->paginate(request()->max_count ?? 10);

        return Inertia::render(
            'Setup/Facility/index',
            [
                'list' => $facility,
                'access' => $this->accessLists(Facility::class, 'facility')
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
        $this->authorize('create-facility', Facility::class);

        $parent = $this->FormateDropDown(Facility::where('parent_id', null)->get());
        return Inertia::render(
            'Setup/Facility/create',
            ['parent' => $parent]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFacilityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFacilityRequest $request)
    {
        $this->authorize('create-facility', Facility::class);

        try {
            DB::beginTransaction();
            Facility::create($request->all());

            DB::commit();
            return redirect()->route('setup.facility.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Latrine\Setup\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function show(Facility $facility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Latrine\Setup\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function edit(Facility $facility)
    {
        $this->authorize('edit-facility', $facility);

        $parent = $this->formateDropDown(Facility::where('parent_id', null)->get());
        return Inertia::render(
            'Setup/Facility/edit',
            [
                'parent' => $parent,
                'facility' => $facility
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFacilityRequest  $request
     * @param  \App\Models\Latrine\Setup\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFacilityRequest $request, Facility $facility)
    {
        $this->authorize('edit-facility', $facility);

        try {
            DB::beginTransaction();
            $facility->update($request->all());

            DB::commit();
            return redirect()->route('setup.facility.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Latrine\Setup\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facility $facility)
    {
        $this->authorize('destroy-facility', $facility);

        $facility->delete();
        return redirect()->route('setup.facility.index');
    }
}
