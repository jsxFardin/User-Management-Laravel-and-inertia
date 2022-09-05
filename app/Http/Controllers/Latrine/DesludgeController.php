<?php

namespace App\Http\Controllers\Latrine;

use App\Http\Controllers\BaseController;
use App\Interfaces\CampInterface;
use App\Interfaces\DesludgeInterface;
use App\Models\Agency;
use App\Models\Latrine\Desludge;
use App\Models\Latrine\Latrine;
use App\Models\Team;
use App\Traits\PermissionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DesludgeController extends BaseController
{
    protected $desludge;
    protected $camp;

    use PermissionHandler;

    public function __construct(DesludgeInterface $desludge, CampInterface $camp)
    {
        $this->desludge = $desludge;
        $this->camp     = $camp;

        $this->setService($this->camp);
        $this->setService($this->desludge);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list-desludge', Desludge::class);
        $campData = $this->camp->lists();
        $campData = mapArray($campData, true, true, ['block', 'camp']);
        $lists = $this->desludge->lists(true, request()->all(), true);

        $lists->getCollection()->transform(function($item, $key)
        {
            $item->collection_date_time = \Carbon\Carbon::parse($item->collection_date)->format('Y-m-d g:i a');

            return $item;
        });

        return Inertia::render('Latrine/Desludge/index', [
            'lists'  => $lists,
            'camps' => $campData['camp'] ?? [],
            'blocks' => $campData['block'] ?? [],
            'access' => $this->accessLists(Desludge::class, 'desludge')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $desludge = $this->desludge->show($id);
        $desludge->collection_date_time = \Carbon\Carbon::parse($desludge->collection_date)->format('Y-m-d g:i a');

        return Inertia::render('Latrine/Desludge/show', [
            'item' => $desludge,
            'access' => $this->accessLists(Desludge::class, 'desludge')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
