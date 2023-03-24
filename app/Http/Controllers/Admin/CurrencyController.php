<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retrieving a model
        $currency = Currency::first();

        return view('admin.currency.create', compact('currency'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Form validation
        $request->validate([
            'currency' => 'required',
            'currency_position' => 'in:left,right',
            'decimal_digit' => 'integer|in:0,1,2,3,4,5',
            'decimal_separator' => 'in:dot,comma,space',
            'thousand_separator' => 'in:dot,comma,space',
        ]);

        // Get All Request
        $input = $request->all();

        // Record to database
        Currency::firstOrCreate([
            'currency' => $input['currency'],
            'currency_position' => $input['currency_position'],
            'decimal_digit' => $input['decimal_digit'],
            'decimal_separator' => $input['decimal_separator'],
            'thousand_separator' => $input['thousand_separator']
        ]);

        return redirect()->route('currency.create')
            ->with('success', 'content.created_successfully');
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
        // Form validation
        $request->validate([
            'currency' => 'required',
            'currency_position' => 'in:left,right',
            'decimal_digit' => 'integer|in:0,1,2,3,4,5',
            'decimal_separator' => 'in:dot,comma,space',
            'thousand_separator' => 'in:dot,comma,space',
        ]);

        // Get All Request
        $input = $request->all();

        // Update model
        Currency::find($id)->update($input);

        return redirect()->route('currency.create')
            ->with('success', 'content.updated_successfully');
    }

}
