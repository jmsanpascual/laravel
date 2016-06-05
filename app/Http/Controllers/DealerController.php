<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StoreDealerRequest;
use App\Http\Requests\UpdateDealerRequest;
use App\Dealer;
use App\Courier;
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
        $dealer = $request->except('courier');
        $courier = $request->only('courier')['courier'];

        // Get the uploaded template path
        $template = $courier['template_path'];
         // Path to store the template to be downloaded
        $downloadPath = 'courier_templates/download';

        // Check if a template is available for the courier selected for the dealer
        if (empty($template)) {
            $error = trans('errors.template_unavailable', ['name' => $courier['name']]);
            return compact('error');
        }

        // Open and edit the template using the selected dealer values
        Excel::load($template, function ($excel) use ($courier, $dealer) {
            $sheet = $excel->getActiveSheet();

            // Set the cell according to the template
            foreach ($courier['template_fields'] as $key => $cell) {
                $sheet->setCellValue($cell, $dealer[$key]);
            }
        })->save('xls', $downloadPath);

        // Return the path for download
        $downloadPath .= '/'.$courier['name'].'.xls';
        return compact('downloadPath');
    }
}
