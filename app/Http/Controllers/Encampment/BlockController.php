<?php

namespace App\Http\Controllers\Encampment;

use App\Http\Controllers\BaseController;
use App\Models\Encampment\Block;
use App\Http\Requests\StoreBlockRequest;
use App\Http\Requests\UpdateBlockRequest;
use App\Interfaces\AgencyInterface;
use App\Interfaces\BlockInterface;
use App\Interfaces\CampInterface;
use App\Models\Encampment\Camp;
use App\Traits\FormateDropDown;
use App\Traits\PermissionHandler;
use Exception;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class BlockController extends BaseController
{
    protected $block;
    protected $camp;
    protected $agency;

    use FormateDropDown, PermissionHandler;

    public function __construct(BlockInterface $block, CampInterface $camp, AgencyInterface $agency)
    {
        $this->block    = $block;
        $this->camp     = $camp;
        $this->agency   = $agency;

        $this->setService($this->block);
        $this->setService($this->camp);
        $this->setService($this->agency);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list-block', Block::class);

        $camps = $this->camp->lists()->map(function($item){
            return [
                'value' => $item->id,
                'label' => $item->name,
            ];
        });

        $lists = $this->block->lists(true, request()->all(), true);

        return Inertia::render(
            'Setup/Encampment/Block/index',
            [
                'list'      => $lists,
                'access'    => $this->accessLists(Block::class, 'block'),
                'camps'     => $camps,
                'blocks'    => [],
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create-block', Block::class);

        $campData = $this->camp->lists();
        $campData = mapArray($campData, true, true, ['camp', 'block']);

        return Inertia::render(
            'Setup/Encampment/Block/create',
            [
                'camps' => $campData['camp'] ?? [],
                'blocks' => $campData['block'] ?? []
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlockRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlockRequest $request)
    {
        $this->authorize('create-block', Block::class);

        try {
            DB::beginTransaction();
            Block::create($request->all());
            DB::commit();
            return redirect()->route('setup.block.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return back()->withErrors($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Encampment\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function show(Block $block)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Encampment\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Block $block)
    {
        $this->authorize('edit-block', $block);

        $campData = $this->camp->lists();
        $campData = mapArray($campData, true, true, ['camp', 'block']);

        return Inertia::render(
            'Setup/Encampment/Block/edit',
            [
                'block' => $block,
                'camps' => $campData['camp'] ?? [],
                'blocks' => $campData['block'] ?? [],
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlockRequest  $request
     * @param  \App\Models\Encampment\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlockRequest $request, Block $block)
    {
        $this->authorize('edit-block', $block);

        try {
            DB::beginTransaction();
            $block->update($request->all());

            DB::commit();
            return redirect()->route('setup.block.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Encampment\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(Block $block)
    {
        $this->authorize('destroy-block', $block);

        $block->delete();
        return redirect()->route('setup.block.index');
    }

    public function getBlockByCamp($camp_id)
    {
        $blocks = $this->block->lists(false, ['camp' => $camp_id])
            ->map(function($item){
                return [
                    'value' => $item->id,
                    'label' => $item->short_name,
                ];
            });
        return response()->json($blocks);
    }

    public function blockAndCampDetails()
    {
        if(request()->has('camp_id')):
            $blocks = $this->block->lists(false, ['camp' => request()->get('camp_id')]);
            return $blocks = setMapping($blocks, 'id', 'short_name', 'camp_id');

        elseif(request()->has('get_parent_id')):
            $blocks = $this->block->lists(false, ['parent_id' => request()->get('get_parent_id')]);
            return $blocks = setMapping($blocks, 'id', 'short_name', 'camp_id');

        else:
            $agency             = $this->agency->show(request()->get('agency_id'));
            $agency->campBlock  = mapCampBlocks($agency->camp, $agency->block, false, false);
            unset($agency->user); unset($agency->team); unset($agency->block); unset($agency->camp);

            $camps = []; $blocks = [];
            foreach ($agency->campBlock as $data):
                array_push($camps, [
                    'value' => $data['id'],
                    'label' => $data['name'],
                ]);
                array_push($blocks, array_map(function ($block) {
                    return [
                        'value' => $block['id'],
                        'label' => $block['name'],
                    ];
                }, $data['blocks']));
            endforeach;

            return response()->json(['camps' => $camps, 'blocks' => $blocks]);
        endif;
    }
}
