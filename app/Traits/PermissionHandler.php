<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

trait PermissionHandler
{
    private $permissions = [];
    private $removeable = [];

    /**
     * Arrange the given permissions.
     *
     * @param  string  $model
     * @param  string  $group
     * @return array $access
     *
     */
    public function accessLists(string $model, string $group)
    {
        $accessData = [];

        if(auth()->user()->can('create-'.$group, $model)):
            array_push($accessData, 'create');
        endif;

        if(auth()->user()->can('show-'.$group, $model)):
            array_push($accessData, 'show');
        endif;

        if(auth()->user()->can('edit-'.$group, $model)):
            array_push($accessData, 'edit');
        endif;

        if(auth()->user()->can('status-'.$group, $model)):
            array_push($accessData, 'status');
        endif;

        if(auth()->user()->can('destroy-'.$group, $model)):
            array_push($accessData, 'destroy');
        endif;

        return $accessData;

    }

    /**
     * Arrange the given array.
     *
     * @param  array  $datas
     * @param  int  $role
     * @return array $this->permissions
     *
     */
    public function getPermissionLists(int | array $role = null)
    {
        $permissions = DB::table('permission_role')
            ->whereIn('role_id', gettype($role) == "array" ? $role : [$role])
            ->get()
            ->map(function($item){
                return $item->permission_id;
            })
            ->toArray();

        $this->permissions = Db::table('permission_groups AS pg')
            ->leftJoin('permissions AS p', 'p.permission_group_id', 'pg.id')
            ->leftJoin('permission_groups as pg2', 'pg2.parent_id', 'pg.id')
            ->orderBy('pg.id', 'ASC')
            ->orderBy('pg.sort', 'ASC')
            ->groupBy('pg.id')
            ->select('pg.*')
            ->selectRaw('(GROUP_CONCAT(
                DISTINCT CONCAT(p.id,"|",p.name,"|",p.label)
                ORDER BY p.id ASC
                SEPARATOR ","
            )) AS permissions')
            ->selectRaw('(GROUP_CONCAT(
                DISTINCT CONCAT(pg2.id)
                ORDER BY pg2.id ASC
                SEPARATOR "|"
              )) AS have_child')
            ->get()
            ->map(function($item) use($permissions) {
                $item->have_permission = auth()->user()->isAdmin() ?: false;

                if(!is_null($item->permissions)):
                    $indexs = ['id', 'name', 'label'];
                    $item->permissions = array_map(function($data) use($indexs, $permissions) {
                        $array = array_combine($indexs, explode('|', $data));
                        $array['have_permission'] = in_array($array['id'], $permissions);

                        return $array;
                    }, explode(',', $item->permissions));

                    $item->have_permission = (count(array_filter($item->permissions, function($data){
                        return $data['have_permission'];
                    })) != 0 || auth()->user()->isAdmin()) ?? false;
                endif;

                if(!is_null($item->have_child)):
                    $item->have_child = explode('|', $item->have_child);
                endif;

                return $item;
            });

        $this->permissions = json_decode($this->permissions,TRUE);

        $this->menuMergeLoop();
        $this->removeItems($this->permissions, $this->removeable);
        krsort($this->permissions);
        $this->permissions = array_values($this->permissions);
        // dd($this->permissions);

        return array_map(function($item){
            if(!is_null($item['have_child'])):
                array_multisort( array_column($item['child'], "sort"), SORT_ASC, $item['child'] );
                // dd($item);
                $item['have_permission'] = count(array_filter($item['child'], function($data){
                    return $data['have_permission'];
                })) != 0 ?? false;
            endif;

            return $item;
        }, array_values($this->permissions));
    }

    /**
     * Arrange the given array.
     *
     * @param  array  $datas
     * @param  int  $role
     * @return array $this->permissions
     *
     */
    public function getPermissionArray(array $datas = [], int $role)
    {
        // dd($datas, $role);
        foreach($datas as $d => $data):
            if(array_key_exists('child', $data)):
                $this->getPermissionArray($data['child'], $role);
            else:
                $this->separationLoop($data['permissions'], $role);
            endif;
        endforeach;

        return $this->permissions;
    }

    private function separationLoop(array $datas = [], int $role)
    {
        foreach($datas as $data):
            if($data['have_permission'] == true):
                array_push($this->permissions, [
                    'permission_id' => $data['id'],
                    'role_id' => $role
                ]);
            endif;
        endforeach;
    }

    private function menuMergeLoop()
    {
        arsort($this->permissions);

        $this->permissions = array_values($this->permissions);

        foreach($this->permissions as $key => $value):
            $child = !is_null($value['have_child']) ? $this->mergeChild($value['have_child']) : [];

            if(count($child) != 0):
                if(!array_key_exists('child', $this->permissions[$key])):
                    $this->permissions[$key]['child'] = $child;
                else:
                    array_merge($this->permissions[$key]['child'], $child);
                endif;

                $this->permissions[$key]['have_permission'] = in_array(true, array_column($this->permissions[$key]['child'], 'have_permission'));
            endif;
        endforeach;
    }

    private function mergeChild(array $child)
    {
        return array_values(array_filter($this->permissions, function($group) use($child){
            if(in_array($group['id'], $child)):
                array_push($this->removeable, $group['id']);
                return $group;
            endif;
        }));
    }

    private function removeItems(array $groups, array $removeable){
        $this->permissions = array_values(array_filter($groups, function($item) use($removeable) {
            return !in_array($item['id'], $removeable);
        }));
    }
}
