<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\Latrine\Setup\Status\Construction;
use App\Http\Requests\StoreConstructionRequest;
use App\Http\Requests\UpdateConstructionRequest;
use App\Traits\PermissionHandler;
use Exception;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ConstructionController extends Controller
{
    use PermissionHandler;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list-construction', Construction::class);

        $list = Construction::when(request()->has('search'), function ($query) {
                $query->where('name', 'LIKE', '%' . request()->search . '%');
            })
            ->when(request()->has('name'), function ($query) {
                $query->orderBy(request()->name, request()->sort);
            })
            ->paginate(request()->max_count ?? 10);

        return Inertia::render(
            'Setup/Construction/index',
            [
                'list' => $list,
                'access' => $this->accessLists(Construction::class, 'construction')
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
        $this->authorize('create-construction', Construction::class);

        return Inertia::render(
            'Setup/Construction/create'

        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreConstructionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConstructionRequest $request)
    {
        $this->authorize('create-construction', Construction::class);

        try {
            DB::beginTransaction();
            Construction::create($request->all());

            DB::commit();
            return redirect()->route('setup.construction.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Latrine\Setup\Status\Construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function show(Construction $construction)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Latrine\Setup\Status\Construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function edit(Construction $construction)
    {
        $this->authorize('edit-construction', $construction);

        return Inertia::render(
            'Setup/Construction/edit',
            [
                'construction' => $construction
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateConstructionRequest  $request
     * @param  \App\Models\Latrine\Setup\Status\Construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConstructionRequest $request, Construction $construction)
    {
        $this->authorize('edit-construction', $construction);

        try {
            DB::beginTransaction();
            $construction->update($request->all());

            DB::commit();
            return redirect()->route('setup.construction.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Latrine\Setup\Status\Construction  $construction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Construction $construction)
    {
        $this->authorize('destroy-construction', $construction);

        $construction->delete();
        return redirect()->route('setup.construction.index');
    }
}
