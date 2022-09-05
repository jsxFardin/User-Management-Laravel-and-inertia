<?php

namespace App\Http\Controllers\Latrine;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInspectionRequest;
use App\Http\Requests\UpdateInspectionRequest;
use App\Models\Agency;
use App\Models\Latrine\Inspection;
use App\Models\Latrine\Latrine;
use App\Models\Team;
use App\Traits\PermissionHandler;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class InspectionController extends Controller
{
    use PermissionHandler;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list-inspection', Inspection::class);
        $request = request();
        $inspections = DB::table('inspections as inp')
            ->join('latrines as lt', 'inp.latrine_id', 'lt.id')
            ->when(!auth()->user()->isAdmin(), function ($query) {
                return $query->whereIn('inp.latrine_id', $this->getUserlatrineId());
            })
            ->select('inp.id', 'lt.uid_no', 'inp.count_filled_up_ring', 'inp.available_height_from_top', 'inp.remarks', 'inp.active')
            ->when(!is_null($request->name), function ($query) use ($request) {
                $query->orderBy($request->name, $request->sort);
            })
            ->when(!is_null(request()->search), function ($query) {
                $query->where('lt.uid_no', 'LIKE', '%' . request()->search . '%')
                    ->orwhere('inp.count_filled_up_ring', 'LIKE', '%' . request()->search . '%')
                    ->orwhere('inp.available_height_from_top', 'LIKE', '%' . request()->search . '%');
            })
            ->paginate(request()->max_count ?? 10);

        // $latrines = Latrine::select('id as value', 'uid_no as label')
        //     ->when(!auth()->user()->isAdmin(), function ($query) {
        //         return $query->whereIn('id', $this->getUserlatrineId());
        //     })->get();

        return Inertia::render('Latrine/Inspections/index', [
            'lists' => $inspections,
            'access' => $this->accessLists(Inspection::class, 'inspection'),
            'latrines' => [],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-inspection', Inspection::class);
        $latrines = Latrine::select('id as value', 'uid_no as label')
            ->when(!auth()->user()->isAdmin(), function ($query) {
                return $query->whereIn('id', $this->getUserlatrineId());
            })->get();

        return Inertia::render(
            'Latrine/Inspections/create',
            [
                'latrines' => $latrines
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInspectionRequest $request)
    {
        $this->authorize('create-inspection', Inspection::class);
        try {
            DB::beginTransaction();
            Inspection::create($request->all());
            DB::commit();
            return redirect()->route('inspection.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return back();
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
        $inspection = DB::table('inspections as inp')->join('latrines as lt', 'inp.latrine_id', 'lt.id')->where('inp.id', $id)->select('inp.id', 'lt.uid_no', 'inp.count_filled_up_ring', 'inp.available_height_from_top', 'inp.remarks', 'inp.active')->first();
        return Inertia::render('Latrine/Inspections/show', [
            'item' => $inspection,
            'access' => $this->accessLists(Inspection::class, 'inspection')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Inspection $inspection)
    {
        $this->authorize('edit-inspection', Inspection::class);
        $latrines = Latrine::select('id as value', 'uid_no as label')
            ->when(!auth()->user()->isAdmin(), function ($query) {
                return $query->whereIn('id', $this->getUserlatrineId());
            })->get();

        return Inertia::render(
            'Latrine/Inspections/edit',
            [
                'data' => $inspection,
                'latrines' => $latrines
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInspectionRequest $request, Inspection $inspection)
    {
        $this->authorize('edit-inspection', Inspection::class);
        try {
            DB::beginTransaction();
            $data = $request->all();
            $inspection->update($data);
            DB::commit();
            return redirect()->route('inspection.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inspection $inspection)
    {
        $this->authorize('destroy-inspection', Inspection::class);
        $inspection->delete();
        return redirect()->route('inspection.index');
    }

    public function updateStatus(Request $request, Inspection $inspection)
    {
        $this->authorize('edit-inspection', Inspection::class);

        try {
            DB::beginTransaction();
            $inspection->update(['active' => $request->active]);

            DB::commit();
            return redirect()->route('inspection.index');
        } catch (\Exception $exp) {
            DB::rollBack();
            return redirect()->back()->with('message', $exp->getMessage());
        }
    }

    private function getUserlatrineId()
    {
        $user = auth()->user();
        $isAgency = $user->isAgency();

        $request = new Request([
            'user_id' => $user->id,
        ]);

        if ($isAgency) :
            $agency = new Agency();
            $agencies = $agency->agencyCampBlock($request, true);
        endif;

        if (!$isAgency) :
            $team = new Team();
            $agencies = $team->teamCampBlock($request, true);
        endif;

        $camps = [];
        $blocks = [];
        foreach ($agencies as $agency) :
            if ($agency['camp_id']) :
                array_push($camps, $agency['camp_id']);
            endif;
            if (count($agency['block_id']) != 0) :
                foreach ($agency['block_id'] as $block) :
                    array_push($blocks, $block);
                endforeach;
            endif;
        endforeach;
        $camps = array_values(array_unique($camps));
        $blocks = array_values(array_unique($blocks));

        request()->merge([
            'blocks'    => $blocks,
            'camps'     => $camps,
        ]);
        $latrine = new Latrine();
        $lists = $latrine->getScopedLatrines(request(), false);
        $latrine_ids = $lists->map(function ($item) {
            return $item->id;
        });
        return $latrine_ids;
    }
}
