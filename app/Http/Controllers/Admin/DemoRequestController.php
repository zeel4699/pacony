<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\DemoRequest;
use App\Models\Admin\DemoRequestSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DemoRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieving models
        $demo_requests = DemoRequest::all()->sortByDesc("id");

        return view('admin.demo_request.index', compact('demo_requests'));
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
        DemoRequest::find($id)->update(['read' => 1]);

        return redirect()->route('demo-request.index')
            ->with('success', 'content.updated_successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function mark_all_read_update()
    {
        $demo_requests = DemoRequest::all()->where('read', 0);

        // Update to database
        foreach ($demo_requests as $demo_request) {
            DemoRequest::find($demo_request->id)->update(['read' => 1]);
        }

        return redirect()->route('demo-request.index')
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
        $message = DemoRequest::find($id);

        // Delete record
        $message->delete();

        return redirect()->route('demo-request.index')
            ->with('success', 'content.deleted_successfully');
    }


}
