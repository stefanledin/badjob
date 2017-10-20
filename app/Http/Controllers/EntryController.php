<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Entry;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index', [
            'title' => 'BadJob®',
            'entries' => Entry::all()
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
        $entry = new Entry();
        $entry->start();
        $entry->working_with = request('working_with');
        $entry->duration = 0;
        $entry->save();
        return $entry;
    }

    public function resume($id)
    {
        $entry = Entry::find($id);
        $entry->start();
        $entry->working_with = request('working_with');
        $entry->save();
        return $entry;
    }

    public function stop($id)
    {
        $entry = Entry::find($id);
        $entry->stop();
        $entry->working_with = request('working_with');
        $entry->save();
        return $entry;
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
