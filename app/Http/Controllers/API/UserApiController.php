<?php

namespace App\Http\Controllers\API;

use App\Enum\ColorCode;
use App\Http\Controllers\BaseController;
use App\Interfaces\LatrineInterface;
use App\Interfaces\SanitizationZoneInterface;
use App\Interfaces\UserInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserApiController extends BaseController
{
    protected $user;
    protected $latrine;
    protected $zone;

    public function __construct(UserInterface $user, LatrineInterface $latrine, SanitizationZoneInterface $zone)
    {
        $this->user = $user;
        $this->latrine = $latrine;
        $this->zone = $zone;

        $this->setService($this->user);
        $this->setService($this->latrine);
        $this->setService($this->zone);
    }

    public function getUserInfo(Request $request)
    {
        $now = \Carbon\Carbon::now();
        $userId = Auth::id();
        $result = $this->user->show($userId);
        $output = [
            'agencies' => array_map(function($item){
                    return [
                        'id' => $item['id'],
                        'name' => $item['agency_name']
                    ];
                }, mapAgencies($result->agency, false)),
            'teams' => array_map(function($item){
                    return [
                        'id' => $item['id'],
                        'name' => $item['team_name']
                    ];
                }, mapTeams($result->team, false)),
            'camps' => mapCamps($result->camp, false),
            'blocks' => mapBlocks($result->block, false),
            'latrines' => [],
            'latrine_counts' => [
                'red' => 0,
                'yellow' => 0,
                'green' => 0,
            ]
        ];

        $latrines = $this->latrine->lists();

        foreach($latrines as $item):
            $item->colorCode = null;
            $color = ColorCode::$GreenIcon;

            if($item->next_desludge_date):
                $daysLeft = \Carbon\Carbon::parse($item->next_desludge_date)->diffInDays($now);
                $item->daysLeft = $daysLeft;


                if($item->days_left <= 3):
                    $color = ColorCode::$RedIcon;
                    $output['latrine_counts']['red'] += 1;
                elseif($item->days_left > 3 && $daysLeft <= 6):
                    $color = ColorCode::$OrangeIcon;
                    $output['latrine_counts']['yellow'] += 1;
                endif;
            endif;

            $item->colorCode = $color;
            array_push($output['latrines'], (array) $item);
        endforeach;

        $output['latrine_counts']['green'] = count($latrines) - ($output['latrine_counts']['red'] + $output['latrine_counts']['yellow']);

        $output['zones'] = $this->zone->lists()
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

        $result->assigns = $output;

        return $this->sendSuccess('success', JsonResponse::HTTP_OK, $result);
    }
}
