<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\TeamRequest;
use App\Interfaces\AgencyInterface;
use App\Interfaces\CampInterface;
use App\Interfaces\TeamInterface;
use App\Models\Team;
use App\Traits\PermissionHandler;
use App\Traits\UniqueIdGenerator;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TeamController extends BaseController
{
    protected $team;
    protected $agency;
    protected $camp;

    use UniqueIdGenerator, PermissionHandler;

    public function __construct(TeamInterface $team, AgencyInterface $agency, CampInterface $camp)
    {
        $this->team = $team;
        $this->agency = $agency;
        $this->camp = $camp;

        $this->setService($this->team);
        $this->setService($this->agency);
        $this->setService($this->camp);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list-team', Team::class);

        $lists    = $this->team->lists(true, request()->all(), true);

        $campData = $this->camp->lists();
        $campData = mapArray($campData, true, true, ['block', 'camp', 'agency']);

        return Inertia::render('Team/Index', [
            'lists' => $lists,
            'access' => $this->accessLists(Team::class, 'team'),
            'camps' => $campData['camp'] ?? [],
            'blocks' => $campData['block'] ?? [],
            'agencies' => $campData['agency'] ?? [],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-team', Team::class);

        $agencyData = $this->agency->lists();
        $agencyData = mapArray($agencyData, true, true, ['agency']);

        return Inertia::render('Team/Create', [
            'agencies' => $agencyData['agency'] ?? []
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamRequest $request)
    {
        $this->authorize('create-team', Team::class);

        try {
            DB::beginTransaction();

            $this->team->storeData(collect(request()->all()));

            DB::commit();
            return redirect()->route('team.index');
        } catch (\Exception $exp) {
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
        $this->authorize('show-team', Team::class);

        $teamData             = $this->team->show($id);
        $teamData->user       = mapUsers($teamData->user);
        $teamData->campBlock  = mapCampBlocks($teamData->camp, $teamData->block, false, false);
        unset($teamData->camp); unset($teamData->block);

        return Inertia::render('Team/Show', [
            'team' => $teamData
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
        $this->authorize('edit-team', Team::class);

        $team       = $this->team->show($id);
        $team->assigns  = mapCampBlocks($team->camp, $team->block, false, true);
        unset($team->user);

        // For agency
        $agency     = $this->agency->lists();
        $agency     = setMapping($agency, 'id', 'agency_name');

        // For camp and blocks
        $campData = mapCampBlocks($team->camp, $team->block, false, false);
        $camps  = []; $blocks = [];

        foreach ($campData as $item) :
            array_push($camps, [
                'value' => $item['id'],
                'label' => $item['name'],
            ]);
            array_push($blocks, array_map(function ($block) {
                return [
                    'value' => $block['id'],
                    'label' => $block['name'],
                ];
            }, $item['blocks']));
        endforeach;

        return Inertia::render('Team/Edit', [
            'agencies' => $agency,
            'team' => $team,
            'campNames' => $camps,
            'blockNames' => $blocks,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $this->authorize('edit-team', Team::class);

        try {
            DB::beginTransaction();

            $this->team->updateData(collect(request()->all()), $id);

            DB::commit();
            return redirect()->route('team.index');
        } catch (\Exception $exp) {
            DB::rollBack();
            return redirect()->back()->with('message', $exp->getMessage());
        }
    }

    public function updateStatus(Request $request, Team $team)
    {
        $this->authorize('status-team', $team);

        try {
            DB::beginTransaction();
            $team->update(['active' => $request->active]);
            DB::commit();
            return redirect()->route('team.index');
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
    public function destroy(Team $team)
    {
        $this->authorize('destroy-team', $team);

        DB::beginTransaction();
        try {
            $this->team->destroy($team->id);

            DB::commit();
            return redirect()->route('team.index');
        } catch (\Exception $exp) {
            DB::rollBack();
            return redirect()->back()->with('message', $exp->getMessage());
        }
    }

    public function teamDetails()
    {
         if(request()->has('agency') || request()->has('agency_id')):
            $teams = $this->team->lists(false,
                ['agency' => request()->agency ? request()->agency : request()->agency_id]
            );
            return $teams = setMapping($teams, 'id', 'team_name', 'agency_id');
        endif;
    }
}
