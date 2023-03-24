<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ExternalUrl;
use Illuminate\Http\Request;

class ExternalUrlController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retrieving models
        $language = getLanguage();
        $external_url = ExternalUrl::where('language_id', $language->id)->first();

        return view('admin.external_url.create', compact('external_url'));
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
            'btn_name'   =>  'required|max:255',
            'btn_url'   =>  'required',
            'status'   =>  'in:show,hide',
        ]);

        // Get All Request
        $input = $request->all();

        // Record to database
        ExternalUrl::firstOrCreate([
            'language_id' => getLanguage()->id,
            'btn_name' => $input['btn_name'],
            'btn_url' => $input['btn_url'],
            'status' => $input['status']
        ]);

        return redirect()->route('external-url.create')
            ->with('success','content.created_successfully');
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
            'btn_name' => 'required|max:255',
            'btn_url' => 'required',
            'status' => 'in:show,hide',
        ]);

        // Get All Request
        $input = $request->all();

        // Update to database
        ExternalUrl::find($id)->update($input);

        return redirect()->route('external-url.create')
            ->with('success', 'content.updated_successfully');
    }
}
