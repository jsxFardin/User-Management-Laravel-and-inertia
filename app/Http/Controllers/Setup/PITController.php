<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\Latrine\Setup\Pit;
use App\Http\Requests\StorePitRequest;
use App\Http\Requests\UpdatePitRequest;
use App\Traits\PermissionHandler;
use Exception;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PITController extends Controller
{
    use PermissionHandler;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list-pit', Pit::class);

        $list = PIT::when(request()->has('search'), function ($query) {
                $query->where('name', 'LIKE', '%' . request()->search . '%');
            })
            ->when(request()->has('name'), function ($query) {
                $query->orderBy(request()->name, request()->sort);
            })
            ->paginate(request()->max_count ?? 10);

        return Inertia::render(
            'Setup/PIT/index',
            [
                'list' => $list,
                'access' => $this->accessLists(Pit::class, 'pit')
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
        $this->authorize('create-pit', Pit::class);

        return Inertia::render(
            'Setup/PIT/create'

        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePitRequest $request)
    {
        $this->authorize('create-pit', Pit::class);

        try {
            DB::beginTransaction();
            Pit::create($request->all());

            DB::commit();
            return redirect()->route('setup.pit.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Latrine\Setup\Pit  $pit
     * @return \Illuminate\Http\Response
     */
    public function show(Pit $pit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Latrine\Setup\Pit  $pit
     * @return \Illuminate\Http\Response
     */
    public function edit(Pit $pit)
    {
        $this->authorize('edit-pit', $pit);

        return Inertia::render(
            'Setup/PIT/edit',
            [
                'pit' => $pit
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePitRequest  $request
     * @param  \App\Models\Latrine\Setup\Pit  $pit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePitRequest $request, Pit $pit)
    {
        $this->authorize('edit-pit', $pit);

        try {
            DB::beginTransaction();
            $pit->update($request->all());

            DB::commit();
            return redirect()->route('setup.pit.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Latrine\Setup\Pit  $pit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pit $pit)
    {
        $this->authorize('destroy-pit', $pit);

        $pit->delete();
        return redirect()->route('setup.pit.index');
    }
}
