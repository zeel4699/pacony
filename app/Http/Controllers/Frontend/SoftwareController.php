<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Breadcrumb;
use App\Models\Admin\Currency;
use App\Models\Admin\ExternalUrl;
use App\Models\Admin\GoogleAnalytic;
use App\Models\Admin\OrderMode;
use App\Models\Admin\Page;
use App\Models\Admin\SiteInfo;
use App\Models\Admin\Social;
use App\Models\Admin\Software;
use App\Models\Admin\SoftwareCategory;
use App\Models\Admin\SoftwareSection;
use App\Models\Admin\TawkTo;
use App\Models\Admin\WhatsappChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $grid_view_paginate_limit = 9;

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
        $external_url = ExternalUrl::where('language_id', $language->id)->first();
        $breadcrumb = Breadcrumb::first();
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

        $software_section = SoftwareSection::where('language_id', $language->id)->first();

        if (isset($software_section)) {
            $grid_view_paginate_limit = $software_section->paginate;
        }

        $softwares = Software::join("software_categories", 'software_categories.id', '=', 'software.category_id')
            ->where('software_categories.language_id', $language->id)
            ->where('software_categories.status', 1)
            ->where('software.status', 'published')
            ->orderBy('software.id', 'desc')
            ->paginate($grid_view_paginate_limit);

        $software_count_categories = Software::select(DB::raw('count(*) as category_count, category_id'))
            ->where('language_id', $language->id)
            ->where('software.status', 'published')
            ->groupBy('category_id')
            ->get();

        return view('frontend.software.index', compact(  'site_info', 'google_analytic', 'tawk_to', 'whatsapp_chats',
            'socials', 'external_url', 'breadcrumb', 'softwares', 'software_count_categories', 'header_pages', 'footer_pages',
            'currency_symbol', 'currency_position', 'decimal_digit', 'decimal_separator', 'thousand_separator'));
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
        $external_url = ExternalUrl::where('language_id', $language->id)->first();
        $breadcrumb = Breadcrumb::first();
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

        $software = Software::where('software.software_slug', '=', $slug)
            ->firstOrFail();

        $order_mode = OrderMode::first();


        return view('frontend.software.show', compact('site_info', 'google_analytic', 'tawk_to', 'whatsapp_chats',
            'socials', 'external_url', 'breadcrumb', 'software', 'order_mode', 'header_pages', 'footer_pages',
            'currency_symbol', 'currency_position', 'decimal_digit', 'decimal_separator', 'thousand_separator'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $category_name
     * @return \Illuminate\Http\Response
     */
    public function category_show($category_name)
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
        $external_url = ExternalUrl::where('language_id', $language->id)->first();
        $breadcrumb = Breadcrumb::first();
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

        $softwares = Software::join("software_categories", 'software_categories.id', '=', 'software.category_id')
            ->where('software_categories.language_id', $language->id)
            ->where('software_categories.software_category_slug', '=', $category_name)
            ->where('software.status', 'published')
            ->orderBy('software.id', 'desc')
            ->get();

        $category = SoftwareCategory::where('language_id', $language->id)
            ->where('software_category_slug', '=', $category_name)->first();

        if (count($softwares) < 1) {
            abort(404);
        }

        $software_count_categories = Software::select(DB::raw('count(*) as category_count, category_id'))
            ->where('language_id', $language->id)
            ->where('software.status', 'published')
            ->groupBy('category_id')
            ->get();

        return view('frontend.software.category-show', compact('site_info', 'google_analytic', 'tawk_to', 'whatsapp_chats',
            'socials', 'external_url', 'breadcrumb', 'category', 'category_name', 'software_count_categories', 'softwares',
            'header_pages', 'footer_pages',
            'currency_symbol', 'currency_position', 'decimal_digit', 'decimal_separator', 'thousand_separator'));

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
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
        $external_url = ExternalUrl::where('language_id', $language->id)->first();
        $breadcrumb = Breadcrumb::first();
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

        // Search
        $search = $request->get('search');

        $softwares = Software::join("software_categories",'software_categories.id', '=', 'software.category_id')
            ->where('software_categories.language_id', $language->id)
            ->where('software_categories.status', 1)
            ->where('software.status', 'published')
            ->where('title', 'like', '%'.$search.'%')
            ->orderBy('software.id', 'desc')
            ->get();

        $software_count_categories = Software::select(DB::raw('count(*) as category_count, category_id'))
            ->where('language_id', $language->id)
            ->where('software.status', 'published')
            ->groupBy('category_id')
            ->get();


        return view('frontend.software.search-index', compact ('site_info', 'tawk_to', 'whatsapp_chats',
            'google_analytic', 'socials', 'external_url', 'breadcrumb', 'softwares', 'software_count_categories',
              'header_pages', 'footer_pages',
              'currency_symbol', 'currency_position', 'decimal_digit', 'decimal_separator', 'thousand_separator'));
    }

}
