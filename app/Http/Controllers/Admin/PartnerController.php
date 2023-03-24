<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Partner;
use App\Models\Admin\PartnerSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PartnerController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retrieving a model
        $language = getLanguage();
        $partners = Partner::where('language_id', $language->id)->orderBy('id', 'desc')->get();
        $partner_section = PartnerSection::where('language_id', $language->id)->first();

        return view('admin.partner.create', compact('partners', 'partner_section'));
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
            'image_status' => 'in:show,hide',
            'title' => 'required',
            'order' => 'required|integer',
            'partner_image' => 'mimes:svg,png,jpeg,jpg|max:2048',
        ]);

        // Get All Request
        $input = $request->all();

        if($request->hasFile('partner_image')){

            // Get image file
            $partner_image = $request->file('partner_image');

            // Folder path
            $folder ='uploads/img/partner/';

            // Make image name
            $partner_image_name =  time().'-'.$partner_image->getClientOriginalName();

            // Upload image
            $partner_image->move($folder, $partner_image_name);

            // Set input
            $input['partner_image']= $partner_image_name;

        } else {
            // Set input
            $input['partner_image']= null;
        }

        // Record to database
        Partner::create([
            'language_id' => getLanguage()->id,
            'image_status' => $input['image_status'],
            'partner_image' => $input['partner_image'],
            'title' => $input['title'],
            'desc' => $input['desc'],
            'order' => $input['order']
        ]);

        return redirect()->route('partner.create')
            ->with('success', 'content.created_successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Retrieving models
        $partner = Partner::findOrFail($id);

        return view('admin.partner.edit', compact('partner'));
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
            'image_status' => 'in:show,hide',
            'title' => 'required',
            'order' => 'required|integer',
            'partner_image' => 'mimes:svg,png,jpeg,jpg|max:2048',
        ]);

        // Get model
        $partner = Partner::find($id);

        // Get All Request
        $input = $request->all();

        if($request->hasFile('partner_image')){

            // Get image file
            $partner_image = $request->file('partner_image');

            // Folder path
            $folder ='uploads/img/partner/';

            // Make image name
            $partner_image_name =  time().'-'.$partner_image->getClientOriginalName();

            // Delete Image
            File::delete(public_path($folder.$partner->partner_image));

            // Upload image
            $partner_image->move($folder, $partner_image_name);

            // Set input
            $input['partner_image'] = $partner_image_name;

        }

        // Record to database
        Partner::find($id)->update($input);

        return redirect()->route('partner.create')
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
        $partner = Partner::find($id);

        // Folder path
        $folder = 'uploads/img/partner/';

        // Delete Image
        File::delete(public_path($folder.$partner->partner_image));

        // Delete record
        $partner->delete();

        return redirect()->route('partner.create')
            ->with('success', 'content.deleted_successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy_checked(Request $request)
    {
        // Get All Request
        $input = $request->input('checked_lists');

        $arr_checked_lists = explode(",", $input);

        if (array_filter($arr_checked_lists) == []) {
            return redirect()->route('partner.create')
                ->with('warning', 'content.please_choose');
        }

        foreach ($arr_checked_lists as $id) {

            // Retrieve a model
            $partner = Partner::findOrFail($id);

            // Folder path
            $folder = 'uploads/img/partner/';

            // Delete Image
            File::delete(public_path($folder.$partner->partner_image));

            // Delete record
            $partner->delete();

        }

        return redirect()->route('partner.create')
            ->with('success', 'content.deleted_successfully');
    }
}
