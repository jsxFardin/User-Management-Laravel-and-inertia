<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

function getLatrineSetUpData($multiselect = true)
{
    $facilityTypes      = DB::table('facility_types')->select('id', 'name', DB::raw('"facility_type" as category'))
        ->where('active', 1);
    $facilityUseds      = DB::table('facility_useds')->select('id', 'name', DB::raw('"facility_useds" as category'))
        ->where('active', 1);
    $constructionStatus = DB::table('construction_status')->select('id', 'name', DB::raw('"construction_status" as category'))
        ->where('active', 1);
    $latrineStructure   = DB::table('latrine_structures')->select('id', 'name', DB::raw('"latrine_structures" as category'))
        ->where('active', 1);
    $pits               = DB::table('pit_types')->select('id', 'name', DB::raw('"pit_types" as category'))
        ->where('active', 1);
    $donor              = DB::table('donors')->select('id', 'name', DB::raw('"donors" as category'))
        ->where('active', 1);
    $sludge_transfers   = DB::table('sludge_transfers')->select('id', 'name', DB::raw('"sludge_transfers" as category'))
        ->where('active', 1);
    $sanitation_zones   = DB::table('sanitation_zones')->select('id', 'name', DB::raw('"sanitation_zones" as category'))
        ->where('active', 1);

    $setData = $facilityTypes->union($facilityUseds)
        ->union($constructionStatus)
        ->union($latrineStructure)
        ->union($pits)
        ->union($donor)
        ->union($sludge_transfers)
        ->union($sanitation_zones)
        ->get();
    $setData = !$multiselect ? $setData : setMapping($setData, 'id', 'name', 'category');

    $array = [];
    foreach ($setData as $list) :
        $array[$list->category][] = !$multiselect ? collect($list)->only('id', 'name') : collect($list)->only('value', 'label');
    endforeach;

    return $array;
}

function setMapping($data, string $value, string $label, string $category = '')
{
    return collect($data)->map(function ($item) use ($value, $label, $category) {
        $getData = [
            'value' => data_get($item, $value),
            'label' => data_get($item, $label),
        ];

        $category != '' ? $getData[$category] = data_get($item, $category) : $getData;
        return (object)$getData;
    });
}

function mapUsers($userData, $multiselect = false)
{
    $data = [];
    if (!is_null($userData)) :
        if (gettype($userData) == 'string') :
            $data = array_map(function ($item) {
                $user = explode('|', $item);
                return [
                    'id'    => data_get($user, 0),
                    'name'  => data_get($user, 1),
                    'id_no' => data_get($user, 2),
                    'mobile' => data_get($user, 3),
                    'email' => data_get($user, 4),
                ];
            }, explode(',', $userData));
        else :
            $userData = gettype($userData) == 'object' ? $userData->toArray() : $userData;
            $data = array_map(function ($item) {
                return [
                    'id'    => (int) $item['id'],
                    'name'  => $item['name'],
                    'id_no' => $item['id_no'],
                    'mobile' => $item['mobile'],
                    'email' => $item['email'],
                ];
            }, $userData);
        endif;
        $data = !$multiselect ? $data : setMapping($data, 'id', 'name', 'id_no');
    endif;

    return $data;
}

function mapCamps($campData, $multiselect = false)
{
    $data = [];
    if (!is_null($campData)) :
        if (gettype($campData) == 'string') :
            $data = array_map(function ($item) {
                $item = explode('|', $item);
                return [
                    'id'        => (int) data_get($item, 0),
                    'name'      => data_get($item, 1),
                    'short_name' => data_get($item, 2),
                ];
            }, explode(',', $campData));
        else :
            $campData = gettype($campData) == 'object' ? $campData->toArray() : $campData;
            $data = array_map(function ($item) {
                return [
                    'id'        => (int) $item['id'],
                    'name'      => $item['name'],
                    'short_name' => $item['short_name'],
                ];
            }, $campData);
        endif;
        $data = !$multiselect ? $data : setMapping($data, 'id', 'name', 'short_name');
    endif;

    return $data;
}

function mapCampBlocks($campData, $blockData = null, $separate = true, $onlyIds = false)
{
    $camps = array_map(function ($item) use ($separate, $onlyIds) {
        $item = explode('|', $item);
        $data = [];
        if (!$onlyIds) :
            $data = [
                'id' => (int) data_get($item, 0),
                'name' => data_get($item, 1),
                'short_name' => data_get($item, 2),
            ];
            $separate ? $data : $data['blocks'] = [];
        else :
            $data = [
                'camp_id' => (int) data_get($item, 0)
            ];
            $separate ? $data : $data['block_id'] = [];
        endif;

        return $data;
    }, explode(',', $campData));

    if (!$separate && !is_null($blockData)) :
        foreach (explode(',', $blockData) as $block) :
            $block = explode('|', $block);
            if (!$onlyIds) :
                array_push($camps[array_search(data_get($block, 2), array_column($camps, 'id'))]['blocks'], [
                    'id' => (int) data_get($block, 0),
                    'camp_id' => (int) data_get($block, 2),
                    'short_name' => data_get($block, 1),
                    'name' => data_get($block, 1),
                ]);
            else :
                array_push(
                    $camps[array_search(data_get($block, 2), array_column($camps, 'camp_id'))]['block_id'],
                    (int) data_get($block, 0)
                );
            endif;
        endforeach;
    endif;

    $blocks = mapBlocks($blockData);
    return $separate ? compact('camps', 'blocks') : $camps;
}

function mapBlocks($blockData, $multiselect = false, $onlyIds = false)
{
    $data = [];
    if (!is_null($blockData)) :
        if (gettype($blockData) == 'string') :
            $data = array_map(function ($item) use ($onlyIds) {
                $item = explode('|', $item);
                if (!$onlyIds) :
                    return (object)[
                        'id'        => (int) data_get($item, 0),
                        'name'      => data_get($item, 3),
                        'short_name' => data_get($item, 1),
                        'camp_id'   => (int) data_get($item, 2),
                    ];
                else :
                    return (int) data_get($item, 0);
                endif;
            }, explode(',', $blockData));
        else :
            $blockData = gettype($blockData) == 'object' ? $blockData->toArray() : $blockData;
            $data = array_map(function ($item) use ($onlyIds) {
                if (!$onlyIds) :
                    return [
                        'id'        => (int) $item['id'],
                        'name'      => $item['name'],
                        'short_name' => $item['short_name'],
                        'camp_id'   => $item['camp_id'],
                    ];
                else :
                    return (int) $item['id'];
                endif;
            }, $blockData);
        endif;
        $data = !$multiselect ? $data : setMapping($data, 'id', 'short_name', 'camp_id');
    endif;

    return $data;
}

function mapTeams($teamData, $multiselect = false)
{
    $data = [];
    if (!is_null($teamData)) :
        if (gettype($teamData) == 'string') :
            $data = array_map(function ($item) {
                $item = explode('|', $item);
                return [
                    'id'                => (int) data_get($item, 0),
                    'team_name'         => data_get($item, 1),
                    'contact_person'    => data_get($item, 2),
                    'mobile'            => data_get($item, 3),
                    'email'             => data_get($item, 4),
                    'agency_id'         => (int) data_get($item, 5),
                ];
            }, explode(',', $teamData));
        else :
            $teamData = gettype($teamData) == 'object' ? $teamData->toArray() : $teamData;
            $data = array_map(function ($item) {
                return [
                    'id'                => (int) $item['id'],
                    'team_name'         => $item['team_name'],
                    'contact_person'    => $item['contact_person'],
                    'mobile'            => $item['mobile'],
                    'email'             => $item['email'],
                    'agency_id'         => (int) $item['agency_id'],
                ];
            }, $teamData);
        endif;
        $data = !$multiselect ? $data : setMapping($data, 'id', 'team_name', 'agency_id');
    endif;

    return $data;
}

function mapAgencies($agencyData, $multiselect = false)
{
    $data = [];
    if (!is_null($agencyData)) :
        if (gettype($agencyData) == 'string') :
            $data = array_map(function ($item) {
                $item = explode('|', $item);
                return [
                    'id'            => (int) data_get($item, 0),
                    'agency_name'   => data_get($item, 1),
                    'email'         => data_get($item, 4),
                    'mobile'        => data_get($item, 3),
                    'contact_person' => data_get($item, 2),
                ];
            }, explode(',', $agencyData));
        else :
            $agencyData = gettype($agencyData) == 'object' ? $agencyData->toArray() : $agencyData;
            $data = array_map(function ($item) {
                return [
                    'id'            => (int) $item['id'],
                    'agency_name'   => $item['agency_name'],
                    'email'         => $item['email'],
                    'mobile'        => $item['mobile'],
                    'contact_person' => $item['contact_person'],
                ];
            }, $agencyData);
        endif;
        $data = !$multiselect ? $data : setMapping($data, 'id', 'agency_name');
    endif;

    return $data;
}

function mapRoles($roleData, $multiselect = false)
{
    $data = [];
    if (!is_null($roleData)) :
        if (gettype($roleData) == 'string') :
            $data = array_map(function ($item) {
                $item = explode('|', $item);
                return [
                    'id'   => (int) data_get($item, 0),
                    'name' => data_get($item, 1),
                ];
            }, explode(',', $roleData));
        else :
            $roleData = gettype($roleData) == 'object' ? $roleData->toArray() : $roleData;
            $data = array_map(function ($item) {
                return [
                    'id'   => (int) $item['id'],
                    'name' => $item['name'],
                ];
            }, $roleData);
        endif;
        $data = !$multiselect ? $data : setMapping($data, 'id', 'name');
    endif;

    return $data;
}

function mapArray($object, $multiselect = false, $chunk = false, $chunkData = [])
{
    $object = gettype($object) == 'object' ? $object->toArray() : $object;
    if (count($object) != 0) :
        if (!$chunk) :
            foreach ($object as $key => $item) :
                if (Arr::has($item, 'block')) :
                    $object[$key]['block'] = mapBlocks($item['block'], $multiselect);
                endif;
                if (Arr::has($item, 'agency')) :
                    $object[$key]['agency'] = mapAgencies($item['agency'], $multiselect);
                endif;
                if (Arr::has($item, 'team')) :
                    $object[$key]['team'] = mapTeams($item['team'], $multiselect);
                endif;
                if (Arr::has($item, 'user')) :
                    $object[$key]['user'] = mapUsers($item['user'], $multiselect);
                endif;
                if (Arr::has($item, 'camp')) :
                    $object[$key]['camp'] = mapCamps($item['camp'], $multiselect);
                endif;
                if (Arr::has($item, 'role')) :
                    $object[$key]['role'] = mapRoles($item['role'], $multiselect);
                endif;
            endforeach;

            return collect($object);
        else :
            // DECLARE VARIABLE
            $data = [];
            if (array_key_exists('block', data_get($object, 0)) && in_array('block', $chunkData)) :
                $data['block'] = [];
            endif;
            if (array_key_exists('agency', data_get($object, 0)) && in_array('agency', $chunkData)) :
                $data['agency'] = [];
            endif;
            if (array_key_exists('team', data_get($object, 0)) && in_array('team', $chunkData)) :
                $data['team'] = [];
            endif;
            if (array_key_exists('user', data_get($object, 0)) && in_array('user', $chunkData)) :
                $data['user'] = [];
            endif;
            if (array_key_exists('camp', data_get($object, 0)) && in_array('camp', $chunkData)) :
                $data['camp'] = [];
            endif;
            if (array_key_exists('role', data_get($object, 0)) && in_array('role', $chunkData)) :
                $data['role'] = [];
            endif;

            foreach ($object as $key => $item) :
                if (Arr::has($item, 'block') && in_array('block', $chunkData)) :
                    $blocks = mapBlocks($item['block'], $multiselect);
                    if (!empty($blocks)) :
                        foreach ($blocks as $block) :
                            if (!array_key_exists('block', $data)) :
                                $data['block'][] = $block;
                            else :
                                array_push($data['block'], $block);
                            endif;
                        endforeach;
                    endif;
                endif;

                if (Arr::has($item, 'agency') && in_array('agency', $chunkData)) :
                    $agencies = mapAgencies($item['agency'], $multiselect);
                    if (!empty($agencies)) :
                        foreach ($agencies as $key => $agency) :
                            if (!array_key_exists('agency', $data)) :
                                $data['agency'][] = $agency;
                            else :
                                array_push($data['agency'], $agency);
                            endif;
                        endforeach;
                    endif;
                endif;

                if (Arr::has($item, 'team') && in_array('team', $chunkData)) :
                    $teams = mapTeams($item['team'], $multiselect);
                    if (!empty($teams)) :
                        foreach ($teams as $team) :
                            if (!array_key_exists('team', $data)) :
                                $data['team'][] = $team;
                            else :
                                array_push($data['team'], $team);
                            endif;
                        endforeach;
                    endif;
                endif;

                if (Arr::has($item, 'user') && in_array('user', $chunkData)) :
                    $users = mapUsers($item['user'], $multiselect);
                    if (!empty($users)) :
                        foreach ($users as $user) :
                            if (!array_key_exists('user', $data)) :
                                $data['user'][] = $user;
                            else :
                                array_push($data['user'], $user);
                            endif;
                        endforeach;
                    endif;
                endif;

                if (Arr::has($item, 'camp') && in_array('camp', $chunkData)) :
                    $camps = mapCamps($item['camp'], $multiselect);
                    if (!empty($camps)) :
                        foreach ($camps as $camp) :
                            if (!array_key_exists('camp', $data)) :
                                $data['camp'][] = $camp;
                            else :
                                array_push($data['camp'], $camp);
                            endif;
                        endforeach;
                    endif;
                endif;

                if (Arr::has($item, 'role') && in_array('role', $chunkData)) :
                    $roles = mapRoles($item['role'], $multiselect);
                    if (!empty($roles)) :
                        foreach ($roles as $role) :
                            if (!array_key_exists('role', $data)) :
                                $data['role'][] = $role;
                            else :
                                array_push($data['role'], $role);
                            endif;
                        endforeach;
                    endif;
                endif;
            endforeach;

            // IF NOT EXIST
            $arrayMap = array_values(array_filter($chunkData, function ($item) use ($data) {
                return !array_key_exists($item, $data);
            }));

            if (count($arrayMap) > 0) :
                $data[$arrayMap[0]] = [];
                switch (!empty($arrayMap)):
                    case $arrayMap[0] == "camp":
                        $data[$arrayMap[0]] = mapCamps($object,  $multiselect);
                        break;
                    case $arrayMap[0] == "team":
                        $data[$arrayMap[0]] = mapTeams($object,  $multiselect);
                        break;
                    case $arrayMap[0] == "block":
                        $data[$arrayMap[0]] = mapBlocks($object,  $multiselect);
                        break;
                    case $arrayMap[0] == "user":
                        $data[$arrayMap[0]] = mapUsers($object,  $multiselect);
                        break;
                    case $arrayMap[0] == "agency":
                        $data[$arrayMap[0]] = mapAgencies($object,  $multiselect);
                        break;
                    case $arrayMap[0] == "role":
                        $data[$arrayMap[0]] = setMapping($object,  'role_id', 'role_name');
                        break;
                endswitch;
            endif;

            // FOR ARRAY UNIQUE
            foreach ($data as $key => $value) :
                $data[$key] = gettype($data[$key]) == 'object' ? $data[$key]->toArray() : $data[$key];
                $data[$key] = array_values(array_unique($data[$key], SORT_REGULAR));
            endforeach;

            return collect($data);
        endif;
    endif;
}

function rand_color()
{
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}
