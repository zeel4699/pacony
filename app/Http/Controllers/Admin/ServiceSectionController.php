<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ServiceSection;
use Illuminate\Http\Request;

class ServiceSectionController extends Controller
{
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
            'section_title' => 'required',
            'desc' => 'required',
            'homepage_item_count' => 'required|integer',
            'paginate' => 'required|integer',
        ]);

        // Get All Request
        $input = $request->all();

        // Record to database
        ServiceSection::firstOrCreate([
            'language_id' => getLanguage()->id,
            'section_title' => $input['section_title'],
            'desc' => $input['desc'],
            'homepage_item_count' => $input['homepage_item_count'],
            'paginate' => $input['paginate']
        ]);

        return redirect()->route('service.index')
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
            'section_title' => 'required',
            'desc' => 'required',
            'homepage_item_count' => 'required|integer',
            'paginate' => 'required|integer',
        ]);

        // Get All Request
        $input = $request->all();

        // Update model
        ServiceSection::find($id)->update($input);

        return redirect()->route('service.index')
            ->with('success', 'content.updated_successfully');
    }

}
