<?php

namespace App\Http\Controllers\Agency;

use App\Http\Controllers\BaseController;
use App\Http\Requests\AgencyRequest;
use Illuminate\Http\Request;
use App\Interfaces\AgencyInterface;
use App\Interfaces\BlockInterface;
use App\Interfaces\CampInterface;
use App\Interfaces\TeamInterface;
use App\Models\Agency;
use App\Traits\PermissionHandler;
use App\Traits\UniqueIdGenerator;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use phpseclib3\System\SSH\Agent;

class AgencyController extends BaseController
{
    protected $camp;
    protected $agency;
    protected $block;
    protected $team;

    use UniqueIdGenerator, PermissionHandler;

    public function __construct(AgencyInterface $agency, CampInterface $camp, BlockInterface $block, TeamInterface $team)
    {
        $this->camp     = $camp;
        $this->agency   = $agency;
        $this->block    = $block;
        $this->team     = $team;

        $this->setService($this->camp);
        $this->setService($this->agency);
        $this->setService($this->block);
        $this->setService($this->team);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list-agency', Agency::class);

        $campData = $this->camp->lists();
        $campData = mapArray($campData, true, true, ['block', 'camp']);

        $lists = $this->agency->lists(true, request()->all(), true);

        return Inertia::render('Agency/Index', [
            'lists' => $lists,
            'access' => $this->accessLists(Agency::class, 'agency'),
            'camps' => $campData['camp'] ?? [],
            'blocks' => $campData['block'] ?? []
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-agency', Agency::class);

        $campData = $this->camp->lists();
        $campData = mapArray($campData, true, true, ['block', 'camp']);

        return Inertia::render('Agency/Create', [
            'camps' => $campData['camp'] ?? [],
            'blocks' => $campData['block'] ?? [],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgencyRequest $request)
    {
        $this->authorize('create-agency', Agency::class);

        try {
            DB::beginTransaction();

            $this->agency->storeData(collect(request()->all()));

            DB::commit();
            return redirect()->route('agency.index');
        } catch (\Exception $exp) {
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
        $this->authorize('show-agency', Agency::class);

        $agencyData             = $this->agency->show($id);
        $agencyData->user       = mapUsers($agencyData->user);
        $agencyData->team       = mapTeams($agencyData->team );
        $agencyData->campBlock  = mapCampBlocks($agencyData->camp, $agencyData->block, false, false);
        unset($agencyData->camp); unset($agencyData->block);

        return Inertia::render('Agency/Show', [
            'agency' => $agencyData
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('edit-agency', Agent::class);
        $isAdmin = request()->user()->isAdmin();

        $agency             = $this->agency->show($id);
        $agency->assigns    = mapCampBlocks($agency->camp, $agency->block, false, true);
        unset($agency->user); unset($agency->team);

        // For camp and blocks
        $campData = mapCampBlocks($agency->camp, $agency->block, false, false);

        if($isAdmin):
            $ids = array_map(function($camp){
                return $camp['id'];
            }, $campData);

            $blockData = setMapping($this->block->lists(false, ['camp' => $ids]), 'id', 'short_name', 'camp_id');
            $blockData = json_decode($blockData, true);
        endif;

        $camps = []; $blocks = [];

        foreach ($campData as $i => $item) :
            array_push($camps, [
                'value' => $item['id'],
                'label' => $item['name'],
            ]);

            if(!$isAdmin):
                array_push($blocks, array_map(function ($block) {
                    return [
                        'value' => $block['id'],
                        'label' => $block['name'],
                    ];
                }, $item['blocks']));
            else:
                $blocks[$i] = array_values(array_filter($blockData, function($block) use($item) {
                    return data_get($item, 'id') == $block['camp_id'];
                }));
            endif;
        endforeach;

        return Inertia::render('Agency/Edit', [
            'agency'    => $agency,
            'camps'     => $camps,
            'blocks'    => $blocks,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AgencyRequest $request, Agency $agency)
    {
        $this->authorize('edit-agency', $agency);

        try {
            DB::beginTransaction();
            $result = $this->agency->updateData(collect(request()->all()), $agency->id);
            DB::commit();
            return redirect()->route('agency.index');
        } catch (\Exception $exp) {
            DB::rollBack();
            return redirect()->back()->with('message', $exp->getMessage());
        }
    }

    public function updateStatus(Request $request, Agency $agency)
    {
        $this->authorize('status-agency', $agency);

        try {
            DB::beginTransaction();
            $agency->update(['active' => $request->active]);
            DB::commit();
            return redirect()->route('agency.index');
        } catch (\Exception $exp) {
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
    public function destroy($id)
    {
        $this->authorize('destroy-agency', Agency::class);

        DB::beginTransaction();
        try {
            $this->agency->destroy($id);
            DB::commit();
            return redirect()->route('agency.index');
        } catch (\Exception $exp) {
            DB::rollBack();
            return redirect()->back()->with('message', $exp->getMessage());
        }
    }

}
