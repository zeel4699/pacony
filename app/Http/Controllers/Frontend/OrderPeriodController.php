<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Breadcrumb;
use App\Models\Admin\ColorOption;
use App\Models\Admin\Currency;
use App\Models\Admin\ExternalUrl;
use App\Models\Admin\GoogleAnalytic;
use App\Models\Admin\Page;
use App\Models\Admin\Service;
use App\Models\Admin\SiteInfo;
use App\Models\Admin\Social;
use App\Models\Admin\TawkTo;
use App\Models\Admin\WhatsappChat;
use Illuminate\Http\Request;

class OrderPeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
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

        // Get site language
        $language = getSiteLanguage();

        // Retrieving models
        $site_info = SiteInfo::where('language_id', $language->id)->first();
        $google_analytic = GoogleAnalytic::first();
        $tawk_to = TawkTo::first();
        $whatsapp_chats = WhatsappChat::where('language_id', $language->id)
            ->where('status', 'published')
            ->orderBy('order', 'asc')
            ->get();
        $socials = Social::where('status', 1)->get();
        $color_option = ColorOption::first();
        $breadcrumb = Breadcrumb::first();
        $external_url = ExternalUrl::where('language_id', $language->id)->first();
        $header_pages = Page::where('language_id', $language->id)
            ->where('display_header_menu', 1)
            ->where('status', 1)
            ->orderBy('order', 'asc')
            ->get();
        $footer_pages = Page::where('language_id', $language->id)
            ->where('display_header_menu', 0)
            ->where('status', 1)
            ->orderBy('order', 'asc')
            ->get();
        $service = Service::where('service_slug', $slug)->first();


        return view('frontend.order.special.period.show', compact('site_info','google_analytic', 'tawk_to',
            'whatsapp_chats',  'socials', 'color_option', 'external_url', 'header_pages', 'footer_pages', 'breadcrumb',
            'service', 'currency_symbol', 'currency_position', 'decimal_digit', 'decimal_separator', 'thousand_separator'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
