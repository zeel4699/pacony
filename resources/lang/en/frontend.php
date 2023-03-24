<?php


use App\Models\Admin\FrontendKeyword;
use App\Models\Admin\Language;


if (session()->has('language_id_from_dropdown')) {

    $language_id_from_dropdown = session()->get('language_id_from_dropdown');

    $frontend_keywords = FrontendKeyword::where('language_id', $language_id_from_dropdown)->get();


} else {

    $language = Language::where('default_site_language', 1)->first();

    $frontend_keywords = FrontendKeyword::where('language_id', $language->id)->get();

}


if (isset($frontend_keywords)) {

    $keywords = [];
    foreach ($frontend_keywords as $frontend_keyword) {
        $keywords += [$frontend_keyword->key => $frontend_keyword->value];
    }

    return $keywords;
}
else {

    return [

        /*
        |--------------------------------------------------------------------------
        | Pagination Language Lines
        |--------------------------------------------------------------------------
        |
        | The following language lines are used by the paginator library to build
        | the simple pagination links. You are free to change them to anything
        | you want to customize your views to better match your application.
        |
        */

        // Frontend One Group Keyword
        'home' => 'Home',
        'about_us' => 'About Us',
        'products' => 'Products',
        'services' => 'Services',
        'software' => 'Portfolio',
        'blogs' => 'Blogs',
        'contact' => 'Contact',
        'pages' => 'Pages',
        'read_more' => 'Read More',
        'recent_posts' => 'Recent Posts',
        'share' => 'Share',
        'all' => 'All',
        'anonymous' => 'Anonymous',
        'name' => 'Name',
        'email' => 'Email',
        'subject' => 'Subject',
        'message' => 'Message',
        'send_message' => 'Send Message',
        'address' => 'Address',
        'address_map_link' => 'Address Map Link',
        'email_and_phone' => 'Email And Phone',
        'search' => 'Search',
        'search_here' => 'Search Here...',
        'categories' => 'Categories',
        'tags' => 'Tags',
        'leave_a_comment' => 'Leave A Comment',
        'your_name' => 'Your Name',
        'your_email' => 'Your Email',
        'your_comment' => 'Your Comment',
        'send_comment' => 'Send Comment',
        'search_results' => 'Search Results',
        'nothing_found' => 'Nothing Found',
        'your_message_has_been_delivered' => 'Your message has been delivered.',
        'your_comment_is_pending_approval' => 'Your comment is pending approval.',
        'updating' => 'Updating...',
        'choose_subject' => 'Choose Subject',
        'other' => 'Other',
        'your_message' => 'Your Message',
        'lets_call_you' => 'Let\'s Call You',
        'monthly' => 'Monthly',
        'annually' => 'Annually',
        'onetime' => 'Onetime',
        'demo_request' => 'Demo Request',
        'your_phone' => 'Your Phone',
        'your_note' => 'Your Note',
        'try_it_free' => 'Try It Free',
        'see_all' => 'See All',
        'helper_links' => 'Helper Links',
        'contact_info' => 'Contact Info',
        'see_demo' => 'See Demo',
        'requirements' => 'Requirements',
        'demo_info' => 'Demo Info',
        'faqs' => 'Faqs',
        'via_whatsapp' => 'Via Whatsapp',
        'order_via_whatsapp' => 'Order Via Whatsapp',
        'order_info' => 'Order Info',
        'order_name' => 'Order Name',
        'order_url' => 'Order Url',
        'customer_info' => 'Customer Info',
        'phone' => 'Phone',
        'note' => 'Note',
        'back_to_homepage' => 'Back To Homepage',
        'i_am_online' => 'I am Online.',
        'i_am_not_available_today' => 'I am not available today.',
        'call_now' => 'Call Now',
        'demo_site' => 'Demo Site',
        'demo_panel' => 'Demo Panel',

    ];

}

