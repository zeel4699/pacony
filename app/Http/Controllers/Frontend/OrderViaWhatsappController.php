<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Breadcrumb;
use App\Models\Admin\ColorOption;
use App\Models\Admin\Currency;
use App\Models\Admin\ExternalUrl;
use App\Models\Admin\GoogleAnalytic;
use App\Models\Admin\OrderViaWhatsapp;
use App\Models\Admin\Page;
use App\Models\Admin\Service;
use App\Models\Admin\SiteInfo;
use App\Models\Admin\Social;
use App\Models\Admin\Software;
use App\Models\Admin\TawkTo;
use App\Models\Admin\WhatsappChat;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;

class OrderViaWhatsappController extends Controller
{
    const stage_1 = 'frontend.order_info';
    const stage_2 = 'frontend.order_name';
    const stage_3 = 'frontend.order_url';
    const stage_4 = 'frontend.customer_info';
    const stage_5 = 'frontend.name';
    const stage_6 = 'frontend.email';
    const stage_7 = 'frontend.phone';
    const stage_8 = 'frontend.note';
    const stage_9 = 'frontend.back_to_homepage';

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


        $service = Service::where('service_slug', '=', $slug)->first();

        $software = Software::where('software.software_slug', '=', $slug)
            ->first();

        return view('frontend.order_via_whatsapp.show', compact('site_info', 'google_analytic', 'tawk_to',
            'whatsapp_chats', 'socials', 'color_option', 'breadcrumb', 'external_url', 'header_pages', 'footer_pages',
            'slug', 'service', 'software',
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
        $order_info = trans(self::stage_1);
        $order_name = trans(self::stage_2);
        $order_url = trans(self::stage_3);
        $customer_info = trans(self::stage_4);
        $name = trans(self::stage_5);
        $email = trans(self::stage_6);
        $phone = trans(self::stage_7);
        $note = trans(self::stage_8);
        $back_to_homepage = trans(self::stage_9);

        $agent = new Agent();

        if ($agent->isMobile() || $agent->isTablet()) {
            $whatsAppUrl = "https://api.whatsapp.com/send";
        } else {
            $whatsAppUrl = "https://web.whatsapp.com/send";
        }


        // Form validation
        $request->validate([
            'name'   =>  'required|max:255',
            'email'   =>  'required|max:255',
            'phone'   =>  'required|max:255',
        ]);

        // Get All Request
        $input = $request->all();

        $home = route('homepage');


        // Model id/slug checking
        if (isset($input['hidden_service_slug'])) {
            $service = Service::where('service_slug', '=', $input['hidden_service_slug'])->firstOrFail();
            $software = null;
            $input['type'] = "service";
            $input['product_slug'] = $input['hidden_service_slug'];
            $service_url = route('service-page.show',$input['product_slug']);
            $url = "$whatsAppUrl?phone=".
                $service->whatsapp_phone_number."&text=*$order_info*%0a$order_name: $service->service_name%0a$order_url: $service_url%0a*$customer_info*%0a*$name*: ".$input['name']."%0a*$email*: ".$input['email']."%0a*$phone*: ".$input['phone']."%0a*$note*: ".$input['note']."%0a%0a%0a$back_to_homepage: $home";
        } else {
            $software = Software::where('software_slug', '=', $input['hidden_software_slug'])->firstOrFail();
            $service = null;
            $input['type'] = "software";
            $input['product_slug'] = $input['hidden_software_slug'];
            $software_url = route('software-page.show',$input['product_slug']);
            $url = "$whatsAppUrl?phone=".
                $software->whatsapp_phone_number."&text=*$order_info*%0a$order_name: $software->title%0a$order_url: $software_url%0a*$customer_info*%0a*$name*: ".$input['name']."%0a*$email*: ".$input['email']."%0a*$phone*: ".$input['phone']."%0a*$note*: ".$input['note']."%0a%0a%0a$back_to_homepage: $home";

        }

        // Record to database
        OrderViaWhatsapp::firstOrCreate([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'note' => $input['note'],
            'type' => $input['type'],
            'product_slug' => $input['product_slug'],
        ]);


        return redirect()->to($url);
    }
}
