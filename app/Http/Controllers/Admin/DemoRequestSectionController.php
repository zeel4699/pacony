<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\DemoRequestSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DemoRequestSectionController extends Controller
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
        $demo_request = DemoRequestSection::where('language_id', $language->id)->first();

        return view('admin.demo_request.create', compact('demo_request'));
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
            'desc' => 'required',
            'image_status'   =>  'in:show,hide',
            'demo_request_image' => 'mimes:svg,png,jpeg,jpg|max:2048'
        ]);

        // Get All Request
        $input = $request->all();

        if($request->hasFile('demo_request_image')){

            // Get image file
            $demo_request_image_file = $request->file('demo_request_image');

            // Folder path
            $folder = 'uploads/img/demo_request/';

            // Make image name
            $demo_request_image_name = time().'-'.$demo_request_image_file->getClientOriginalName();

            // Original size upload file
            $demo_request_image_file->move($folder, $demo_request_image_name);

            // Set input
            $input['demo_request_image']= $demo_request_image_name;

        } else {
            // Set input
            $input['demo_request_image']= null;
        }

        // Record to database
        DemoRequestSection::firstOrCreate([
            'language_id' => getLanguage()->id,
            'title' => $input['title'],
            'desc' => $input['desc'],
            'image_status' => $input['image_status'],
            'demo_request_image' => $input['demo_request_image']
        ]);

        return redirect()->route('demo-request.create')
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
            'desc' => 'required',
            'image_status'   =>  'in:show,hide',
            'demo_request_image' => 'mimes:svg,png,jpeg,jpg|max:2048'
        ]);

        $demo_request = DemoRequestSection::find($id);

        // Get All Request
        $input = $request->all();

        if($request->hasFile('demo_request_image')){

            // Get image file
            $demo_request_image_file = $request->file('demo_request_image');

            // Folder path
            $folder = 'uploads/img/demo_request/';

            // Make image name
            $demo_request_image_name =  time().'-'.$demo_request_image_file->getClientOriginalName();

            // Delete Image
            File::delete(public_path($folder.$demo_request->demo_request_image));

            // Original size upload file
            $demo_request_image_file->move($folder, $demo_request_image_name);

            // Set input
            $input['demo_request_image']= $demo_request_image_name;

        }

        // Update model
        DemoRequestSection::find($id)->update($input);

        return redirect()->route('demo-request.create')
            ->with('success', 'content.updated_successfully');
    }
}
