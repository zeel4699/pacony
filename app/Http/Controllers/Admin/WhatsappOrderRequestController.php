<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\OrderViaWhatsapp;

class WhatsappOrderRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieving models
        $whatsapp_order_requests = OrderViaWhatsapp::all()->sortByDesc("id");

        return view('admin.whatsapp_order_request.index', compact('whatsapp_order_requests'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_mark($id)
    {
        // Update to database
        OrderViaWhatsapp::find($id)->update(['read' => 1]);

        return redirect()->route('whatsapp-order-request.index')
            ->with('success', 'content.updated_successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function mark_all_read_update()
    {
        $whatsapp_order_requests = OrderViaWhatsapp::all()->where('read', 0);

        // Update to database
        foreach ($whatsapp_order_requests as $whatsapp_order_request) {
            OrderViaWhatsapp::find($whatsapp_order_request->id)->update(['read' => 1]);
        }

        return redirect()->route('whatsapp-order-request.index')
            ->with('success', 'content.updated_successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Retrieve a model
        $message = OrderViaWhatsapp::find($id);

        // Delete record
        $message->delete();

        return redirect()->route('whatsapp-order-request.index')
            ->with('success', 'content.deleted_successfully');
    }

}
