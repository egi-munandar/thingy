<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Currency;
use App\Models\Master\Instance;
use Illuminate\Http\Request;

class InstanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cur = Currency::first();
        return $cur;
        return response()->json($cur, 200);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Instance $instance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instance $instance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instance $instance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instance $instance)
    {
        //
    }
}