<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\Latrine\Setup\Structure;
use App\Http\Requests\StoreStructureRequest;
use App\Http\Requests\UpdateStructureRequest;
use App\Traits\PermissionHandler;
use Exception;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class StructureController extends Controller
{
    use PermissionHandler;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list-structure', Structure::class);

        $list = Structure::
            when(request()->has('search'), function($query) {
                $query->where('name', 'LIKE', '%' . request()->search . '%');
            })
            ->when(request()->has('name'), function($query) {
                $query->orderBy(request()->name, request()->sort);
            })
            ->paginate(request()->max_count ?? 10);

        return Inertia::render(
            'Setup/Structure/index',
            [
                'list' => $list,
                'access' => $this->accessLists(Structure::class, 'structure')
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
        $this->authorize('create-structure', Structure::class);

        return Inertia::render(
            'Setup/Structure/create'

        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStructureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStructureRequest $request)
    {
        $this->authorize('create-structure', Structure::class);

        try {
            DB::beginTransaction();
            Structure::create($request->all());

            DB::commit();
            return redirect()->route('setup.structure.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Latrine\Setup\Structure  $structure
     * @return \Illuminate\Http\Response
     */
    public function show(Structure $structure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Latrine\Setup\Structure  $structure
     * @return \Illuminate\Http\Response
     */
    public function edit(Structure $structure)
    {
        $this->authorize('edit-structure', $structure);

        return Inertia::render(
            'Setup/Structure/edit',
            [
                'structure' => $structure
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStructureRequest  $request
     * @param  \App\Models\Latrine\Setup\Structure  $structure
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStructureRequest $request, Structure $structure)
    {
        $this->authorize('edit-structure', $structure);

        try {
            DB::beginTransaction();
            $structure->update($request->all());

            DB::commit();
            return redirect()->route('setup.structure.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Latrine\Setup\Structure  $structure
     * @return \Illuminate\Http\Response
     */
    public function destroy(Structure $structure)
    {
        $this->authorize('destroy-structure', $structure);

        $structure->delete();
        return redirect()->route('setup.structure.index');
    }
}
