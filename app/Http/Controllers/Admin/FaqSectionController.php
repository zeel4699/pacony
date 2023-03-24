<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\FaqSection;
use Illuminate\Http\Request;

class FaqSectionController extends Controller
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
            'homepage_item_count' => 'integer|required',
        ]);

        // Get All Request
        $input = $request->all();

        // Record to database
        FaqSection::firstOrCreate([
            'language_id' => getLanguage()->id,
            'section_title' => $input['section_title'],
            'desc' => $input['desc'],
            'homepage_item_count' => $input['homepage_item_count'],
        ]);

        return redirect()->route('faq.create')
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
            'homepage_item_count' => 'integer|required',
            ]);

        // Get All Request
        $input = $request->all();

        // Update model
        FaqSection::find($id)->update($input);

        return redirect()->route('faq.create')
            ->with('success', 'content.updated_successfully');
    }
}
