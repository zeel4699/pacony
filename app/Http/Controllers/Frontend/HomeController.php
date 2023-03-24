<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\About;
use App\Models\Admin\Blog;
use App\Models\Admin\BlogPaginate;
use App\Models\Admin\BlogSection;
use App\Models\Admin\Contact;
use App\Models\Admin\Currency;
use App\Models\Admin\ExternalUrl;
use App\Models\Admin\Faq;
use App\Models\Admin\FaqSection;
use App\Models\Admin\Feature;
use App\Models\Admin\FeatureInfoList;
use App\Models\Admin\FixedContent;
use App\Models\Admin\GoogleAnalytic;
use App\Models\Admin\HomepageVersion;
use App\Models\Admin\Page;
use App\Models\Admin\Partner;
use App\Models\Admin\PartnerSection;
use App\Models\Admin\Service;
use App\Models\Admin\ServiceSection;
use App\Models\Admin\SiteInfo;
use App\Models\Admin\Slider;
use App\Models\Admin\Social;
use App\Models\Admin\Software;
use App\Models\Admin\SoftwareSection;
use App\Models\Admin\TawkTo;
use App\Models\Admin\Testimonial;
use App\Models\Admin\TestimonialSection;
use App\Models\Admin\WhatsappChat;
use App\Models\Admin\WorkProcess;
use App\Models\Admin\WorkProcessSection;
use App\Models\Admin\InfoList;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get site language
        $language = getSiteLanguage();

        // Default values
        $blog_limit = 6;
        $faq_limit = 6;
        $service_limit = 6;
        $software_limit = 6;

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


        // Retrieve models
        $site_info = SiteInfo::where('language_id', $language->id)->first();
        $google_analytic = GoogleAnalytic::first();
        $tawk_to = TawkTo::first();
        $socials = Social::where('status', 1)->get();
        $external_url = ExternalUrl::where('language_id', $language->id)->first();
        $homepage_version = HomepageVersion::first();
        $sliders = Slider::where('language_id', $language->id)->orderBy('order', 'asc')->get();
        $fixed_content = FixedContent::where('language_id', $language->id)->first();
        $about = About::where('language_id', $language->id)->first();
        $info_lists = InfoList::where('language_id', $language->id)->orderBy('order', 'asc')->get();
        $work_process_section = WorkProcessSection::where('language_id', $language->id)->first();
        $work_processes = WorkProcess::where('language_id', $language->id)->orderBy('order', 'asc')->get();
        $feature = Feature::where('language_id', $language->id)->first();
        $feature_info_lists = FeatureInfoList::where('language_id', $language->id)->orderBy('order', 'asc')->get();
        $testimonial_section = TestimonialSection::where('language_id', $language->id)->first();
        $testimonials = Testimonial::where('language_id', $language->id)->orderBy('order', 'asc')->get();
        $partner_section = PartnerSection::where('language_id', $language->id)->first();
        $partners = Partner::where('language_id', $language->id)->orderBy('order', 'asc')->get();
        $blog_section = BlogSection::where('language_id', $language->id)->first();
        $blog_paginate = BlogPaginate::first();

        if (isset($blog_paginate)) {
            $blog_limit = $blog_paginate->homepage_item;
        }

        $recent_posts = Blog::join("categories", 'categories.id', '=', 'blogs.category_id')
            ->where('categories.language_id', $language->id)
            ->where('categories.status', 1)
            ->where('blogs.status', 'published')
            ->orderBy('blogs.order', 'asc')
            ->take($blog_limit)
            ->get();

        $faq_section = FaqSection::where('language_id', $language->id)->first();

        if (isset($faq_section)) {
            $faq_limit = $faq_section->item_count;
        }

        $faqs = Faq::where('language_id', $language->id)->orderBy('order', 'asc')
            ->take($faq_limit)
            ->get();

        $service_section = ServiceSection::where('language_id', $language->id)->first();

        if (isset($service_section)) {
            $service_limit = $service_section->homepage_item_count;
        }

        $services = Service::where('language_id', $language->id)
            ->where('status', 'published')
            ->orderBy('order', 'asc')
            ->take($service_limit)
            ->get();

        $software_section = SoftwareSection::where('language_id', $language->id)->first();

        if (isset($software_section)) {
            $software_limit = $software_section->homepage_item_count;
        }

        $softwares = Software::join("software_categories", 'software_categories.id', '=', 'software.category_id')
            ->where('software_categories.language_id', $language->id)
            ->where('software_categories.status', 1)
            ->where('software.status', 'published')
            ->orderBy('software.order', 'asc')
            ->take($software_limit)
            ->get();

        $contact = Contact::where('language_id', $language->id)->first();

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

        $whatsapp_chats = WhatsappChat::where('language_id', $language->id)
            ->where('status', 'published')
            ->orderBy('order', 'asc')
            ->get();


        return view('frontend.home.index', compact('site_info', 'google_analytic', 'tawk_to', 'socials', 'external_url',
            'homepage_version', 'sliders', 'fixed_content', 'about', 'info_lists', 'work_process_section', 'work_processes', 'feature',
            'feature_info_lists', 'testimonial_section', 'testimonials', 'partner_section', 'partners',
            'blog_section', 'recent_posts', 'faq_section', 'faqs', 'service_section', 'services',
            'software_section', 'softwares', 'contact', 'header_pages', 'footer_pages', 'whatsapp_chats',
            'currency_symbol', 'currency_position', 'decimal_digit', 'decimal_separator', 'thousand_separator'));
    }

}
