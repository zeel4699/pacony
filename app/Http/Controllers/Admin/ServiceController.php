<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Currency;
use App\Models\Admin\OrderMode;
use App\Models\Admin\Service;
use App\Models\Admin\ServiceSection;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    /**
     * Show the form for creating a new resource.
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

        // Retrieving a model
        $language = getLanguage();
        $services = Service::where('language_id', $language->id)->orderBy('id', 'desc')->get();
        $service_section = ServiceSection::where('language_id', $language->id)->first();

        return view('admin.service.index', compact('services', 'service_section',
            'currency_symbol', 'currency_position', 'decimal_digit', 'decimal_separator', 'thousand_separator'));
    }

    /**
     * Show the form for creating a new resource.
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

        $order_mode = OrderMode::first();

        return view('admin.service.create', compact('order_mode',
            'currency_symbol', 'currency_position', 'decimal_digit', 'decimal_separator', 'thousand_separator'));
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
            'service_name' => 'required',
            'period' => 'required|in:monthly,annually,onetime',
            'image_status'   =>  'in:show,hide',
            'service_image' => 'mimes:svg,png,jpeg,jpg|max:2048',
            'breadcrumb_status' => 'in:yes,no',
            'order'   =>  'required|integer',
            'custom_breadcrumb_image' => 'mimes:svg,png,jpeg,jpg|max:2048',
            'status'   =>  'in:published,draft',
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

        if($request->hasFile('service_image')){

            // Get image file
            $service_image_file = $request->file('service_image');

            // Folder path
            $folder = 'uploads/img/service/';

            // Make image name
            $service_image_name = time().'-'.$service_image_file->getClientOriginalName();

            // Original size upload file
            $service_image_file->move($folder, $service_image_name);

            // Set input
            $input['service_image']= $service_image_name;

        } else {
            // Set input
            $input['service_image']= null;
        }

        if($request->hasFile('custom_breadcrumb_image')){

            // Get image file
            $custom_breadcrumb_image_file = $request->file('custom_breadcrumb_image');

            // Folder path
            $folder = 'uploads/img/service/breadcrumb/';

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
            if ($general_order_mode->order_mode == "with_free_trial") {
                $input['whatsapp_phone_number'] = null;
            } elseif ($general_order_mode->order_mode == "via_whatsapp") {
                $input['demo_admin_url'] = null;
                $input['demo_other_info'] = null;
            } else {
                $input['demo_admin_url'] = null;
                $input['demo_other_info'] = null;
                $input['whatsapp_phone_number'] = null;
            }
        } else {
            $input['whatsapp_phone_number'] = null;
        }

        // XSS Purifier
        $input['demo_other_info'] = Purifier::clean($input['demo_other_info']);

        // Record to database
        Service::create([
            'language_id' => getLanguage()->id,
            'service_name' => $input['service_name'],
            'demo_url' => $input['demo_url'],
            'demo_admin_url' => $input['demo_admin_url'],
            'demo_other_info' => $input['demo_other_info'],
            'image_status' => $input['image_status'],
            'service_image' => $input['service_image'],
            'period' => $input['period'],
            'monthly_price' => $input['monthly_price'],
            'annually_price' => $input['annually_price'],
            'onetime_price' => $input['onetime_price'],
            'feature_list' => $input['feature_list'],
            'non_feature_list' => $input['non_feature_list'],
            'tax_value' => $input['tax_value'],
            'whatsapp_phone_number' => $input['whatsapp_phone_number'],
            'order' => $input['order'],
            'meta_desc' => $input['meta_desc'],
            'meta_keyword' => $input['meta_keyword'],
            'breadcrumb_status' => $input['breadcrumb_status'],
            'custom_breadcrumb_image' => $input['custom_breadcrumb_image'],
            'status' => $input['status']
        ]);

        return redirect()->route('service.index')
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
        $order_mode = OrderMode::first();
        $service = Service::find($id);

        return view('admin.service.edit', compact('service', 'order_mode',
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
            'service_name' => 'required',
            'period' => 'required|in:monthly,annually,onetime',
            'image_status'   =>  'in:show,hide',
            'service_image' => 'mimes:svg,png,jpeg,jpg|max:2048',
            'breadcrumb_status' => 'in:yes,no',
            'order'   =>  'required|integer',
            'custom_breadcrumb_image' => 'mimes:svg,png,jpeg,jpg|max:2048',
            'status'   =>  'in:published,draft',
        ]);

        $service = Service::find($id);

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

        if($request->hasFile('service_image')){

            // Get image file
            $service_image_file = $request->file('service_image');

            // Folder path
            $folder = 'uploads/img/service/';

            // Make image name
            $service_image_name = time().'-'.$service_image_file->getClientOriginalName();

            // Delete Image
            File::delete(public_path($folder.$service->service_image));

            // Original size upload file
            $service_image_file->move($folder, $service_image_name);

            // Set input
            $input['service_image']= $service_image_name;

        }

        if($request->hasFile('custom_breadcrumb_image')){

            // Get image file
            $custom_breadcrumb_image_file = $request->file('custom_breadcrumb_image');

            // Folder path
            $folder = 'uploads/img/service/breadcrumb/';

            // Make image name
            $custom_breadcrumb_image_name =  time().'-'.$custom_breadcrumb_image_file->getClientOriginalName();

            // Delete Image
            File::delete(public_path($folder.$service->custom_breadcrumb_image));

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

        // Order Mode Checking
        if (isset($general_order_mode)) {
            if ($general_order_mode->order_mode == "with_free_trial") {
                // XSS Purifier
                $input['demo_other_info'] = Purifier::clean($input['demo_other_info']);            }
        }



        // Record to database
        Service::find($id)->update($input);

        return redirect()->route('service.index')
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
        $service = Service::find($id);

        // Folder path
        $folder = 'uploads/img/service/';
        $folder2 = 'uploads/img/service/breadcrumb/';


        // Delete Image
        File::delete(public_path($folder.$service->service_image));
        File::delete(public_path($folder2.$service->custom_breadcrumb_image));

        // Delete record
        $service->delete();

        return redirect()->route('service.index')
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
            return redirect()->route('service.create')
                ->with('warning', 'content.please_choose');
        }

        foreach ($arr_checked_lists as $id) {

            // Retrieve a model
            $service = Service::findOrFail($id);

            // Folder path
            $folder = 'uploads/img/service/';
            $folder2 = 'uploads/img/service/breadcrumb/';


            // Delete Image
            File::delete(public_path($folder.$service->service_image));
            File::delete(public_path($folder2.$service->custom_breadcrumb_image));

            // Delete record
            $service->delete();

        }

        return redirect()->route('service.index')
            ->with('success', 'content.deleted_successfully');
    }
}
