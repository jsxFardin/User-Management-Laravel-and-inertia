<?php

namespace App\Http\Controllers;

use App\Http\Requests\CsvDataRequest;
use App\Models\Donor;
use App\Models\Encampment\Block;
use App\Models\Encampment\Camp;
use App\Models\Latrine\Latrine;
use App\Models\Latrine\Setup\Facility;
use App\Models\Latrine\Setup\FacilityUsed;
use App\Models\Latrine\Setup\Pit;
use App\Models\Latrine\Setup\SanitationZone;
use App\Models\Latrine\Setup\Status\Construction;
use App\Models\Latrine\Setup\Structure;
use App\Models\Latrine\Setup\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\SimpleExcel\SimpleExcelReader;

class CsvDataController extends Controller
{
    public function index(Request $request)
    {
        return view('data-import.index');
    }

    public function store(Request $request)
    {
        $file = request()->file('file');

        if($request->has('file')):
            if (!$file->isValid()) {
                $error = $file->getErrorMessage();
                dd($error);
            }

            $rows = SimpleExcelReader::create($request->file, 'xlsx')
                // ->noHeaderRow()
                ->getRows();

            if($request->category == "camp-block"):
                $this->handelCampBlock($rows);
            endif;

            if($request->category == "latrine"):
                $this->handelLatrines($rows);
            endif;

            if($request->category == "latrine_zones"):
                $this->handelLatrineZones($rows);
            endif;

            $this->handelSetupData($rows, $request->category);
        endif;

        return redirect()->route('import.index');
    }

    private function handelSetupData($datas, $category)
    {
        $array = [];
        foreach($datas->toArray() as $data):
            $array[$data['Value']] = ['name' => $data['Value']];
        endforeach;

        $array = array_values($array);

        // dd($category, $array);
        if($category == "construction_status"):
            Construction::insert($array);
        elseif($category == "donors"):
            Donor::insert($array);
        elseif($category == "facility_types"):
            Facility::insert($array);
        elseif($category == "facility_useds"):
            FacilityUsed::insert($array);
        elseif($category == "latrine_structures"):
            Structure::insert($array);
        elseif($category == "pit_types"):
            Pit::insert($array);
        elseif($category == "sludge_transfers"):
            Transfer::insert($array);
        elseif($category == "sanitation_zones"):
            SanitationZone::insert($array);
        endif;

        return true;
    }

    // private function handelLatrines($datas)
    // {
    //     $zones = DB::table('sanitation_zones')->select('id', 'name')->get();
    //     $zones = json_decode($zones, true);

    //     // dd($zones);
    //     $zones = $datas->map(function($item) use($zones) {
    //         return [
    //             'id' => $zones[array_search($item['SZ_ID'], array_column($zones, 'name'))]['id'],
    //             'UID2' => $item['UID2'],
    //             'SZ_ID' => $item['SZ_ID'],
    //         ];
    //     });
    //     $zones = json_decode($zones, true);

    //     $latrines = Latrine::all();

    //     foreach($latrines as $latrine):
    //         if(in_array($latrine->uid_no, array_column($zones, 'UID2'))):
    //             if(!is_null(data_get($zones[array_search($latrine->uid_no, array_column($zones, 'UID2'))], 'id'))):
    //                 $latrine->sanitation_zone_id = $zones[array_search($latrine->uid_no, array_column($zones, 'UID2'))]['id'];
    //                 $latrine->update();
    //             endif;
    //         endif;
    //     endforeach;

    //     return true;
    // }

    private function handelLatrines($datas){
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('latrines')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $blocks = DB::table('blocks')->get();
        $blocks = json_decode($blocks, true);

        $donors = DB::table('donors')->get();
        $donors = json_decode($donors, true);

        $constructionStatus = DB::table('construction_status')->get();
        $constructionStatus = json_decode($constructionStatus, true);

        $facilityTypes = DB::table('facility_types')->get();
        $facilityTypes = json_decode($facilityTypes, true);

        $facilityUseds = DB::table('facility_useds')->get();
        $facilityUseds = json_decode($facilityUseds, true);

        $latrineStructures = DB::table('latrine_structures')->get();
        $latrineStructures = json_decode($latrineStructures, true);

        $pitTypes = DB::table('pit_types')->get();
        $pitTypes = json_decode($pitTypes, true);

        // dd($donors, $constructionStatus, $facilityTypes, $facilityUseds, $latrineStructures, $pitTypes, $camps, $blocks);
        $arr = [];
        $results = $datas->toArray();
        // dump($results[0]);

        foreach($results as $data):
            $campBlockSub = $blocks[array_search($data['SBlockName'], array_column($blocks, 'short_name'))];

            $arr[$data['OBJECTID']] = [
                'uid_no' => $data['UID2'],
                'camp_id' => $campBlockSub['camp_id'],
                'block_id' => is_null($campBlockSub['parent_id']) ? $campBlockSub['id'] : $campBlockSub['parent_id'],
                'sub_block_id' => !is_null($campBlockSub['parent_id']) ? $campBlockSub['id'] : null,
                'facility_type_id' => $facilityTypes[array_search($data['FacilityType'], array_column($facilityTypes, 'name'))]['id'],
                'facility_used_id' => $facilityUseds[array_search($data['FacilityUsed'], array_column($facilityUseds, 'name'))]['id'],
                'construction_status_id' => $constructionStatus[array_search($data['ConstructionStatus'], array_column($constructionStatus, 'name'))]['id'],
                'latrine_structure_id' => $latrineStructures[array_search($data['Structure'], array_column($latrineStructures, 'name'))]['id'],
                'pit_type_id' => $pitTypes[array_search($data['TypePit'], array_column($pitTypes, 'name'))]['id'],
                'pwsn' => $data['Pwsn'],
                'constructor_id' => null,
                'chamber_door' => $data['ChamberDoor'],
                'male_number_stickers' =>$data['MaleNumberStickers'],
                'male_number_user' => $data['MaleNumberUser'],
                'female_number_stickers' => $data['FemaleNumberStickers'],
                'female_number_user' => $data['femaleNumberUser'],
                'children_number' => $data['ChildrenNumber'],
                'common_shared' => $data['CommonShared'],
                'functional' => $data['Functional'],
                'non_functional' => $data['NonFunctional'],
                'min_or_repair' => $data['MinorRepair'],
                'pwsn_hand_rail_outside' => $data['PWSNHandRailOutside'] == "Yes" ? 1 : 0,
                'pwsn_hand_rail_inside' => $data['PWSNHandRailInside'] == "Yes" ? 1 : 0,
                'pwsn_ramp' => $data['PWSNRamp'] == "Yes" ? 1 : 0,
                'pwsn_stair' => $data['PWSNStair'] == "Yes" ? 1 : 0,
                'pwsn_high_commode' => $data['PWSHighCommode'] == "Yes" ? 1 : 0,
                'hwd' => $data['Hwd'] == "Yes" ? 1 : 0,
                'hwd_water' => $data['HwdWater'] == "Yes" ? 1 : 0,
                'hwd_soap' => $data['HwdSoap'] == "Yes" ? 1 : 0,
                'longitude' => $data['Longitude'],
                'latitude' => $data['Latitude'],
                'total_chamber' => null,
                'total_ring_number' => null,
                'dia_of_ring' => null,
                'septic_tank_dimension' => null,
                'total_volume' => null,
                'remarks' => $data["NonFunctional"] == 1 ? $data["ReasonNonFunctional"] : $data['Note'],
            ];
        endforeach;

        $arr = collect(array_values($arr));

        foreach ($arr->chunk(500) as $chunk)
        {
            // dump($chunk);
            DB::table('latrines')->insert($chunk->toArray());
        }
        // return Latrine::insert(array_values($arr));
        return true;
    }

    private function handelLatrineZones($datas)
    {
        $zones = DB::table('sanitation_zones')->select('id', 'name')->get();
        $zones = json_decode($zones, true);

        // dd($zones);
        $zones = $datas->map(function($item) use($zones) {
            return [
                'id' => $zones[array_search($item['SZ_ID'], array_column($zones, 'name'))]['id'],
                'UID2' => $item['UID2'],
                'SZ_ID' => $item['SZ_ID'],
            ];
        });
        $zones = json_decode($zones, true);

        $latrines = Latrine::all();

        foreach($latrines as $latrine):
            if(in_array($latrine->uid_no, array_column($zones, 'UID2'))):
                if(!is_null(data_get($zones[array_search($latrine->uid_no, array_column($zones, 'UID2'))], 'id'))):
                    $latrine->sanitation_zone_id = $zones[array_search($latrine->uid_no, array_column($zones, 'UID2'))]['id'];
                    $latrine->update();
                endif;
            endif;
        endforeach;

        return true;
    }

    private function handelCampBlock($datas){
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('blocks')->truncate();
        DB::table('camps')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $camp = [];
        $block = [];
        $sblock = [];

        foreach($datas as $data):
            $camp[$data['CampName']] = [
                'name' => $data['CampName'],
                'sname' => $data['BlockName'] ?: $data['SBlockName']
            ];
            if($data['BlockName'] != ""):
                $block[$data['BlockName']] = [
                    'name' => $data['BlockName'],
                    'parent' => $data['CampName']
                ];

                if($data['BlockName'] != $data['SBlockName']):
                    $sblock[$data['SBlockName']] = [
                        'name' => $data['SBlockName'],
                        'parent' => $data['BlockName']
                    ];
                endif;
            else:
                $block[$data['SBlockName']] = [
                    'name' => $data['SBlockName'],
                    'parent' => $data['CampName']
                ];
            endif;
        endforeach;

        $camp = array_values($camp);
        $block = array_values($block);
        $sblock = array_values($sblock);

        // dd(count($block), count(array_unique($block, SORT_REGULAR)), count($sblock), count(array_unique($sblock, SORT_REGULAR)));

        foreach($camp as $c):
            $cData = Camp::create([
                'short_name' => data_get(explode('_', $c['sname']), '0'),
                'name' => $c['name']
            ]);

            $campBlocks = array_values(array_filter($block, function($item) use($c) {
                return $item['parent'] == $c['name'];
            }));

            foreach($campBlocks as $cb):
                $bData = Block::create([
                    'camp_id' => $cData->id,
                    'short_name' => $cb['name'],
                    'name' => data_get(explode('_', $cb['name']), '1') ?: $cb['name']
                ]);

                $blockSubs = array_map(function($item) use($bData){
                    return [
                        'camp_id' =>$bData->camp_id,
                        'parent_id' =>$bData->id,
                        'short_name' => $item['name'],
                        'name' => str_replace($bData->short_name, "",$item['name'])
                    ];
                }, array_values(array_filter($sblock, function($item) use($cb) {
                    return $item['parent'] == $cb['name'];
                })));

                Block::insert($blockSubs);
            endforeach;
        endforeach;

        return true;
    }
}
