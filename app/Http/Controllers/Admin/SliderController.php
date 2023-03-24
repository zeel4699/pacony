<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
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
        $sliders = Slider::where('language_id', $language->id)->orderBy('id', 'desc')->get();

        return view('admin.banner.slider.create', compact('sliders'));
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
            'slider_image' => 'mimes:svg,png,jpeg,jpg',
            'order'   =>  'required|integer',
        ]);

        // Get All Request
        $input = $request->all();

        if($request->hasFile('slider_image')){

            // Get image file
            $slider_image = $request->file('slider_image');

            // Folder path
            $folder ='uploads/img/slider/';

            // Make image name
            $slider_image_name = time().'-'.$slider_image->getClientOriginalName();

            // Upload image
            $slider_image->move($folder, $slider_image_name);

            // Set input
            $input['slider_image']= $slider_image_name;

        } else {
            // Set input
            $input['slider_image']= null;
        }

        // Record to database
        Slider::firstOrCreate([
            'language_id' => getLanguage()->id,
            'title' => $input['title'],
            'desc' => $input['desc'],
            'btn_name' => $input['btn_name'],
            'btn_url' => $input['btn_url'],
            'order' => $input['order'],
            'image_status' => $input['image_status'],
            'slider_image' => $input['slider_image']
        ]);

        return redirect()->route('slider.create')
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
        // Retrieving a model
        $slider = Slider::findOrFail($id);

        return view('admin.banner.slider.edit', compact( 'slider'));
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
            'slider_image' => 'mimes:svg,png,jpeg,jpg',
            'order' => 'required|integer',
        ]);

        // Get model
        $slider = Slider::find($id);

        // Get All Request
        $input = $request->all();

        if($request->hasFile('slider_image')){

            // Get image file
            $slider_image = $request->file('slider_image');

            // Folder path
            $folder ='uploads/img/slider/';

            // Make image name
            $slider_image_name =  time().'-'.$slider_image->getClientOriginalName();

            // Delete Image
            File::delete(public_path($folder.$slider->slider_image));

            // Upload image
            $slider_image->move($folder, $slider_image_name);

            // Set input
            $input['slider_image'] = $slider_image_name;

        }

        // Update user
        Slider::find($id)->update($input);

        return redirect()->route('slider.create')
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
        $slider = Slider::find($id);

        // Folder path
        $folder = 'uploads/img/slider/';

        // Delete Image
        File::delete(public_path($folder.$slider->slider_image));

        // Delete record
        $slider->delete();

        return redirect()->route('slider.create')
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
            return redirect()->route('slider.create')
                ->with('warning', 'content.please_choose');
        }

        foreach ($arr_checked_lists as $id) {

            // Retrieve a model
            $slider = Slider::findOrFail($id);

            // Folder path
            $folder = 'uploads/img/slider/';

            // Delete Image
            File::delete(public_path($folder.$slider->slider_image));

            // Delete record
            $slider->delete();

        }

        return redirect()->route('slider.create')
            ->with('success', 'content.deleted_successfully');
    }
}
