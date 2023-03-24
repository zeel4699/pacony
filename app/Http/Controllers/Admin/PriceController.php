<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Currency;
use App\Models\Admin\Price;
use App\Models\Admin\PriceSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PriceController extends Controller
{
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

        // Retrieving a model
        $language = getLanguage();
        $prices = Price::where('language_id', $language->id)->orderBy('id', 'desc')->get();
        $price_section = PriceSection::where('language_id', $language->id)->first();

        return view('admin.price.create', compact('prices', 'price_section',
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
            'package_name' => 'required',
            'period' => 'required|in:monthly,annually,onetime',
            'image_status'   =>  'in:show,hide',
            'price_image' => 'mimes:svg,png,jpeg,jpg|max:2048',
            'order' => 'required|integer',
            'status'   =>  'in:published,draft',
        ]);

        // Get All Request
        $input = $request->all();

        if($request->hasFile('price_image')){

            // Get image file
            $price_image_file = $request->file('price_image');

            // Folder path
            $folder = 'uploads/img/price/';

            // Make image name
            $price_image_name = time().'-'.$price_image_file->getClientOriginalName();

            // Original size upload file
            $price_image_file->move($folder, $price_image_name);

            // Set input
            $input['price_image']= $price_image_name;

        } else {
            // Set input
            $input['price_image']= null;
        }

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

        // Record to database
        Price::create([
            'language_id' => getLanguage()->id,
            'package_name' => $input['package_name'],
            'demo_link' => $input['period'],
            'image_status' => $input['image_status'],
            'price_image' => $input['price_image'],
            'period' => $input['period'],
            'monthly_price' => $input['monthly_price'],
            'annually_price' => $input['annually_price'],
            'onetime_price' => $input['onetime_price'],
            'feature_list' => $input['feature_list'],
            'non_feature_list' => $input['non_feature_list'],
            'tax_value' => $input['tax_value'],
            'order' => $input['order'],
            'status' => $input['status']
        ]);

        return redirect()->route('price.create')
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
        $price = Price::find($id);

        return view('admin.price.edit', compact('price',
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
            'package_name' => 'required',
            'period' => 'required|in:monthly,annually,onetime',
            'image_status'   =>  'in:show,hide',
            'price_image' => 'mimes:svg,png,jpeg,jpg|max:2048',
            'order' => 'required|integer',
            'status'   =>  'in:published,draft',
        ]);

        $price = Price::find($id);

        // Get All Request
        $input = $request->all();

        if($request->hasFile('price_image')){

            // Get image file
            $price_image_file = $request->file('price_image');

            // Folder path
            $folder = 'uploads/img/price/';

            // Make image name
            $price_image_name = time().'-'.$price_image_file->getClientOriginalName();

            // Delete Image
            File::delete(public_path($folder.$price->price_image));

            // Original size upload file
            $price_image_file->move($folder, $price_image_name);

            // Set input
            $input['price_image']= $price_image_name;

        }

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

        if ($input['monthly_price'] == "") {
            $input['monthly_price'] = null;
        }

        if ($input['annually_price'] == "") {
            $input['annually_price'] = null;
        }

        if ($input['onetime_price'] == "") {
            $input['onetime_price'] = null;
        }

        // Record to database
        Price::find($id)->update($input);

        return redirect()->route('price.create')
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
        $price = Price::find($id);

        // Folder path
        $folder = 'uploads/img/price/';

        // Delete Image
        File::delete(public_path($folder.$price->blog_image));

        // Delete record
        $price->delete();

        return redirect()->route('price.create')
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
            return redirect()->route('price.create')
                ->with('warning', 'content.please_choose');
        }

        foreach ($arr_checked_lists as $id) {

            // Retrieve a model
            $price = Price::findOrFail($id);

            // Folder path
            $folder = 'uploads/img/price/';

            // Delete Image
            File::delete(public_path($folder.$price->blog_image));

            // Delete record
            $price->delete();

        }

        return redirect()->route('price.create')
            ->with('success', 'content.deleted_successfully');
    }
}
