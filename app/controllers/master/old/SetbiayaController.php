<?php

namespace App\Controllers\Master;

use App\Models\Biaya;

class SetbiayaController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return \View::make('master.setbiaya.index')->with('tapel', \App\Models\Tapel::all());
    }  
    

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //return \View::make('master.setbiaya.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
//        $setbiaya = new Setbiaya();
//        $setbiaya->nama = \Input::get('nama');
//        $setbiaya->save();
//        
//        return \Redirect::route('master.setbiaya.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        return \View::make('master.setbiaya.edit')->with('tapel', \App\Models\Tapel::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $setbiaya = Setbiaya::find($id);
        $setbiaya->nama = \Input::get('nama');
        $setbiaya->save();
        
        return \Redirect::route('master.setbiaya.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        Setbiaya::whereId($id)->delete();
        return \Redirect::route('master.setbiaya.index');
    }

}
