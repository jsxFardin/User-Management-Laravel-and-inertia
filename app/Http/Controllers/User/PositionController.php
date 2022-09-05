<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PositionRequest;
use App\Models\Position;
use App\Traits\AutoUserActivityLog;
use App\Traits\PermissionHandler;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PositionController extends Controller
{
    use PermissionHandler;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list-position', Position::class);

        $lists = Position::
            when(request()->has('name'), function($query){
                $query->orderBy(request()->name, request()->sort);
            })
            ->paginate(request()->max_count ?? 10);

        return Inertia::render('User/Position/Index', [
            'list' => $lists,
            'access' => $this->accessLists(Position::class, 'position')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-position', Position::class);

        return Inertia::render('User/Position/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PositionRequest $request)
    {
        $this->authorize('create-position', Position::class);

        DB::beginTransaction();
        try{
            $data = $request->all();
            Position::create($data);
            // DB::table('positions')->insert($data);

            DB::commit();
            return redirect()->route('position.index');

        } catch(Exception $exp) {
            DB::rollBack();
            return redirect()->back()->with('message', $exp->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        $this->authorize('edit-position', $position);

        return Inertia::render('User/Position/Edit', [
            'position' => $position
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PositionRequest $request, Position $position)
    {
        $this->authorize('edit-position', $position);

        DB::beginTransaction();
        try{
            $data = $request->all();
            $position->update($data);

            DB::commit();
            return redirect()->route('position.index');

        } catch(Exception $exp) {
            DB::rollBack();
            return redirect()->back()->with('message', $exp->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        $this->authorize('destroy-position', $position);

        $position->delete();
        return redirect()->back();
    }
}
