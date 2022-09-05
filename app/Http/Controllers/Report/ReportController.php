<?php

namespace App\Http\Controllers\Report;

use App\Enum\ColorCode;
use App\Http\Controllers\BaseController;
use App\Interfaces\CampInterface;
use App\Interfaces\DesludgeInterface;
use App\Interfaces\LatrineInterface;
use App\Interfaces\SanitizationZoneInterface;
use App\Interfaces\UserInterface;
use App\Models\Latrine\Desludge;
use App\Models\Latrine\Latrine;
use App\Traits\PermissionHandler;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ReportController extends BaseController
{
    use PermissionHandler;

    public function __construct(
        protected LatrineInterface $latrine,
        protected CampInterface $camp,
        protected DesludgeInterface $desludge,
        protected SanitizationZoneInterface $zone,
        protected UserInterface $user
    )
    {

        $this->setService($this->latrine);
        $this->setService($this->camp);
        $this->setService($this->desludge);
        $this->setService($this->zone);
    }

    public function latrineReport()
    {
        $this->authorize('latrine-report', Latrine::class);

        $campData = $this->camp->lists();
        $campData = mapArray($campData, true, true, ['block', 'camp']);

        $latrineData = $this->latrine->lists(true, request()->all(), true);

        $latrineData->transform(function($item){
            $item->last_date = !is_null($item->last_desludge_date) ? Carbon::parse($item->last_desludge_date)->format('F j, Y') : null;
            $item->next_date = !is_null($item->next_desludge_date) ? Carbon::parse($item->next_desludge_date)->format('F j, Y') : null;
            return $item;
        });

        $getLatrineData = getLatrineSetUpData();

        return Inertia::render('Report/Latrine/index', [
            'lists'         => $latrineData,
            'access'        => $this->accessLists(Latrine::class, 'report'),
            'facilityTypes' => $getLatrineData['facility_type'] ?? [],
            'facilityUseds' => $getLatrineData['facility_useds'] ?? [],
            'constStatus'   => $getLatrineData['construction_status'] ?? [],
            'latStructure'  => $getLatrineData['latrine_structures'] ?? [],
            'camps'         => $campData['camp'] ?? [],
            'blocks'        => $campData['block'] ?? [],
            'sanitationZones' => $getLatrineData['sanitation_zones'] ?? [],
        ]);
    }

    public function downloadLatrineReport()
    {
        $this->authorize('latrine-report', Latrine::class);

        $rows = [];

        $this->latrine->query()
        ->orderBy('id', 'desc')
        ->chunk(2000, function ($result) use (&$rows) {
            foreach ($result as $item) {
                $item->last_date = !is_null($item->last_desludge_date) ? Carbon::parse($item->last_desludge_date)->format('F j, Y') : null;
                $item->next_date = !is_null($item->next_desludge_date) ? Carbon::parse($item->next_desludge_date)->format('F j, Y') : null;
                $rows[] = (array) $item;
            }
        });

        SimpleExcelWriter::streamDownload('Latrine.csv')
            ->addRows($rows)
            ->toBrowser();
    }

    public function desludgeReport()
    {
        $this->authorize('desludge-report', Desludge::class);

        // FILTERS
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
            $campData   = $this->camp->lists();
            $campData   = mapArray($campData, true, true, ['camp', 'block']);
            $camps      = $campData['camp'] ?? [];
            $blocks     = $campData['block'] ?? [];
        else:
            $camps = mapCamps($result->camp, true);
            $blocks = mapBlocks($result->block, true);
        endif;
        $zones      = $this->zone->lists();
        $zones      = setMapping($zones, 'id', 'name');

        // LISTS
        $desludge = $this->desludge->lists(true, request()->all(), true);

        $desludge->getCollection()->transform(function($item, $key){
            $item->date = !is_null($item->collection_date) ? Carbon::parse($item->collection_date)->format('F j, Y') : null;
            $item->time = !is_null($item->collection_date) ? Carbon::parse($item->collection_date)->format('g:i a') : null;
            return $item;
        });

        return Inertia::render('Report/Desludge/Index', [
            'lists'         => $desludge,
            'camps'         => $camps,
            'blocks'        => $blocks,
            'months'        => $months,
            'years'         => $years,
            'sanitation-zones' => $zones,
        ]);
    }

    public function downloadDesludgeReport()
    {
        $this->authorize('desludge-report', Desludge::class);

        $rows = [];

        $this->desludge->query()
        ->orderBy('id', 'desc')
        ->chunk(2000, function ($result) use (&$rows) {
            foreach ($result as $item) {
                $item->date = !is_null($item->collection_date) ? Carbon::parse($item->collection_date)->format('F j, Y') : null;
                $item->time = !is_null($item->collection_date) ? Carbon::parse($item->collection_date)->format('g:i a') : null;
                $rows[] = (array) $item->toArray();
            }
        });

        SimpleExcelWriter::streamDownload('Desludge.csv')
            ->addRows($rows)
            ->toBrowser();
    }

    public function sanitationZoneReport()
    {
        $this->authorize('sanitation-zone-report', SanitationZone::class);

        // FILTERS
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
            $campData   = $this->camp->lists();
            $campData   = mapArray($campData, true, true, ['camp', 'block']);
            $camps      = $campData['camp'] ?? [];
            $blocks     = $campData['block'] ?? [];
        else:
            $camps = mapCamps($result->camp, true);
            $blocks = mapBlocks($result->block, true);
        endif;
        $zones      = $this->zone->lists();
        $zones      = setMapping($zones, 'id', 'name');

        // LISTS
        $sanitationZone = $this->zone->lists(true, request()->all(), true);

        $sanitationZone->transform(function($item){
            $danger  = number_format(($item->danger / $item->total_latrine) * 100, 0);
            $warning = number_format(($item->warning / $item->total_latrine) * 100, 0);
            $color   = $danger >= 50 ? ColorCode::$RedIcon : ($warning < 50 && $warning >=30 ? ColorCode::$OrangeIcon : ColorCode::$GreenBg);
            $last_desludge_date = is_null($item->last_desludge_date) ? null : Carbon::parse($item->last_desludge_date)->format('F j, Y');
            $next_desludge_date = is_null($item->next_desludge_date) ? null : Carbon::parse($item->next_desludge_date)->format('F j, Y');

            return [
                'name'      => $color != '2ecc71' ? '<span style="color: #'.$color.'">'.$item->name.'</span>' : $item->name,
                'danger'    => $color != '2ecc71' ? '<span style="color: #'.$color.'">'
                    .number_format(($item->danger / $item->total_latrine) * 100, 0).'%</span>' :
                        number_format(($item->danger / $item->total_latrine) * 100, 0).'%',
                'warning'   => $color != '2ecc71' ? '<span style="color: #'.$color.'">'
                    .number_format(($item->warning / $item->total_latrine) * 100, 0).'%</span>' :
                        number_format(($item->warning / $item->total_latrine) * 100, 0).'%',
                'camp_name' => $color != '2ecc71' ? '<span style="color: #'.$color.'">'.$item->camp_name.'</span>' : $item->camp_name,
                'block_name'  => $color != '2ecc71' ? '<span style="color: #'.$color.'">'.$item->block_name.'</span>' : $item->block_name,
                'total_latrine'     => $color != '2ecc71' ? '<span style="color: #'.$color.'">'.$item->total_latrine.'</span>' : $item->total_latrine,
                'last_desludge_date'=> $color != '2ecc71' ? '<span style="color: #'.$color.'">'
                    .$last_desludge_date.'</span>' : $last_desludge_date,
                'next_desludge_date'=> $color != '2ecc71' ? '<span style="color: #'.$color.'">'
                    .$next_desludge_date.'</span>' : $next_desludge_date,
                'last_volume_desludged'=> $color != '2ecc71' ? '<span style="color: #'.$color.'">'.$item->last_volume_desludged.'</span>' : $item->last_volume_desludged,
            ];
        });

        return Inertia::render('Report/SanitationZone/Index', [
            'lists'         => $sanitationZone,
            'camps'         => $camps,
            'blocks'        => $blocks,
            'months'        => $months,
            'years'         => $years,
            'sanitation-zones' => $zones,
        ]);
    }

    public function downloadSanitationZoneReport()
    {
        $this->authorize('sanitation-zone-report', SanitationZone::class);

        $rows = [];

        $this->zone->query()
        ->orderBy('id', 'desc')
        ->chunk(2000, function ($result) use (&$rows) {
            foreach ($result as $item) {
                $data = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'danger' => number_format(($item->danger / $item->total_latrine) * 100, 0),
                    'warning' => number_format(($item->warning / $item->total_latrine) * 100, 0),
                    'camp_name' => $item->camp_name,
                    'block_name' => $item->block_name,
                    'total_latrine' => $item->total_latrine,
                    'last_desludge_date' => Carbon::parse($item->last_desludge_date)->format('F j, Y'),
                    'next_desludge_date' => Carbon::parse($item->next_desludge_date)->format('F j, Y'),
                    'last_volume_desludged' => $item->last_volume_desludged,
                ];
                $rows[] = (array) $data;
            }
        });

        SimpleExcelWriter::streamDownload('SanitationZone.csv')
            ->addRows($rows)
            ->toBrowser();
    }

}
