<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ContactController extends Controller
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
        $contact = Contact::where('language_id', $language->id)->first();

        return view('admin.contact.contact_info.create', compact('contact'));
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
            'image_status'   =>  'in:show,hide',
            'contact_image' => 'mimes:svg,png,jpeg,jpg|max:2048'
        ]);

        // Get All Request
        $input = $request->all();

        if($request->hasFile('contact_image')){

            // Get image file
            $contact_image_file = $request->file('contact_image');

            // Folder path
            $folder = 'uploads/img/contact/';

            // Make image name
            $contact_image_name = time().'-'.$contact_image_file->getClientOriginalName();

            // Original size upload file
            $contact_image_file->move($folder, $contact_image_name);

            // Set input
            $input['contact_image']= $contact_image_name;

        } else {
            // Set input
            $input['contact_image']= null;
        }

        // Record to database
        Contact::firstOrCreate([
            'language_id' => getLanguage()->id,
            'section_title' => $input['section_title'],
            'subject' => $input['subject'],
            'image_status' => $input['image_status'],
            'contact_image' => $input['contact_image']
        ]);

        return redirect()->route('contact.create')
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
            'image_status'   =>  'in:show,hide',
            'contact_image' => 'mimes:svg,png,jpeg,jpg|max:2048'
        ]);

        $contact = Contact::find($id);

        // Get All Request
        $input = $request->all();

        if($request->hasFile('contact_image')){

            // Get image file
            $contact_image_file = $request->file('contact_image');

            // Folder path
            $folder = 'uploads/img/contact/';

            // Make image name
            $contact_image_name =  time().'-'.$contact_image_file->getClientOriginalName();

            // Delete Image
            File::delete(public_path($folder.$contact->contact_image));

            // Original size upload file
            $contact_image_file->move($folder, $contact_image_name);

            // Set input
            $input['contact_image']= $contact_image_name;

        }

        // Update model
        Contact::find($id)->update($input);

        return redirect()->route('contact.create')
            ->with('success', 'content.updated_successfully');
    }
}
