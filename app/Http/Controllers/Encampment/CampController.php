<?php

namespace App\Http\Controllers\Encampment;

use App\Http\Controllers\BaseController;
use App\Models\Encampment\Camp;
use App\Http\Requests\StoreCampRequest;
use App\Http\Requests\UpdateCampRequest;
use App\Interfaces\BlockInterface;
use App\Interfaces\CampInterface;
use App\Traits\PermissionHandler;
use Exception;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CampController extends BaseController
{
    protected $camp;
    protected $block;

    use PermissionHandler;

    public function __construct(CampInterface $camp, BlockInterface $block)
    {
        $this->camp = $camp;
        $this->block = $block;

        $this->setService($this->camp);
        $this->setService($this->block);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list-camp', Camp::class);

        $camps = $this->camp->lists(true, request()->all(), true);

        return Inertia::render(
            'Setup/Encampment/Camp/index',
            [
                'list' => $camps,
                'access' => $this->accessLists(Camp::class, 'camp')
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
        $this->authorize('create-camp', Camp::class);

        return Inertia::render(
            'Setup/Encampment/Camp/create'

        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCampRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCampRequest $request)
    {
        $this->authorize('create-camp', Camp::class);

        try {
            DB::beginTransaction();
            Camp::create($request->all());

            DB::commit();
            return redirect()->route('setup.camp.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Encampment\Camp  $camp
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $camp = $this->camp->show($id);

        $blockIds =  mapBlocks($camp->block, false, true);
        $blocks = $this->block->lists(false, ['block' => $blockIds]);
        $agencies = mapAgencies($camp->agency);

        return Inertia::render('Setup/Encampment/Camp/show', [
            'camp' => $camp,
            'blocks' => $blocks,
            'agencies' => $agencies,
            'access' => $this->accessLists(User::class, 'show-user')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Encampment\Camp  $camp
     * @return \Illuminate\Http\Response
     */
    public function edit(Camp $camp)
    {
        $this->authorize('edit-camp', $camp);

        return Inertia::render(
            'Setup/Encampment/Camp/edit',
            [
                'camp' => $camp
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCampRequest  $request
     * @param  \App\Models\Encampment\Camp  $camp
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCampRequest $request, Camp $camp)
    {
        $this->authorize('edit-camp', $camp);

        try {
            DB::beginTransaction();
            $camp->update($request->all());

            DB::commit();
            return redirect()->route('setup.camp.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Encampment\Camp  $camp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Camp $camp)
    {
        $this->authorize('destroy-camp', $camp);

        $camp->delete();
        return redirect()->route('setup.camp.index');
    }
}
