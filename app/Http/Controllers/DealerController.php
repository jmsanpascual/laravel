<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StoreDealerRequest;
use App\Http\Requests\UpdateDealerRequest;
use App\Dealer;
use Excel;

class DealerController extends Controller
{
    protected $user;
    protected $dealer;

    public function __construct(Dealer $dealer)
    {
        $this->user = auth()->user();
        $this->dealer = $dealer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Return only the dealers that match the regions of the
        // current user with view permission
        $regionIds = $this->user->getViewableRegionIds();
        return $this->dealer->with('region', 'courier')
            ->whereIn('region_id', $regionIds)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = $this->user;
        return view('modals.dealer-form', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDealerRequest $request)
    {
        $dealerInfo = $request->all();
        $dealer = $this->dealer->create($dealerInfo);

        $message = trans('messages.create', ['name' => $dealer->name]);
        return compact('message');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dealerId = $this->dealer->find($id)->region_id;
        $user = $this->user;
        return view('modals.dealer-form', compact('user', 'dealerId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDealerRequest $request, $id)
    {
        $dealer = $this->dealer->find($id);

        $dealerInfo = $request->except('region', 'courier');
        $dealer->fill($dealerInfo);
        $dealer->save();

        $message = trans('messages.update', ['name' => $dealer->name]);
        return compact('message');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dealer = $this->dealer->find($id);

        if ($this->user->cannot('delete', $dealer)) {
            $error = trans('auth.delete', ['noun' => 'dealer']);
            return compact('error');
        }

        $dealer->delete();

        $message = trans('messages.delete', ['name' => $dealer->name]);
        return compact('message');
    }

    public function export(Request $request)
    {
        Excel::load('img/test.xlsx', function ($excel) {
            $sheet = $excel->getActiveSheet();
            $sheet->setCellValue('B7', 'Company Name');
        })->save('xlsx', 'img');

        return;
    }
}
