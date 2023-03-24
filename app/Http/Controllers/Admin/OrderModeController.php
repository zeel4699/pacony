<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\OrderMode;
use Illuminate\Http\Request;

class OrderModeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retrieving a model
        $order_mode = OrderMode::first();

        return view('admin.setting.order_mode.create', compact('order_mode'));
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
            'order_mode' => 'in:with_free_trial,via_whatsapp,with_payment_method',
        ]);

        // Get All Request
        $input = $request->all();

        // Record to database
        OrderMode::firstOrCreate([
            'order_mode' => $input['order_mode']
        ]);

        return redirect()->route('order-mode.create')
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
            'order_mode' => 'in:with_free_trial,via_whatsapp,with_payment_method',
        ]);

        // Get All Request
        $input = $request->all();

        // Update user
        OrderMode::find($id)->update($input);

        return redirect()->route('order-mode.create')
            ->with('success', 'content.updated_successfully');
    }

}