<?php

namespace Database\Seeders;

use App\Models\Admin\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Create datas
        Section::create([
            'title' => 'About Us Section',
            'section' => 'about_us_section',
            'status' => 'show'
        ]);

        // Create datas
        Section::create([
            'title' => 'Work Process Section',
            'section' => 'work_process_section',
            'status' => 'show'
        ]);

        // Create datas
        Section::create([
            'title' => 'Feature Section',
            'section' => 'feature_section',
            'status' => 'show'
        ]);

        // Create datas
        Section::create([
            'title' => 'Testimonial Section',
            'section' => 'testimonial_section',
            'status' => 'show'
        ]);

        // Create datas
        Section::create([
            'title' => 'Contact Section',
            'section' => 'contact_section',
            'status' => 'show'
        ]);

        // Create datas
        Section::create([
            'title' => 'Partner Section',
            'section' => 'partner_section',
            'status' => 'show'
        ]);

        // Create datas
        Section::create([
            'title' => 'Footer Section',
            'section' => 'footer_section',
            'status' => 'show'
        ]);

        // Create datas
        Section::create([
            'title' => 'Scroll Top Button',
            'section' => 'scroll_top_btn',
            'status' => 'show'
        ]);

        // Create datas
        Section::create([
            'title' => 'Pages Page',
            'section' => 'pages_page',
            'status' => 'show'
        ]);

        // Create datas
        Section::create([
            'title' => 'Service Page',
            'section' => 'service_page',
            'status' => 'show'
        ]);

        // Create datas
        Section::create([
            'title' => 'Software Page',
            'section' => 'software_page',
            'status' => 'show'
        ]);

        // Create datas
        Section::create([
            'title' => 'Blog Page',
            'section' => 'blog_page',
            'status' => 'show'
        ]);

        // Create datas
        Section::create([
            'title' => 'Faq Page',
            'section' => 'faq_page',
            'status' => 'show'
        ]);

        // Create datas
        Section::create([
            'title' => 'Whatsapp Button',
            'section' => 'whatsapp_button',
            'status' => 'show'
        ]);

        // Create datas
        Section::create([
            'title' => 'Tawk To Button',
            'section' => 'tawk_to_button',
            'status' => 'show'
        ]);

        // Create datas
        Section::create([
            'title' => 'Preloader',
            'section' => 'preloader',
            'status' => 'show'
        ]);



    }
}
