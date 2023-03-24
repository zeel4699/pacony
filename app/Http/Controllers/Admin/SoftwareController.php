<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Currency;
use App\Models\Admin\OrderMode;
use App\Models\Admin\Software;
use App\Models\Admin\SoftwareCategory;
use App\Models\Admin\SoftwareSection;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Default values
        $currency_symbol = "$";
        $currency_position = "left";
        $decimal_digit = 2;
        $decimal_separator = ".";
        $thousand_separator = ",";

        // Retrieving models
        $currency = Currency::first();

        if (isset($currency)) {
            $currency_symbol = $currency->currency;
            $currency_position = $currency->currency_position;
            $decimal_digit = $currency->decimal_digit;

            if ($decimal_separator == "dot") {
                $decimal_separator = ".";
            } elseif ($decimal_separator == "comma") {
                $decimal_separator = ",";
            } else {
                $decimal_separator = " "; //space
            }

            if ($thousand_separator == "dot") {
                $thousand_separator = ".";
            } elseif ($thousand_separator == "comma") {
                $thousand_separator = ",";
            } else {
                $thousand_separator = " "; //space
            }
        }

        // Retrieving models
        $language = getLanguage();
        $softwares = Software::where('language_id', $language->id)->orderBy('id', 'desc')->get();
        $categories = SoftwareCategory::where('language_id', $language->id)->get();
        $software_section = SoftwareSection::where('language_id', $language->id)->first();

        if (count($categories) > 0) {

            return view('admin.software.index', compact(  'softwares', 'software_section',
                'currency_symbol', 'currency_position', 'decimal_digit', 'decimal_separator', 'thousand_separator'));
        } else{

            return redirect()->route('software-category.create')
                ->with('success', 'content.please_create_a_category');

        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Default values
        $currency_symbol = "$";
        $currency_position = "left";
        $decimal_digit = 2;
        $decimal_separator = ".";
        $thousand_separator = ",";

        // Retrieving models
        $currency = Currency::first();

        if (isset($currency)) {
            $currency_symbol = $currency->currency;
            $currency_position = $currency->currency_position;
            $decimal_digit = $currency->decimal_digit;

            if ($decimal_separator == "dot") {
                $decimal_separator = ".";
            } elseif ($decimal_separator == "comma") {
                $decimal_separator = ",";
            } else {
                $decimal_separator = " "; //space
            }

            if ($thousand_separator == "dot") {
                $thousand_separator = ".";
            } elseif ($thousand_separator == "comma") {
                $thousand_separator = ",";
            } else {
                $thousand_separator = " "; //space
            }
        }

        // Retrieving models
        $language = getLanguage();
        $categories = SoftwareCategory::where('language_id', $language->id)->get();

        if (count($categories) > 0) {

            return view('admin.software.create', compact('categories',
                'currency_symbol', 'currency_position', 'decimal_digit', 'decimal_separator', 'thousand_separator'));

        } else{

            return redirect()->route('software-category.create')
                ->with('success', 'content.please_create_a_category');

        }

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
            'category_id' => 'integer|required',
            'title' => 'required',
            'period' => 'required|in:monthly,annually,onetime',
            'image_status'   =>  'in:show,hide',
            'software_image'   =>  'mimes:svg,png,jpeg,jpg|max:2048',
            'status' => 'in:published,draft',
            'breadcrumb_status' => 'in:yes,no',
            'order'   =>  'required|integer',
            'custom_breadcrumb_image' => 'mimes:svg,png,jpeg,jpg|max:2048'
        ]);

        // Get All Request
        $input = $request->all();

        if ($input['period'] == "monthly") {
            $request->validate([
                'monthly_price' => 'required',
            ]);
        } elseif ($input['period'] == "annually") {
            $request->validate([
                'annually_price' => 'required',
            ]);
        } elseif ($input['period'] == "onetime") {
            $request->validate([
                'onetime_price' => 'required',
            ]);
        }

        if($request->hasFile('software_image')){

            // Get image file
            $software_image_file = $request->file('software_image');

            // Folder path
            $folder = 'uploads/img/software/';
            $folder1 = 'uploads/img/software/thumbnail1/';

            // Make image name
            $software_image_name = time().'-'.$software_image_file->getClientOriginalName();

            // Resizing an uploaded file
            Image::make($request->file('software_image'))->fit(310, 160)->save($folder1.$software_image_name);

            // Original size upload file
            $software_image_file->move($folder, $software_image_name);

            // Set input
            $input['software_image']= $software_image_name;

        } else {
            // Set input
            $input['software_image']= null;
        }

        if($request->hasFile('custom_breadcrumb_image')){

            // Get image file
            $custom_breadcrumb_image_file = $request->file('custom_breadcrumb_image');

            // Folder path
            $folder = 'uploads/img/software/breadcrumb/';

            // Make image name
            $custom_breadcrumb_image_name = time().'-'.$custom_breadcrumb_image_file->getClientOriginalName();

            // Original size upload file
            $custom_breadcrumb_image_file->move($folder, $custom_breadcrumb_image_name);

            // Set input
            $input['custom_breadcrumb_image'] = $custom_breadcrumb_image_name;

        } else {
            // Set input
            $input['custom_breadcrumb_image'] = null;
        }

        if ($input['monthly_price'] == "") {
            $input['monthly_price'] = null;
        }

        if ($input['annually_price'] == "") {
            $input['annually_price'] = null;
        }

        if ($input['onetime_price'] == "") {
            $input['onetime_price'] = null;
        }

        if ($input['tax_value'] == "") {
            $input['tax_value'] = null;
        }

        $general_order_mode = OrderMode::first();

        // Order Mode Checking
        if (isset($general_order_mode)) {
            if ($general_order_mode->order_mode == "via_whatsapp") {
                $input['demo_other_info'] = null;
            }
            if ($general_order_mode->order_mode == "with_free_trial") {
                $input['whatsapp_phone_number'] = null;
                $input['phone_number'] = null;
            }
        } else {
            $input['whatsapp_phone_number'] = null;
            $input['phone_number'] = null;
        }

        // Find category
        $category = SoftwareCategory::find($input['category_id']);

        // Record to database
        Software::create([
            'language_id' => getLanguage()->id,
            'category_name' => $category->category_name,
            'category_id' => $input['category_id'],
            'title' => $input['title'],
            'desc' => Purifier::clean($input['desc']),
            'software_feature_list' => $input['software_feature_list'],
            'server_requirement' => $input['server_requirement'],
            'tag' => $input['tag'],
            'period' => $input['period'],
            'monthly_price' => $input['monthly_price'],
            'annually_price' => $input['annually_price'],
            'onetime_price' => $input['onetime_price'],
            'tax_value' => $input['tax_value'],
            'demo_site_url' => $input['demo_site_url'],
            'demo_panel_url' => $input['demo_panel_url'],
            'demo_other_info' => Purifier::clean($input['demo_other_info']),
            'image_status' => $input['image_status'],
            'software_image' => $input['software_image'],
            'meta_desc' => $input['meta_desc'],
            'meta_keyword' => $input['meta_keyword'],
            'breadcrumb_status' => $input['breadcrumb_status'],
            'custom_breadcrumb_image' => $input['custom_breadcrumb_image'],
            'phone_number' => $input['phone_number'],
            'whatsapp_phone_number' => $input['whatsapp_phone_number'],
            'order' => $input['order'],
            'status' => $input['status']
        ]);

        return redirect()->route('software.index')
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
        // Default values
        $currency_symbol = "$";
        $currency_position = "left";
        $decimal_digit = 2;
        $decimal_separator = ".";
        $thousand_separator = ",";

        // Retrieving models
        $currency = Currency::first();

        if (isset($currency)) {
            $currency_symbol = $currency->currency;
            $currency_position = $currency->currency_position;
            $decimal_digit = $currency->decimal_digit;

            if ($decimal_separator == "dot") {
                $decimal_separator = ".";
            } elseif ($decimal_separator == "comma") {
                $decimal_separator = ",";
            } else {
                $decimal_separator = " "; //space
            }

            if ($thousand_separator == "dot") {
                $thousand_separator = ".";
            } elseif ($thousand_separator == "comma") {
                $thousand_separator = ",";
            } else {
                $thousand_separator = " "; //space
            }
        }

        // Retrieving models
        $language = getLanguage();
        $software = Software::findOrFail($id);
        $categories = SoftwareCategory::where('language_id', $language->id)->get();

        return view('admin.software.edit', compact('software', 'categories',
            'currency_symbol', 'currency_position', 'decimal_digit', 'decimal_separator',
            'thousand_separator'));
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
            'category_id' => 'integer|required',
            'title' => 'required',
            'period' => 'required|in:monthly,annually,onetime',
            'image_status'   =>  'in:show,hide',
            'software_image'   =>  'mimes:svg,png,jpeg,jpg|max:2048',
            'status' => 'in:published,draft',
            'breadcrumb_status' => 'in:yes,no',
            'order'   =>  'required|integer',
            'custom_breadcrumb_image' => 'mimes:svg,png,jpeg,jpg|max:2048'
        ]);

        $software = Software::find($id);

        // Get All Request
        $input = $request->all();

        if ($input['period'] == "monthly") {
            $request->validate([
                'monthly_price' => 'required',
            ]);
        } elseif ($input['period'] == "annually") {
            $request->validate([
                'annually_price' => 'required',
            ]);
        } elseif ($input['period'] == "onetime") {
            $request->validate([
                'onetime_price' => 'required',
            ]);
        }

        if($request->hasFile('software_image')){

            // Get image file
            $software_image_file = $request->file('software_image');

            // Folder path
            $folder = 'uploads/img/software/';
            $folder1 = 'uploads/img/software/thumbnail1/';

            // Make image name
            $software_image_name = time().'-'.$software_image_file->getClientOriginalName();

            // Delete Image
            File::delete(public_path($folder.$software->software_image));
            File::delete(public_path($folder1.$software->software_image));

            // Resizing an uploaded file
            Image::make($request->file('software_image'))->fit(310, 160)->save($folder1.$software_image_name);

            // Original size upload file
            $software_image_file->move($folder, $software_image_name);

            // Set input
            $input['software_image']= $software_image_name;

        }

        if($request->hasFile('custom_breadcrumb_image')){

            // Get image file
            $custom_breadcrumb_image_file = $request->file('custom_breadcrumb_image');

            // Folder path
            $folder = 'uploads/img/software/breadcrumb/';

            // Make image name
            $custom_breadcrumb_image_name =  time().'-'.$custom_breadcrumb_image_file->getClientOriginalName();

            // Delete Image
            File::delete(public_path($folder.$software->custom_breadcrumb_image));

            // Original size upload file
            $custom_breadcrumb_image_file->move($folder, $custom_breadcrumb_image_name);

            // Set input
            $input['custom_breadcrumb_image']= $custom_breadcrumb_image_name;

        }

        if ($input['monthly_price'] == "") {
            $input['monthly_price'] = null;
        }

        if ($input['annually_price'] == "") {
            $input['annually_price'] = null;
        }

        if ($input['onetime_price'] == "") {
            $input['onetime_price'] = null;
        }

        if ($input['tax_value'] == "") {
            $input['tax_value'] = null;
        }

        $general_order_mode = OrderMode::first();

        // Order Mode Checking
        if (isset($general_order_mode)) {
            if ($general_order_mode->order_mode == "via_whatsapp") {
                $input['demo_other_info'] = null;
            }
            if ($general_order_mode->order_mode == "with_free_trial") {
                $input['whatsapp_phone_number'] = null;
                $input['phone_number'] = null;
            }
        } else {
            $input['whatsapp_phone_number'] = null;
            $input['phone_number'] = null;
        }

        // Find category
        $category = SoftwareCategory::find($input['category_id']);
        $input['category_name'] = $category->category_name;

        // XSS Purifier
        $input['desc'] = Purifier::clean($input['desc']);
        $input['demo_other_info'] = Purifier::clean($input['demo_other_info']);

        // Record to database
        Software::find($id)->update($input);

        return redirect()->route('software.index')
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
        $software = Software::find($id);

        // Folder path
        $folder = 'uploads/img/software/breadcrumb/';
        $folder1 = 'uploads/img/software/';
        $folder2 = 'uploads/img/software/thumbnail1/';

        // Delete Image
        File::delete(public_path($folder.$software->custom_breadcrumb_image));
        File::delete(public_path($folder1.$software->software_image));
        File::delete(public_path($folder2.$software->software_image));

        // Delete record
        $software->delete();

        return redirect()->route('software.index')
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
            return redirect()->route('software.create')
                ->with('warning', 'content.please_choose');
        }

        foreach ($arr_checked_lists as $id) {

            // Retrieve a model
            $software = Software::find($id);

            // Folder path
            $folder = 'uploads/img/software/breadcrumb/';
            $folder1 = 'uploads/img/software/';
            $folder2 = 'uploads/img/software/thumbnail1/';

            // Delete Image
            File::delete(public_path($folder.$software->custom_breadcrumb_image));
            File::delete(public_path($folder1.$software->software_image));
            File::delete(public_path($folder2.$software->software_image));

            // Delete record
            $software->delete();

        }

        return redirect()->route('software.index')
            ->with('success', 'content.deleted_successfully');
    }
}
