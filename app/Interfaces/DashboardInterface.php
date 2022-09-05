<?php

namespace App\Interfaces;

interface DashboardInterface
{
    public function desludgedVolume($param);
    public function typeofLatrine($param);
    public function desludgedTypeofLatrine($param);
    public function totalHoursUsed($param);
    public function seeForeignMaterials($param);
    public function totalLitterFuelUsed($param);
    public function latrineDesludgeQuery($param);
}
