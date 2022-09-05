<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\SanitationZoneRequest;
use App\Interfaces\SanitizationZoneInterface;
use App\Models\Latrine\Setup\SanitationZone;
use App\Traits\PermissionHandler;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SanitationZoneController extends BaseController
{
    protected $zone;

    use PermissionHandler;

    public function __construct(SanitizationZoneInterface $zone)
    {
        $this->zone = $zone;
        $this->setService($this->zone);
    }

    public function index()
    {
        $this->authorize('list-sanitation-zone', SanitationZone::class);

        $list = $this->zone->lists(true, request()->all(), true);

        return Inertia::render(
            'Setup/Sanitation-Zone/index',
            [
                'list' => $list,
                'access' => $this->accessLists(SanitationZone::class, 'sanitation-zone')
            ]
        );
    }

    public function create()
    {
        $this->authorize('create-sanitation-zone', FacilSanitationZoneityUsed::class);

        return Inertia::render(
            'Setup/Sanitation-Zone/create'

        );
    }

    public function store(SanitationZoneRequest $request)
    {
        $this->authorize('list-sanitation-zone', SanitationZone::class);

        try {
            DB::beginTransaction();
            SanitationZone::create($request->all());

            DB::commit();
            return redirect()->route('setup.sanitation-zone.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function show(SanitationZone $sanitationZone)
    {
        $this->authorize('show-sanitation-zone', SanitationZone::class);
    }


    public function edit(SanitationZone $sanitationZone)
    {
        $this->authorize('edit-sanitation-zone', $sanitationZone);

        return Inertia::render(
            'Setup/Sanitation-Zone/edit',
            [
                'sanitationZone' => $sanitationZone
            ]
        );
    }

    public function update(SanitationZoneRequest $request, SanitationZone $sanitationZone)
    {
        $this->authorize('edit-sanitation-zone', $sanitationZone);

        try {
            DB::beginTransaction();
            $sanitationZone->update($request->all());

            DB::commit();
            return redirect()->route('setup.sanitation-zone.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }
    }


    public function destroy(SanitationZone $sanitationZone)
    {
        $this->authorize('destroy-sanitation-zone', $sanitationZone);

        $sanitationZone->delete();
        return redirect()->route('setup.sanitation-zone.index');
    }
}
