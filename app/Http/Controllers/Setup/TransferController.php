<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\Latrine\Setup\Transfer;
use App\Http\Requests\StoreDonorRequest;
use App\Http\Requests\UpdateDonorRequest;
use App\Http\Requests\UpdateTransferRequest;
use App\Traits\PermissionHandler;
use Exception;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class TransferController extends Controller
{
    use PermissionHandler;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('list-transfer', Transfer::class);

        $list = Transfer::when(request()->has('search'), function ($query) {
                $query->where('name', 'LIKE', '%' . request()->search . '%');
            })
            ->when(request()->has('name'), function ($query) {
                $query->orderBy(request()->name, request()->sort);
            })
            ->paginate(request()->max_count ?? 10);

        return Inertia::render(
            'Setup/Transfer/index',
            [
                'list' => $list,
                'access' => $this->accessLists(Transfer::class, 'transfer')
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
        $this->authorize('create-transfer', Transfer::class);

        return Inertia::render(
            'Setup/Transfer/create'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDonorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDonorRequest $request)
    {
        $this->authorize('create-transfer', Transfer::class);

        try {
            DB::beginTransaction();
            Transfer::create($request->all());
            DB::commit();
            return redirect()->route('setup.transfer.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donor  $donor
     * @return \Illuminate\Http\Response
     */
    public function show(Donor $donor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donor  $donor
     * @return \Illuminate\Http\Response
     */
    public function edit(Transfer $transfer)
    {
        $this->authorize('edit-transfer', $transfer);

        return Inertia::render(
            'Setup/Transfer/edit',
            [
                'transfer' => $transfer
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDonorRequest  $request
     * @param  \App\Models\Donor  $donor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransferRequest $request, Transfer $transfer)
    {
        $this->authorize('edit-transfer', $transfer);

        try {
            DB::beginTransaction();
            $transfer->update($request->all());
            DB::commit();
            return redirect()->route('setup.transfer.index');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donor  $donor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer)
    {
        $this->authorize('destroy-transfer', $transfer);

        $transfer->delete();
        return redirect()->route('setup.transfer.index');
    }
}
