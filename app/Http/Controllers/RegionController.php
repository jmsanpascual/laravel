<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StoreRegionRequest;
use App\Http\Requests\UpdateRegionRequest;
use App\Region;

class RegionController extends Controller
{
    protected $region;

    public function __construct(Region $region)
    {
        $this->region = $region;
    }

    public function index()
    {
        return $this->region->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modals.region-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegionRequest $request)
    {
        $regionInfo = $request->all();
        $region = $this->region->create($regionInfo);

        $message = trans('messages.create', ['name' => $region->name]);
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
        return view('modals.region-form');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegionRequest $request, $id)
    {
        $region = $this->region->find($id);

        $regionInfo = $request->all();
        $region->fill($regionInfo);
        $region->save();

        $message = trans('messages.update', ['name' => $region->name]);
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
        $region = $this->region->find($id);
        $region->delete();

        $message = trans('messages.delete', ['name' => $region->name]);
        return compact('message');
    }
}
