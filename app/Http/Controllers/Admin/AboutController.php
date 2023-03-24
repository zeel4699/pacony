<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\About;
use App\Models\Admin\InfoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AboutController extends Controller
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
        $about = About::where('language_id', $language->id)->first();
        $info_lists = InfoList::where('language_id', $language->id)->orderBy('id', 'desc')->get();

        return view('admin.about.create', compact('about', 'info_lists'));
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
            'about_image' => 'mimes:svg,png,jpeg,jpg|max:2048'
        ]);

        // Get All Request
        $input = $request->all();

        if($request->hasFile('about_image')){

            // Get image file
            $about_image_file = $request->file('about_image');

            // Folder path
            $folder = 'uploads/img/about/';

            // Make image name
            $about_image_name = time().'-'.$about_image_file->getClientOriginalName();

            // Original size upload file
            $about_image_file->move($folder, $about_image_name);

            // Set input
            $input['about_image']= $about_image_name;

        } else {
            // Set input
            $input['about_image']= null;
        }

        // Record to database
        About::firstOrCreate([
            'language_id' => getLanguage()->id,
            'title' => $input['title'],
            'desc' => $input['desc'],
            'btn_name' => $input['btn_name'],
            'btn_url' => $input['btn_url'],
            'image_status' => $input['image_status'],
            'about_image' => $input['about_image']
        ]);

        return redirect()->route('about.create')
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
            'about_image' => 'mimes:svg,png,jpeg,jpg|max:2048'
        ]);

        $about = About::find($id);

        // Get All Request
        $input = $request->all();

        if($request->hasFile('about_image')){

            // Get image file
            $about_image_file = $request->file('about_image');

            // Folder path
            $folder = 'uploads/img/about/';

            // Make image name
            $about_image_name =  time().'-'.$about_image_file->getClientOriginalName();

            // Delete Image
            File::delete(public_path($folder.$about->about_image));

            // Original size upload file
            $about_image_file->move($folder, $about_image_name);

            // Set input
            $input['about_image']= $about_image_name;

        }

        // Update model
        About::find($id)->update($input);

        return redirect()->route('about.create')
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
            'type' => 'in:icon,image',
            'image_status' => 'in:show,hide',
            'title' => 'required',
            'desc' => 'required',
            'order' => 'required|integer',
            'info_image' => 'mimes:svg,png,jpeg,jpg|max:2048',
        ]);

        // Get All Request
        $input = $request->all();

        if($request->hasFile('info_image')){

            // Get image file
            $info_image = $request->file('info_image');

            // Folder path
            $folder ='uploads/img/about/info_list/';

            // Make image name
            $info_image_name =  time().'-'.$info_image->getClientOriginalName();

            // Upload image
            $info_image->move($folder, $info_image_name);

            // Set input
            $input['info_image']= $info_image_name;

        } else {
            // Set input
            $input['info_image']= null;
        }

        // Record to database
        InfoList::create([
            'language_id' => getLanguage()->id,
            'type' => $input['type'],
            'icon' => $input['icon'],
            'image_status' => $input['image_status'],
            'info_image' => $input['info_image'],
            'title' => $input['title'],
            'desc' => $input['desc'],
            'order' => $input['order']
        ]);

        return redirect()->route('about.create')
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
        $info_list = InfoList::find($id);

        return view('admin.about.edit', compact('info_list'));
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
            'type' => 'in:icon,image',
            'image_status' => 'in:show,hide',
            'title' => 'required',
            'desc' => 'required',
            'order' => 'integer',
            'info_image' => 'mimes:svg,png,jpeg,jpg|max:2048',
        ]);

        $info_list = InfoList::find($id);

        // Get All Request
        $input = $request->all();

        if($request->hasFile('info_image')){

            // Get image file
            $info_image_file = $request->file('info_image');

            // Folder path
            $folder = 'uploads/img/about/info_list/';

            // Make image name
            $info_image_name =  time().'-'.$info_image_file->getClientOriginalName();

            // Delete Image
            File::delete(public_path($folder.$info_list->info_image));

            // Original size upload file
            $info_image_file->move($folder, $info_image_name);

            // Set input
            $input['info_image']= $info_image_name;

        }

        // Record to database
        InfoList::find($id)->update($input);

        return redirect()->route('about.create')
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
        $info_list = InfoList::find($id);

        // Folder path
        $folder = 'uploads/img/about/info_list/';

        // Delete Image
        File::delete(public_path($folder.$info_list->info_image));

        // Delete record
        $info_list->delete();

        return redirect()->route('about.create')
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
            return redirect()->route('about.create')
                ->with('warning', 'content.please_choose');
        }

        foreach ($arr_checked_lists as $id) {

            // Retrieve a model
            $info_list = InfoList::findOrFail($id);

            // Folder path
            $folder = 'uploads/img/about/info_list/';

            // Delete Image
            File::delete(public_path($folder.$info_list->feature_image));

            // Delete record
            $info_list->delete();

        }

        return redirect()->route('about.create')
            ->with('success', 'content.deleted_successfully');
    }

}
