<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Feature;
use App\Models\Admin\FeatureInfoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FeatureController extends Controller
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
        $feature = Feature::where('language_id', $language->id)->first();
        $info_lists = FeatureInfoList::where('language_id', $language->id)->orderBy('id', 'desc')->get();

        return view('admin.feature.create', compact('feature', 'info_lists'));
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
            'title' => 'required',
            'image_status'   =>  'in:show,hide',
            'feature_image' => 'mimes:svg,png,jpeg,jpg|max:2048'
        ]);

        // Get All Request
        $input = $request->all();

        if($request->hasFile('feature_image')){

            // Get image file
            $feature_image_file = $request->file('feature_image');

            // Folder path
            $folder = 'uploads/img/feature/';

            // Make image name
            $feature_image_name = time().'-'.$feature_image_file->getClientOriginalName();

            // Original size upload file
            $feature_image_file->move($folder, $feature_image_name);

            // Set input
            $input['feature_image']= $feature_image_name;

        } else {
            // Set input
            $input['feature_image']= null;
        }

        // Record to database
        Feature::firstOrCreate([
            'language_id' => getLanguage()->id,
            'title' => $input['title'],
            'desc' => $input['desc'],
            'image_status' => $input['image_status'],
            'feature_image' => $input['feature_image']
        ]);

        return redirect()->route('feature.create')
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
            'title' => 'required',
            'image_status'   =>  'in:show,hide',
            'feature_image' => 'mimes:svg,png,jpeg,jpg|max:2048'
        ]);

        $feature = Feature::find($id);

        // Get All Request
        $input = $request->all();

        if($request->hasFile('feature_image')){

            // Get image file
            $feature_image_file = $request->file('feature_image');

            // Folder path
            $folder = 'uploads/img/feature/';

            // Make image name
            $feature_image_name = time().'-'.$feature_image_file->getClientOriginalName();

            // Delete Image
            File::delete(public_path($folder.$feature->feature_image));

            // Original size upload file
            $feature_image_file->move($folder, $feature_image_name);

            // Set input
            $input['feature_image']= $feature_image_name;

        }

        // Update model
        Feature::find($id)->update($input);

        return redirect()->route('feature.create')
            ->with('success', 'content.updated_successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_info_list(Request $request)
    {
        // Form validation
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'order' => 'required|integer',
        ]);

        // Get All Request
        $input = $request->all();

        // Record to database
        FeatureInfoList::create([
            'language_id' => getLanguage()->id,
            'title' => $input['title'],
            'desc' => $input['desc'],
            'order' => $input['order']
        ]);

        return redirect()->route('feature.create')
            ->with('success', 'content.created_successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_info_list($id)
    {
        // Retrieving models
        $info_list = FeatureInfoList::find($id);

        return view('admin.feature.edit', compact('info_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_info_list(Request $request, $id)
    {
        // Form validation
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'order' => 'integer',
        ]);

        // Get All Request
        $input = $request->all();

        // Record to database
        FeatureInfoList::find($id)->update($input);

        return redirect()->route('feature.create')
            ->with('success', 'content.updated_successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_info_list($id)
    {
        // Retrieve a model
        $info_list = FeatureInfoList::find($id);


        // Delete record
        $info_list->delete();

        return redirect()->route('feature.create')
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

        if ($arr_checked_lists == []) {
            return redirect()->route('feature.create')
                ->with('warning', 'content.please_choose');
        }

        foreach ($arr_checked_lists as $id) {

            // Retrieve a model
            $info_list = FeatureInfoList::findOrFail($id);

            // Delete record
            $info_list->delete();

        }

        return redirect()->route('feature.create')
            ->with('success', 'content.deleted_successfully');
    }

}
