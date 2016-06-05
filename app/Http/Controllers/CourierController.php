<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StoreCourierRequest;
use App\Http\Requests\UpdateCourierRequest;
use App\Http\Requests\UploadCourierTemplateRequest;
use App\Courier;
use Excel;

class CourierController extends Controller
{
    protected $user;
    protected $courier;

    public function __construct(Courier $courier)
    {
        $this->user = auth()->user();
        $this->courier = $courier;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->courier->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modals.courier-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourierRequest $request)
    {
        $courierInfo = $request->all();
        $courier = $this->courier->create($courierInfo);

        $message = trans('messages.create', ['name' => $courier->name]);
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
        return view('modals.courier-form');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourierRequest $request, $id)
    {
        $courier = $this->courier->find($id);

        $courierInfo = $request->all();
        $courier->fill($courierInfo);
        $courier->save();

        $message = trans('messages.update', ['name' => $courier->name]);
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
        $courier = $this->courier->find($id);
        $courier->delete();

        $message = trans('messages.delete', ['name' => $courier->name]);
        return compact('message');
    }

    public function uploadTemplate(UploadCourierTemplateRequest $request)
    {
        $courierId = $request->only('courier_id');
        $template = $request->except('excel', 'courier_id');
        $excel = $request->file('excel');

        // Find the courier selected
        $courier = $this->courier->find($courierId['courier_id']);

        // Assign the new path and file name
        $path = 'courier_templates';
        $fileName = $courier->name.'.xls';

        // Upload the file to "public/js/courier_templates"
        $excel->move($path, $fileName);

        // Update the courier with the uploaded template
        $courier->template_path = $path.'/'.$fileName;
        $courier->template_fields = $template;
        $courier->save();

        $message = trans('messages.upload', ['name' => $courier->name]);
        return compact('message');
    }
}
