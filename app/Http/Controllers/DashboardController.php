<?php

namespace App\Http\Controllers;
use App\Interfaces\UserInterface;
use App\Models\User;
use App\Traits\PermissionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Enum\ColorCode;
use Carbon\Carbon;

class DashboardController extends BaseController
{
    use PermissionHandler;

    public function __construct(
        protected UserInterface $user,
    )
    {
        $this->setService($this->user);
    }

    public function index()
    {
        $yearMonths = $this->desludge->yearMonth();
        $years = array_map(function($item){
            return [
                'value' => $item,
                'label' => $item
            ];
        }, explode(',', $yearMonths->year));

        $months = array_map(function($item){
            return [
                'value' => (int) \Carbon\Carbon::parse($item)->format('m'),
                'label' => $item
            ];
        }, explode(',', $yearMonths->month));

        $result    = $this->user->show(Auth::id());
        if($result->role_id == 1):
            $campData = $this->camp->lists();
            $campData = mapArray($campData, true, true, ['camp', 'block']);
            $camps = $campData['camp'] ?? [];
            $blocks = $campData['block'] ?? [];
            $agencyData = $this->agency->lists();
            $agencyData = mapArray($agencyData, true, true, ['agency', 'team']);
            $agencies = $agencyData['agency'] ?? [];
            $teams = $agencyData['team'] ?? [];
        else:
            $agencies = mapAgencies($result->agency);
            $teams = mapTeams($result->team);
            $camps = mapCamps($result->camp, true);
            $blocks = mapBlocks($result->block, true);
        endif;

        $users      = $this->user->total();
        $latrines   = $this->latrine->total();
        $zones      = $this->zone->lists();
        $zones      = setMapping($zones, 'id', 'name');

        return Inertia::render(
            'Dashboard/Index',
            [
                'camps' => [],
                'total-camps' => count($camps),
                'blocks' => $blocks,
                'total-blocks' => count($blocks),
                'sanitationZones' => 10,
                'agencies' => $agencies,
                'total-agencies' => count($agencies),
                'teams' => $teams,
                'total-teams' => count($teams),
                'total-users' => $users,
                'total-latrines' => $latrines,
                'sanitation-zones' => $zones,
                'total-sanitation-zones' => count($zones),
                'months' => $months,
                'years' => $years,
            ]
        );
    }

    public function show(User $user)
    {
        dd($user->toArray());
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return to_route('datatable.demo');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return to_route('datatable.demo');
    }

    public function getMenus(Request $request)
    {
        $roles = auth()->user()->roles()->get()->map(function ($item) {
            return $item->id;
        })->toArray();

        return $this->getPermissionLists($roles);
    }

    public function totalVolumeDesludged()
    {
        return $this->dashboard->desludgedVolume(request()->all());
    }

    public function latrineDesludgeSchedule()
    {
        return $this->dashboard->latrineDesludgeQuery(request()->all());
    }

    public function typeofLatrine()
    {
        return $this->dashboard->typeofLatrine(request()->all());
    }
    public function totalDesludgedTypeofLatrine()
    {
        return $this->dashboard->desludgedTypeofLatrine(request()->all());
    }

    public function totalHoursUsed()
    {
        return $this->dashboard->totalHoursUsed(request()->all());
    }

    public function seeForeignMaterials()
    {
        return $this->dashboard->seeForeignMaterials(request()->all());
    }

    public function totalLitterFuelUsed()
    {
        return $this->dashboard->totalLitterFuelUsed(request()->all());
    }

    public function mostReqDesludgeSanitationZone()
    {
        $param = request()->all();
        $query = $this->zone->query();

        $sanitationZone = $query
            ->when(!is_null(data_get($param, 'camp')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.camp_id', json_decode(data_get($param, 'camp')));
            })
            ->when(!is_null(data_get($param, 'block')), function($query) use($param) {
                $query->whereIn('latrine_with_desludges_reports.block_id', json_decode(data_get($param, 'block')));
            })
            ->when(!is_null(data_get($param, 'sanitationZones')), function($query) use($param) {
                $query->whereIn('sanitation_zones.id', json_decode(data_get($param, 'sanitationZones')));
            })
            ->when(!is_null(data_get($param, 'year')), function($query) use($param) {
                $query->whereIn(DB::raw('YEAR(latrine_with_desludges_reports.next_desludge_date)'), json_decode(data_get($param, 'year')));
            })
            ->when(!is_null(data_get($param, 'month')), function($query) use($param) {
                $query->whereIn(DB::raw('MONTH(latrine_with_desludges_reports.next_desludge_date)'), json_decode(data_get($param, 'month')));
            })
            ->when(!is_null(data_get($param, 'fromDate')) && is_null(data_get($param, 'toDate'))
                && is_null(data_get($param, 'year')) && is_null(data_get($param, 'month')), function($query) use($param){
                $query->whereDate(DB::raw('DATE(latrine_with_desludges_reports.next_desludge_date)'), '>', data_get($param, 'fromDate'));
            })
            ->when(!is_null(data_get($param, 'fromDate')) && !is_null(data_get($param, 'toDate'))
                && is_null(data_get($param, 'year')) && is_null(data_get($param, 'month')), function($query) use($param){
                $query->whereBetween(DB::raw('DATE(latrine_with_desludges_reports.next_desludge_date)'),
                    [data_get($param, 'fromDate'), data_get($param, 'toDate')]);
            })
            ->when(is_null(data_get($param, 'fromDate')) && is_null(data_get($param, 'toDate'))
                && is_null(data_get($param, 'year')) && is_null(data_get($param, 'month')), function($query){
                $query->whereBetween(DB::raw('DATE(latrine_with_desludges_reports.next_desludge_date)'),
                    [Carbon::now()->subDays(5)->format('Y-m-d'), Carbon::now()->format('Y-m-d')]);
            })
            ->get();

        $sanitationZone->transform(function($item){
            $danger = number_format(($item->danger / $item->total_latrine) * 100, 0);
            $warning = number_format(($item->warning / $item->total_latrine) * 100, 0);
            $color = $danger >= 50 ? ColorCode::$RedBg : ($warning < 50 && $warning >=30 ? ColorCode::$OrangeBg : ColorCode::$GreenBg);

            return [
                'id' => $item->id,
                'name' => $item->name,
                'camp_name' => $item->name,
                'block_name' => $item->block_name,
                'total_latrine' => $item->total_latrine,
                'danger' => number_format(($item->danger / $item->total_latrine) * 100, 0),
                'warning' => number_format(($item->warning / $item->total_latrine) * 100, 0),
                'color' => $color
            ];
        });

        return $sanitationZone;
    }

    public function map()
    {
        $now = \Carbon\Carbon::now();

        $zones = $this->zone->lists()
            ->transform(function($item){
                $danger = number_format(($item->danger / $item->total_latrine) * 100, 0);
                $warning = number_format(($item->warning / $item->total_latrine) * 100, 0);

                // $color = $danger >= 50 ? "RED" : ($warning < 50 && $warning >=30 ? "Yellow" : "GREEN");
                $color = $danger >= 50 ? ColorCode::$RedBg : ($warning < 50 && $warning >=30 ? ColorCode::$OrangeBg : ColorCode::$GreenBg);

                // if($item->name == "Z09003"):
                // dd($danger >= 50, $danger, ($warning < 50 && $warning >=30), $warning);
                // endif;

                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'danger' => $danger,
                    'warning' => $warning,
                    'color' => $color,
                ];
            });

        $latrineData = [
            "type" => "FeatureCollection",
            "name" => "Latrine Json",
            "crs" => [
                "type" => "latrines",
                "properties" => [
                    "name" => "urn:ogc:def:crs:OGC:1.3:CRS84"
                ]
            ],
            "features" => $this->latrine->lists()
                ->transform(function($item) use($now) {
                    $color = ColorCode::$GreenIcon;

                    if($item->next_desludge_date):
                        $daysLeft = \Carbon\Carbon::parse($item->next_desludge_date)->diffInDays($now);
                        $item->daysLeft = $daysLeft;


                        if($item->days_left <= 3):
                            $color = ColorCode::$RedIcon;
                        elseif($item->days_left > 3 && $daysLeft <= 6):
                            $color = ColorCode::$OrangeIcon;
                        endif;
                    endif;

                    return [
                        "type" => "Feature",
                        "properties" => [
                            'uid_no' => $item->uid_no,
                            'last_desludge_date' => $item->last_desludge_date,
                            'last_volume_desludged' => $item->last_volume_desludged,
                            'next_desludge_date' => $item->next_desludge_date,
                            'colorCode' => $color,
                        ],
                        "geometry" =>  [
                            "type" => "Point",
                            "coordinates" => [
                                $item->longitude,
                                $item->latitude
                            ]
                        ]
                    ];
                })
        ];

        return Inertia::render('Dashboard/Map', [
            'zones' => $zones,
            'latrines' => $latrineData
        ]);
    }
}
