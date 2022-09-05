<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSeasonRequest;
use App\Models\Season;
use App\Traits\PermissionHandler;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Termwind\Components\Dd;

class SeasonController extends Controller
{
    use PermissionHandler;

    public function index()
    {
        $this->authorize('list-season', Season::class);

        $rainySeason = Season::select('id as value', 'months as label')->find(1);
        $drySeason = Season::select('id as value', 'months as label')->find(2);

        $rainySeasonMonths = explode(',', $rainySeason->label);
        $drySeasonMonths = explode(',', $drySeason->label);

        return Inertia::render(
            'Setup/Season/index',
            [
                'rainySeason' => $rainySeasonMonths,
                'drySeason' => $drySeasonMonths,
                'access' => $this->accessLists(Season::class, 'season')
            ]
        );
    }

    public function update(UpdateSeasonRequest $request, Season $season)
    {
        $this->authorize('edit-season', $season);
        // dd( $request->all());
        try {

            $otherSeasonId = $season->id == 1 ? 2 : 1;
            $otherSeason = Season::find($otherSeasonId);
            $otherSeasonMonths = explode(',', $otherSeason->months);
            $result = array_intersect($request->months, $otherSeasonMonths);

            if (count($result) > 0) {
                return redirect()->back()->withErrors([
                    'message' => 'The months you selected are already in use by another season.'
                ]);
            }

            $data = [
                'months' => implode(',', $request->input('months'))
            ];
            DB::beginTransaction();
            $season->update($data);

            DB::commit();
            return redirect()->route('setup.season.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }
    }
}
