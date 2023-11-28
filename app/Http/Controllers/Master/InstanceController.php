<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Instance as Inst;
use Illuminate\Http\Request;

class InstanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inst = Inst::all();
        return response()->json($inst, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        $r->validate([
            'name' => 'required|unique:instances,name',
            'currency_code' => 'required',
            'currency' => 'required',
            'currency_symbol' => 'required'
        ]);
        $i = new Inst();
        $i->name = $r->name;
        $i->currency_code = $r->currency_code;
        $i->currency = $r->currency;
        $i->currency_symbol = $r->currency_symbol;
        $i->save();
        return response()->json($i, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inst $instance)
    {
        return response()->json($instance, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inst $instance)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r, Inst $instance)
    {
        info($r->all());
        $r->validate([
            'name' => 'required|unique:instances,name,' . $instance->id,
            'currency_code' => 'required',
            'currency' => 'required',
            'currency_symbol' => 'required'
        ]);
        $instance->name = $r->name;
        $instance->currency_code = $r->currency_code;
        $instance->currency = $r->currency;
        $instance->currency_symbol = $r->currency_symbol;
        $instance->save();
        return response()->json($instance, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inst $instance)
    {
        return $instance->delete();
    }
}
