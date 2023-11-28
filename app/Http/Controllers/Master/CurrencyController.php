<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $curs = Currency::orderBy('name')->get();
        return $curs;
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
            'symbol' => 'required',
            'name' => 'required',
            'code' => 'required|unique:currencies,code',
        ]);
        $c = new Currency();
        $c->name = $r->name;
        $c->symbol = $r->symbol;
        $c->code = $r->code;
        $c->symbol_native = $r->symbol_native;
        $c->decimal_digits = (int)$r->decimal_digits;
        $c->rounding = (int)$r->rounding;
        $c->name_plural = $r->name_plural;
        $c->save();
        return response()->json($c, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency)
    {
        return $currency;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Currency $currency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r, Currency $currency)
    {
        $r->validate([
            'symbol' => 'required',
            'name' => 'required',
            'code' => 'required|unique:currencies,code,' . $currency->id,
            'name_plural' => 'required',
        ]);
        $currency->update([
            'symbol' => $r->symbol,
            'name' => $r->name,
            'symbol_native' => $r->symbol_native,
            'decimal_digits' => (int)$r->decimal_digits,
            'rounding' => (int)$r->rounding,
            'code' => $r->code,
            'name_plural' => $r->name_plural,
        ]);
        return response()->json($currency, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Currency $currency)
    {
        return $currency->delete();
    }
}
