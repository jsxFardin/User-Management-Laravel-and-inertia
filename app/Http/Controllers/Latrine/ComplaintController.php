<?php

namespace App\Http\Controllers\Latrine;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComplaintRequest;
use App\Http\Requests\UpdateComplaintRequest;
use App\Models\Agency;
use App\Models\Latrine\Complaint;
use App\Models\Latrine\Latrine;
use App\Models\Team;
use App\Traits\PermissionHandler;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ComplaintController extends Controller
{
    use  PermissionHandler;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list-complaint', Complaint::class);

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
        foreach ($agencies as $agency):
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

        $complaint = DB::table('complaints as cm')
            ->join('latrines as lt', 'cm.latrine_id', 'lt.id')
            ->when(!auth()->user()->isAdmin(), function($query) {
                $query->whereIn('cm.latrine_id', $this->getUserlatrineId());
            })
            ->when(!is_null(request()->search), function($query) {
                $query->where('lt.uid_no', 'LIKE', '%' . request()->search . '%');
            })
            ->when(!is_null(request()->camp), function($query) {
                $query->where('lt.camp_id', request()->camp);
            })
            ->when(!is_null(request()->block), function($query) {
                $query->where('lt.block_id', request()->block);
            })
            ->when(request()->has('name'), function($query) {
                $query->orderBy(request()->name, request()->sort);
            })
            ->select('cm.id', 'lt.uid_no', 'cm.complaint', 'cm.status', 'cm.remarks')
            ->selectRaw('CASE cm.status WHEN "Pending" THEN 0 WHEN "Verified" THEN 1 END as active')
            ->paginate(request()->max_count ?? 10);

        // FOR CAMP AND BLOCKS
        $user = auth()->user();
        $isAgency = $user->isAgency();
        $request = new Request([
            'user_id' => $user->id,
        ]);
        if ($isAgency) :
            $agency = new Agency();
            $agencies = $agency->agencyCampBlock($request, false, true);
        endif;
        if (!$isAgency) :
            $team = new Team();
            $agencies = $team->teamCampBlock($request, false, true);
        endif;
        // return $agencies;
        $camps = [];
        $blocks = [];
        foreach ($agencies as $agency) :
            if ($agency['camp']) :
                array_push($camps, $agency['camp']);
            endif;
            if (count($agency['blocks']) != 0) :
                foreach ($agency['blocks'] as $block) :
                    array_push($blocks, $block);
                endforeach;
            endif;
        endforeach;
        if($user->isAdmin()):
            $camps = DB::table('camps')->select('id as value', 'name as label')->get();
            $blocks = DB::table('blocks')->select('id as value', 'short_name as label')
                // ->where('camp_id', $latrine->camp_id)
                ->get();
        endif;

        return Inertia::render('Latrine/Complaint/index', [
            'lists'     => $complaint,
            'access'    => $this->accessLists(Complaint::class, 'complaint'),
            'camps'     => $camps,
            'blocks'    => $blocks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-complaint', Complaint::class);
        $latrines = Latrine::select('id as value', 'uid_no as label')
            ->when(!auth()->user()->isAdmin(), function ($query) {
                return $query->whereIn('id', $this->getUserlatrineId());
            })->get();

        return Inertia::render(
            'Latrine/Complaint/create',
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
    public function store(StoreComplaintRequest $request)
    {
        $this->authorize('create-complaint', Complaint::class);
        try {
            DB::beginTransaction();
            Complaint::create($request->all());
            DB::commit();
            return redirect()->route('complaint.index');
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
        $complaint =  DB::table('complaints as cm')
            ->join('latrines as lt', 'cm.latrine_id', 'lt.id')
            ->select('cm.id', 'lt.uid_no', 'cm.complaint', 'cm.status', 'cm.remarks')
            ->where('cm.id', $id)->first();
        return Inertia::render('Latrine/Complaint/show', [
            'item' => $complaint,
            'access' => $this->accessLists(Complaint::class, 'complaint')
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
        $this->authorize('edit-complaint', Complaint::class);
        $data = Complaint::select('id', 'latrine_id', 'complaint as name', 'status', 'remarks')->where('id', $id)->first();
        $latrines = Latrine::select('id as value', 'uid_no as label')
            ->when(!auth()->user()->isAdmin(), function ($query) {
                return $query->whereIn('id', $this->getUserlatrineId());
            })->get();

        return Inertia::render(
            'Latrine/Complaint/edit',
            [
                'data' => $data,
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
    public function update(UpdateComplaintRequest $request, Complaint $complaint)
    {
        $this->authorize('edit-complaint', Complaint::class);
        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['complaint'] = $request->name;
            $complaint->update($data);
            DB::commit();
            return redirect()->route('complaint.index');
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
    public function destroy(Complaint $complaint)
    {
        $this->authorize('destroy-complaint', Complaint::class);

        $complaint->delete();
        return redirect()->route('complaint.index');
    }

    public function updateStatus(Request $request, Complaint $complaint)
    {
        $this->authorize('edit-complaint', Complaint::class);

        try {
            DB::beginTransaction();
            $data = [
                'status' => $request->active ? 'Verified' : 'Pending'
            ];
            $complaint->update($data);

            DB::commit();
            return redirect()->route('complaint.index');
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
