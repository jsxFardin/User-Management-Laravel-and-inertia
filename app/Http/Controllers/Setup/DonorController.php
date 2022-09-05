<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use App\Http\Requests\StoreDonorRequest;
use App\Http\Requests\UpdateDonorRequest;
use App\Traits\PermissionHandler;
use Exception;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DonorController extends Controller
{
    use PermissionHandler;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list-donor', Donor::class);

        $list = Donor::when(request()->has('search'), function ($query) {
                $query->where('name', 'LIKE', '%' . request()->search . '%');
            })
            ->when(request()->has('name'), function ($query) {
                $query->orderBy(request()->name, request()->sort);
            })
            ->paginate(request()->max_count ?? 10);

        return Inertia::render(
            'Setup/Donor/index',
            [
                'list' => $list,
                'access' => $this->accessLists(Donor::class, 'donor')
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
        $this->authorize('create-donor', Donor::class);

        return Inertia::render(
            'Setup/Donor/create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDonorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDonorRequest $request)
    {
        $this->authorize('create-donor', Donor::class);

        try {
            DB::beginTransaction();
            Donor::create($request->all());
            DB::commit();
            return redirect()->route('setup.donor.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donor  $donor
     * @return \Illuminate\Http\Response
     */
    public function show(Donor $donor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donor  $donor
     * @return \Illuminate\Http\Response
     */
    public function edit(Donor $donor)
    {
        $this->authorize('edit-donor', $donor);

        return Inertia::render(
            'Setup/Donor/edit',
            [
                'donor' => $donor
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDonorRequest  $request
     * @param  \App\Models\Donor  $donor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDonorRequest $request, Donor $donor)
    {
        $this->authorize('edit-donor', $donor);

        try {
            DB::beginTransaction();
            $donor->update($request->all());

            DB::commit();
            return redirect()->route('setup.donor.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donor  $donor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donor $donor)
    {
        $this->authorize('destroy-donor', $donor);

        $donor->delete();
        return redirect()->route('setup.donor.index');
    }
}
