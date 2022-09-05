<?php

namespace App\Repositories;

use App\Interfaces\DashboardInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardRepository extends BaseRepository implements DashboardInterface
{
    public function dashboard($param)
    {
        return 'Dashboard';
    }
}
