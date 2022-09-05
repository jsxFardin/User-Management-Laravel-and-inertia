<?php

namespace App\Http\Controllers\Latrine;

use App\Http\Controllers\BaseController;
use App\Models\Latrine\Latrine;
use App\Http\Requests\StoreLatrineRequest;
use App\Http\Requests\UpdateLatrineRequest;
use App\Interfaces\BlockInterface;
use App\Interfaces\CampInterface;
use App\Interfaces\LatrineInterface;
use App\Traits\FormateDropDown;
use App\Traits\PermissionHandler;
use Exception;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Http\Request;

class LatrineController extends BaseController
{
    use FormateDropDown, PermissionHandler;

    protected $latrine;
    protected $camp;
    protected $block;

    public function __construct(LatrineInterface $latrine, CampInterface $camp, BlockInterface $block)
    {
        $this->latrine  = $latrine;
        $this->camp     = $camp;
        $this->block     = $block;

        $this->setService($this->latrine);
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
        $this->authorize('list-latrine', Latrine::class);

        $campData = $this->camp->lists();
        $campData = mapArray($campData, true, true, ['block', 'camp']);

        $lists = $this->latrine->lists(true, request()->all(), true);
        $lists = $lists->appends(request()->all());

        $getLatrineData = getLatrineSetUpData();

        return Inertia::render('Latrine/Latrine/index', [
            'lists'         => $lists,
            'access'        => $this->accessLists(Latrine::class, 'latrine'),
            'facilityTypes' => $getLatrineData['facility_type'] ?? [],
            'facilityUseds' => $getLatrineData['facility_useds'] ?? [],
            'constStatus'   => $getLatrineData['construction_status'] ?? [],
            'latStructure'  => $getLatrineData['latrine_structures'] ?? [],
            'camps'         => $campData['camp'] ?? [],
            'blocks'        => $campData['block'] ?? [],
            'sanitationZones' => $getLatrineData['sanitation_zones'] ?? [],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-latrine', Latrine::class);

        $campData = $this->camp->lists();
        $campData = mapArray($campData, true, true, ['block', 'camp']);

        // CALL LATRINE SETUP DATA
        $getLatrineData = getLatrineSetUpData();

        return Inertia::render(
            'Latrine/Latrine/Create',
            [
                'camps' => $campData['camp'] ?? [],
                'blocks' => $campData['block'] ?? [],
                'facilityTypes' => $getLatrineData['facility_type'] ?? [],
                'facilityUseds' => $getLatrineData['facility_useds'] ?? [],
                'constructionStatus' => $getLatrineData['construction_status'] ?? [],
                'pits' => $getLatrineData['pit_types'] ?? [],
                'latrineStructure' => $getLatrineData['latrine_structures'] ?? [],
                'donor' => $getLatrineData['donors'] ?? [],
                'sanitationZones' => $getLatrineData['sanitation_zones'] ?? [],
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLatrineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLatrineRequest $request)
    {
        $this->authorize('create-latrine', Latrine::class);

        try {
            DB::beginTransaction();
            $this->latrine->storeData($request);
            DB::commit();
            return redirect()->route('latrine.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Latrine\Latrine  $latrine
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('show-latrine', Latrine::class);

        $list = $this->latrine->show($id);

        return Inertia::render('Latrine/Latrine/show', [
            'latrine' => $list
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Latrine\Latrine  $latrine
     * @return \Illuminate\Http\Response
     */
    public function edit(Latrine $latrine)
    {
        $this->authorize('edit-latrine', $latrine);

        $subBlocks = [];
        if (!is_null($latrine->block_id)):
            $subBlocks = $this->block->lists(false, ['parent_id' => $latrine->block_id]);
            $subBlocks = setMapping($subBlocks, 'id', 'short_name', 'camp_id');
        endif;

        //For camp and blocks
        $campData = $this->camp->lists();
        $campData = mapArray($campData, true, true, ['block', 'camp']);

        // CALL LATRINE SETUP DATA
        $getLatrineData = getLatrineSetUpData();

        return Inertia::render(
            'Latrine/Latrine/Edit',
            [
                'latrine'           => $latrine,
                'camps'             => $campData['camp'] ?? [],
                'blocks'            => $campData['block'] ?? [],
                'subBlocks'         => $subBlocks,
                'facilityTypes'     => $getLatrineData['facility_type'] ?? [],
                'facilityUseds'     => $getLatrineData['facility_useds'] ?? [],
                'constructionStatus'=> $getLatrineData['construction_status'] ?? [],
                'pits'              => $getLatrineData['pit_types'] ?? [],
                'latrineStructure'  => $getLatrineData['latrine_structures'] ?? [],
                'donor'             => $getLatrineData['donors'] ?? [],
                'sanitationZones'   => $getLatrineData['sanitation_zones'] ?? []
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLatrineRequest  $request
     * @param  \App\Models\Latrine\Latrine  $latrine
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLatrineRequest $request, Latrine $latrine)
    {
        $this->authorize('edit-latrine', $latrine);

        try {
            DB::beginTransaction();
            $this->latrine->updateData($request, $latrine->id);
            DB::commit();
            return redirect()->route('latrine.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function updateStatus(Request $request, Latrine $latrine)
    {
        $this->authorize('status-latrine', $latrine);

        try {
            DB::beginTransaction();
            $latrine->update(['active' => $request->active]);
            DB::commit();
            return redirect()->route('latrine.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Latrine\Latrine  $latrine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Latrine $latrine)
    {
        $this->authorize('destroy-latrine', $latrine);

        $latrine->delete();
        return redirect()->route('latrine.index');
    }
}
