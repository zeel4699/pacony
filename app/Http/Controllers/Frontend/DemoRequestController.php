<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Breadcrumb;
use App\Models\Admin\ColorOption;
use App\Models\Admin\DemoRequest;
use App\Models\Admin\DemoRequestSection;
use App\Models\Admin\ExternalUrl;
use App\Models\Admin\GoogleAnalytic;
use App\Models\Admin\Page;
use App\Models\Admin\Service;
use App\Models\Admin\SiteInfo;
use App\Models\Admin\Social;
use App\Models\Admin\Software;
use App\Models\Admin\TawkTo;
use App\Models\Admin\WhatsappChat;
use Illuminate\Http\Request;

class DemoRequestController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
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

        $demo_request = DemoRequestSection::first();

        $service = Service::where('service_slug', '=', $slug)
            ->firstOrFail();


        return view('frontend.demo_request.show', compact('site_info', 'google_analytic', 'tawk_to',
            'whatsapp_chats', 'socials', 'external_url', 'color_option', 'breadcrumb', 'external_url',
            'header_pages', 'footer_pages', 'demo_request', 'slug', 'service'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_demo_software($slug)
    {
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

        $demo_request = DemoRequestSection::first();

        $software = Software::where('software_slug', '=', $slug)
            ->firstOrFail();

        return view('frontend.demo_request.show_demo_software', compact('site_info', 'google_analytic',
            'tawk_to', 'whatsapp_chats', 'socials', 'external_url', 'color_option', 'breadcrumb',
            'header_pages', 'footer_pages', 'external_url', 'demo_request', 'slug', 'software'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_demo_request_info()
    {
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


        return view('frontend.demo_request.show_demo', compact('site_info', 'google_analytic', 'tawk_to',
            'whatsapp_chats', 'socials', 'external_url', 'color_option', 'breadcrumb', 'header_pages', 'footer_pages'));
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
            'name'   =>  'required|max:255',
            'email'   =>  'required|max:255',
            'phone'   =>  'required|max:255',
        ]);

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

        // Get All Request
        $input = $request->all();

        // Model id/slug checking
        if (isset($input['hidden_service_slug'])) {
            $service = Service::where('service_slug', '=', $input['hidden_service_slug'])->firstOrFail();
            $software = null;
            $input['type'] = "service";
            $input['product_slug'] = $input['hidden_service_slug'];
        } else {
            $software = Software::where('software_slug', '=', $input['hidden_software_slug'])->firstOrFail();
            $service = null;
            $input['type'] = "software";
            $input['product_slug'] = $input['hidden_software_slug'];
        }

        // Record to database
        DemoRequest::firstOrCreate([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'note' => $input['note'],
            'type' => $input['type'],
            'product_slug' => $input['product_slug'],
        ]);

        return view('frontend.demo_request.show_demo', compact('site_info', 'google_analytic', 'tawk_to',
            'whatsapp_chats', 'socials', 'external_url', 'color_option', 'breadcrumb', 'header_pages',
            'footer_pages', 'service', 'software'));
    }


}

