<?php

namespace Database\Seeders;

use App\Models\Admin\FrontendKeyword;
use Illuminate\Database\Seeder;

class FrontendKeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create datas
        FrontendKeyword::insert([
            [
                'language_id' => 1,
                'key' => 'home',
                'value' => 'Home',
            ],
            [
                'language_id' => 1,
                'key' => 'about_us',
                'value' => 'About Us',
            ],
            [
                'language_id' => 1,
                'key' => 'products',
                'value' => 'Products',
            ],
            [
                'language_id' => 1,
                'key' => 'services',
                'value' => 'Services',
            ],
            [
                'language_id' => 1,
                'key' => 'software',
                'value' => 'Software',
            ],
            [
                'language_id' => 1,
                'key' => 'blogs',
                'value' => 'Blogs',
            ],
            [
                'language_id' => 1,
                'key' => 'contact',
                'value' => 'Contact',
            ],
            [
                'language_id' => 1,
                'key' => 'pages',
                'value' => 'Pages',
            ],
            [
                'language_id' => 1,
                'key' => 'read_more',
                'value' => 'Read More',
            ],
            [
                'language_id' => 1,
                'key' => 'recent_posts',
                'value' => 'Recent Posts',
            ],
            [
                'language_id' => 1,
                'key' => 'share',
                'value' => 'Share',
            ],
            [
                'language_id' => 1,
                'key' => 'all',
                'value' => 'All',
            ],
            [
                'language_id' => 1,
                'key' => 'anonymous',
                'value' => 'Anonymous',
            ],
            [
                'language_id' => 1,
                'key' => 'name',
                'value' => 'Name',
            ],
            [
                'language_id' => 1,
                'key' => 'email',
                'value' => 'Email',
            ],
            [
                'language_id' => 1,
                'key' => 'subject',
                'value' => 'Subject',
            ],
            [
                'language_id' => 1,
                'key' => 'send_message',
                'value' => 'Send Message',
            ],
            [
                'language_id' => 1,
                'key' => 'address',
                'value' => 'Address',
            ],
            [
                'language_id' => 1,
                'key' => 'address_map_link',
                'value' => 'Address Map Link',
            ],
            [
                'language_id' => 1,
                'key' => 'email_and_phone',
                'value' => 'Email And Phone',
            ],
            [
                'language_id' => 1,
                'key' => 'search',
                'value' => 'Search',
            ],
            [
                'language_id' => 1,
                'key' => 'search_here',
                'value' => 'Search Here...',
            ],
            [
                'language_id' => 1,
                'key' => 'categories',
                'value' => 'Categories',
            ],
            [
                'language_id' => 1,
                'key' => 'tags',
                'value' => 'Tags',
            ],
            [
                'language_id' => 1,
                'key' => 'leave_a_comment',
                'value' => 'Leave A Comment',
            ],
            [
                'language_id' => 1,
                'key' => 'your_name',
                'value' => 'Your Name',
            ],
            [
                'language_id' => 1,
                'key' => 'your_email',
                'value' => 'Your Email',
            ],
            [
                'language_id' => 1,
                'key' => 'your_comment',
                'value' => 'Your Comment',
            ],
            [
                'language_id' => 1,
                'key' => 'send_comment',
                'value' => 'Send Comment',
            ],
            [
                'language_id' => 1,
                'key' => 'search_results',
                'value' => 'Search Results',
            ],
            [
                'language_id' => 1,
                'key' => 'nothing_found',
                'value' => 'Nothing Found',
            ],
            [
                'language_id' => 1,
                'key' => 'your_message_has_been_delivered',
                'value' => 'Your message has been delivered.',
            ],
            [
                'language_id' => 1,
                'key' => 'your_comment_is_pending_approval',
                'value' => 'Your comment is pending approval.',
            ],
            [
                'language_id' => 1,
                'key' => 'updating',
                'value' => 'Updating...',
            ],
            [
                'language_id' => 1,
                'key' => 'choose_subject',
                'value' => 'Choose Subject',
            ],
            [
                'language_id' => 1,
                'key' => 'other',
                'value' => 'Other',
            ],
            [
                'language_id' => 1,
                'key' => 'your_message',
                'value' => 'Your Message',
            ],
            [
                'language_id' => 1,
                'key' => 'lets_call_you',
                'value' => 'Let\'s Call You',
            ],
            [
                'language_id' => 1,
                'key' => 'monthly',
                'value' => 'Monthly',
            ],
            [
                'language_id' => 1,
                'key' => 'annually',
                'value' => 'Annually',
            ],
            [
                'language_id' => 1,
                'key' => 'onetime',
                'value' => 'Onetime',
            ],
            [
                'language_id' => 1,
                'key' => 'demo_request',
                'value' => 'Demo Request',
            ],
            [
                'language_id' => 1,
                'key' => 'your_phone',
                'value' => 'Your Phone',
            ],
            [
                'language_id' => 1,
                'key' => 'your_note',
                'value' => 'Your Note',
            ],
            [
                'language_id' => 1,
                'key' => 'try_it_free',
                'value' => 'Try It Free',
            ],
            [
                'language_id' => 1,
                'key' => 'see_all',
                'value' => 'See All',
            ],
            [
                'language_id' => 1,
                'key' => 'helper_links',
                'value' => 'Helper Links',
            ],
            [
                'language_id' => 1,
                'key' => 'contact_info',
                'value' => 'Contact Info',
            ],
            [
                'language_id' => 1,
                'key' => 'see_demo',
                'value' => 'See Demo',
            ],
            [
                'language_id' => 1,
                'key' => 'requirements',
                'value' => 'Requirements',
            ],
            [
                'language_id' => 1,
                'key' => 'demo_info',
                'value' => 'Demo Info',
            ],
            [
                'language_id' => 1,
                'key' => 'faqs',
                'value' => 'Faqs',
            ],
            [
                'language_id' => 1,
                'key' => 'via_whatsapp',
                'value' => 'Via Whatsapp',
            ],
            [
                'language_id' => 1,
                'key' => 'order_via_whatsapp',
                'value' => 'Order Via Whatsapp',
            ],
            [
                'language_id' => 1,
                'key' => 'order_info',
                'value' => 'Order Info',
            ],
            [
                'language_id' => 1,
                'key' => 'order_name',
                'value' => 'Order Name',
            ],
            [
                'language_id' => 1,
                'key' => 'order_url',
                'value' => 'Order Url',
            ],
            [
                'language_id' => 1,
                'key' => 'customer_info',
                'value' => 'Customer Info',
            ],
            [
                'language_id' => 1,
                'key' => 'phone',
                'value' => 'Phone',
            ],
            [
                'language_id' => 1,
                'key' => 'note',
                'value' => 'Note',
            ],
            [
                'language_id' => 1,
                'key' => 'back_to_homepage',
                'value' => 'Back To Homepage',
            ],
            [
                'language_id' => 1,
                'key' => 'i_am_online',
                'value' => 'I am Online',
            ],
            [
                'language_id' => 1,
                'key' => 'i_am_not_available_today',
                'value' => 'I am not available today.',
            ],
            [
                'language_id' => 1,
                'key' => 'call_now',
                'value' => 'Call Now',
            ]

            ]);
    }
}
