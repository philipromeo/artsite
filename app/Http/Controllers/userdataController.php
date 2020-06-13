<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\userdatas;

class userdataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $udata = userdatas::latest()->paginate(5);
        return view('index', compact('udata'))
                  ->with('i', (request()->input('page',1) -1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'link' => 'required'
          ]);
  
          userdatas::create($request->all());
          return redirect()->route('index')
                          ->with('success', 'new record successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $udata = userdatas::find($id);
        return view('detail', compact('udata'));        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $udata = userdatas::find($id);
        return view('edit', compact('udata'));
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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'link' => 'required'
          ]);
          $udata = userdatas::find($id);
          $udata->namaSiswa = $request->get('title');
          $udata->alamatSiswa = $request->get('description');
          $udata->alamatSiswa = $request->get('link');
          $udata->save();
          return redirect()->route('index')
                          ->with('success', 'Yea updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $udata = userdatas::find($id);
        $udata->delete();
        return redirect()->route('views.index')
                        ->with('success', 'Biodata siswa deleted successfully');
    }
}