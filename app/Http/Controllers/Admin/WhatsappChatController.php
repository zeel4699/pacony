<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\WhatsappChat;
use App\Models\Admin\WhatsappChatSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class WhatsappChatController extends Controller
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
        $whatsapp_chats = WhatsappChat::where('language_id', $language->id)->orderBy('id', 'desc')->get();
        $whatsapp_chat_section = WhatsappChatSection::where('language_id', $language->id)->first();

        return view('admin.setting.whatsapp_chat.create', compact('whatsapp_chats', 'whatsapp_chat_section'));
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
            'name' => 'required',
            'job' => 'required',
            'phone' => 'required',
            'image_status' => 'in:show,hide',
            'whatsapp_chat_image' => 'mimes:svg,png,jpeg,jpg|max:2048',
            'accessibility' => 'in:online,offline',
            'status' => 'in:published,draft',
            'order' => 'required|integer',
        ]);

        // Get All Request
        $input = $request->all();

        if($request->hasFile('whatsapp_chat_image')){

            // Get image file
            $whatsapp_chat_image = $request->file('whatsapp_chat_image');

            // Folder path
            $folder = 'uploads/img/whatsapp_chat/';

            // Make image name
            $whatsapp_chat_image_name = time().'-'.$whatsapp_chat_image->getClientOriginalName();

            // Upload image
            $whatsapp_chat_image->move($folder, $whatsapp_chat_image_name);

            // Set input
            $input['whatsapp_chat_image'] = $whatsapp_chat_image_name;

        } else {
            // Set input
            $input['whatsapp_chat_image'] = null;
        }

        // Record to database
        WhatsappChat::create([
            'language_id' => getLanguage()->id,
            'image_status' => $input['image_status'],
            'whatsapp_chat_image' => $input['whatsapp_chat_image'],
            'name' => $input['name'],
            'job' => $input['job'],
            'phone' => $input['phone'],
            'accessibility' => $input['accessibility'],
            'status' => $input['status'],
            'order' => $input['order']
        ]);

        return redirect()->route('whatsapp-chat.create')
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
        $whatsapp_chat = WhatsappChat::find($id);

        return view('admin.setting.whatsapp_chat.edit', compact('whatsapp_chat'));
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
            'name' => 'required',
            'job' => 'required',
            'phone' => 'required',
            'image_status' => 'in:show,hide',
            'whatsapp_chat_image' => 'mimes:svg,png,jpeg,jpg|max:2048',
            'accessibility' => 'in:online,offline',
            'status' => 'in:published,draft',
            'order' => 'required|integer',
        ]);

        // Get model
        $whatsapp_chat = WhatsappChat::find($id);

        // Get All Request
        $input = $request->all();

        if($request->hasFile('whatsapp_chat_image')){

            // Get image file
            $whatsapp_chat_image = $request->file('whatsapp_chat_image');

            // Folder path
            $folder ='uploads/img/whatsapp_chat/';

            // Make image name
            $whatsapp_chat_image_name =  time().'-'.$whatsapp_chat_image->getClientOriginalName();

            // Delete Image
            File::delete(public_path($folder.$whatsapp_chat->whatsapp_chat_image));

            // Upload image
            $whatsapp_chat_image->move($folder, $whatsapp_chat_image_name);

            // Set input
            $input['whatsapp_chat_image'] = $whatsapp_chat_image_name;

        }

        // Record to database
        WhatsappChat::find($id)->update($input);

        return redirect()->route('whatsapp-chat.create')
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
        $whatsapp_chat = WhatsappChat::find($id);

        // Folder path
        $folder = 'uploads/img/whatsapp_chat/';

        // Delete Image
        File::delete(public_path($folder.$whatsapp_chat->whatsapp_chat_image));

        // Delete record
        $whatsapp_chat->delete();

        return redirect()->route('whatsapp-chat.create')
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
            return redirect()->route('whatsapp-chat.create')
                ->with('warning', 'content.please_choose');
        }

        foreach ($arr_checked_lists as $id) {

            // Retrieve a model
            $whatsapp_chat = WhatsappChat::findOrFail($id);

            // Folder path
            $folder = 'uploads/img/whatsapp_chat/';

            // Delete Image
            File::delete(public_path($folder.$whatsapp_chat->whatsapp_chat_image));

            // Delete record
            $whatsapp_chat->delete();

        }

        return redirect()->route('whatsapp-chat.create')
            ->with('success', 'content.deleted_successfully');
    }
}
