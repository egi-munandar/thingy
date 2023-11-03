<?php

namespace Database\Seeders;

use App\Models\Master\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file_name = 'common_currency.json';
        $exist = Storage::exists($file_name);
        if ($exist) {
            $currencies = json_decode(Storage::get($file_name));
            foreach ($currencies as $cur) {
                $c = Currency::firstOrNew(['code' => $cur->code]);
                $c->symbol = $cur->symbol;
                $c->name = $cur->name;
                $c->symbol_native = $cur->symbol_native;
                $c->decimal_digits = $cur->decimal_digits;
                $c->rounding = $cur->rounding;
                $c->name_plural = $cur->name_plural;
                $c->save();
            }
        }
    }
}
