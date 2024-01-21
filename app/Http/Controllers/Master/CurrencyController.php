<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function indexPaged(Request $r)
    {
        $page = $r->page ?? 1;
        $pageSize = $r->pageSize ?? 10;
        $q = Currency::skip(($page - 1) * $pageSize)->take($pageSize);
        if ($r->filter) {
            $columns = [
                'symbol',
                'name',
                'symbol_native',
                'code',
                'name_plural',
            ];
            $q->where(function ($w) use ($r, $columns) {
                foreach ($columns as $c) {
                    $w->orWhere($c, 'like', '%' . $r->filter . '%');
                }
            });
        }
        if ($r->sort) {
            $srt = explode(",", $r->sort);
            $q->orderBy(\Str::snake($srt[0]), $srt[1]);
        }
        $data = $q->get();
        $totalPage = ceil(Currency::count() / $pageSize);
        return response()->json(['totalPage' => $totalPage, 'data' => $data], 200);
    }
    public function indexPagedPluto(Request $r)
    {
        $r->validate([
            'filter' => 'array'
        ]);
        $page = $r->page ?? 1;
        $pageSize = $r->pageSize ?? 10;
        $q = Currency::skip(($page - 1) * $pageSize)->take($pageSize);
        if ($r->filter) {
            foreach ($r->filter as $key =>  $f) {
                if ($key == 'all') {
                    //all column
                    $q->where(function ($wa) use ($key, $f) {
                        foreach ($f as $kfi => $fi) {
                            $fvar = $this->pluto_filter_key_to_symbol($kfi);
                            //get table columns
                            $cols = \Schema::getColumnListing((new Currency())->getTable());
                            foreach ($cols as $c) {
                                if ($c == 'id') continue;
                                foreach ($fi as $fil) {
                                    if ($fvar['type'] == 'like') {
                                        $wa->orwhere($c, 'like', $fvar['vb'] . $fil . $fvar['va']);
                                    } else {
                                        $wa->orwhere($c, $fvar['vb'], $fil);
                                    }
                                }
                            }
                        }
                    });
                } else {
                    $q->where(function ($w) use ($key, $f) {
                        foreach ($f as $kfi =>  $fi) {
                            $fvar = $this->pluto_filter_key_to_symbol($kfi);
                            foreach ($fi as $fil) {
                                if ($fvar['type'] == 'like') {
                                    $w->where($key, 'like', $fvar['vb'] . $fil . $fvar['va']);
                                } else {
                                    $w->where($key, $fvar['vb'], $fil);
                                }
                            }
                        }
                    });
                }
            }
        }
        if ($r->sort) {
            $srt = explode(",", $r->sort);
            $q->orderBy(\Str::snake($srt[0]), $srt[1]);
        }
        $data = $q->get();
        $totalPage = ceil(Currency::count() / $pageSize);
        return response()->json(['totalPage' => $totalPage, 'data' => $data], 200);
    }
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
    public function pluto_filter_key_to_symbol(string $str): array
    {
        switch ($str) {
            case 'Contains':
                return ['type' => 'like', 'vb' => '%', 'va' => '%'];
                break;
            case 'Equals':
                return ['type' => 'operator', 'vb' => '=', 'va' => ''];
                break;
            case 'Starts with':
                return ['type' => 'like', 'vb' => '', 'va' => '%'];
                break;
            case 'Ends with':
                return ['type' => 'like', 'vb' => '%', 'va' => ''];
                break;
            case 'Greater than':
                return ['type' => 'operator', 'vb' => '>', 'va' => ''];
                break;
            case 'Greater than or equal to':
                return ['type' => 'operator', 'vb' => '>=', 'va' => ''];
                break;
            case 'Less than':
                return ['type' => 'operator', 'vb' => '<', 'va' => ''];
                break;
            case 'Less than or equal to':
                return ['type' => 'operator', 'vb' => '<=', 'va' => ''];
                break;

            default:
                return ['type' => 'like', 'vb' => '%', 'va' => '%'];
                break;
        }
    }
}
