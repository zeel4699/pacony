<?php

use App\Models\Admin\Language;
use App\Models\Admin\PanelKeyword;


if (session()->has('language_id_from_dropdown')) {

    $language_id_from_dropdown = session()->get('language_id_from_dropdown');

    $panel_keywords = PanelKeyword::where('language_id', $language_id_from_dropdown)->get();

} else {

    $language = Language::where('default_site_language', 1)->first();

    $panel_keywords = PanelKeyword::where('language_id', $language->id)->get();

}

if (isset($panel_keywords)) {

    $keywords = [];
    foreach ($panel_keywords as $panel_keyword) {
        $keywords += [$panel_keyword->key => $panel_keyword->value];
    }

    return $keywords;

} else {

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

        /* Content Group 1 */
        'admin_role_manage' => 'Admin Role Manage',
        'add_admin_role' => 'Add Admin Role',
        'role_name' => 'Role Name',
        'permissions' => 'Permissions',
        'set_permissions_for_this_role' => 'set permissions for this role',
        'submit' => 'Submit',
        'admin_roles' => 'Admin Roles',
        'has_all_permissions' => 'has all permissions',
        'action' => 'Action',
        'edit_admin_role' => 'Edit Admin Role',
        'admin_manage' => 'Admin Manage',
        'all_admin' => 'All Admin',
        'all_admin_created_by_super_admin' => 'All Admin Created By Super Admin',
        'add_admin_user' => 'Add Admin User',
        'edit_admin_user' => 'Edit Admin User',
        'name' => 'Name',
        'email' => 'Email',
        'new_password' => 'New Password',
        'confirm_password' => 'Confirm Password',
        'image' => 'Image',
        'size' => 'size',
        'delete' => 'Delete',
        'close' => 'Close',
        'you_wont_be_able_to_revert_this' => 'You wont be able to revert this!',
        'cancel' => 'Cancel',
        'yes_delete_it' => 'Yes, delete it!',
        'created_successfully' => 'Created Successfully.',
        'updated_successfully' => 'Updated Successfully.',
        'deleted_successfully' => 'Deleted Successfully.',
        'current_image' => 'Current Image',
        'dashboard' => 'Dashboard',
        'uploads' => 'Uploads',
        'add_photo' => 'Add Photo',
        'photos' => 'Photos',
        'order' => 'Order',
        'copy_image_link' => 'Copy Image Link',
        'edit_photo' => 'Edit Photo',
        'demo_requests' => 'Demo Requests',
        'note' => 'Note',
        'demo_request_section' => 'Demo Request Section',
        'title' => 'Title',
        'description' => 'Description',
        'please_use_recommended_sizes' => 'You do not have to use the recommended sizes. However, please use the recommended sizes for your site design to look its best.',
        'image_status' => 'Image Status',
        'blogs' => 'Blogs',
        'categories' => 'Categories',
        'add_category' => 'Add Category',
        'edit_category' => 'Edit Category',
        'category_name' => 'Category Name',
        'please_choose' => 'Please choose',
        'please_create_a_category' => 'Please create a category.',
        'status' => 'Status',
        'select_your_option' => 'Select Your Option',
        'not_yet_created' => 'Not yet created.',
        'category' => 'Category',
        'post_date' => 'Post Date',
        'view' => 'View',
        'add_blog' => 'Add Blog',
        'edit_blog' => 'Edit Blog',
        'short_desc' => 'Short Description',
        'tag' => 'Tag',
        'separate_with_commas' => 'Separate with commas',
        'author' => 'Author',
        'with_this_account' => 'With this account',
        'anonymous' => 'Anonymous',
        'seo_optimization' => 'Seo Optimization',
        'meta_desc' => 'Meta Description',
        'meta_keyword' => 'Meta Keyword',
        'breadcrumb_customization' => 'Breadcrumb Customization',
        'use_special_breadcrumb' => 'Do you want to use special breadcrumb for the page?',
        'yes' => 'Yes',
        'no' => 'No',
        'custom_breadcrumb_image' => 'Custom Breadcrumb Image',
        'published' => 'Published',
        'draft' => 'Draft',
        'blog_paginate' => 'Blog Paginate',
        'homepage_item' => 'Homepage Item',
        'grid_view_paginate' => 'Grid View Paginate',
        'section_title' => 'Section Title',
        'section_title_and_desc' => 'Section Title/Description',
        'add_new' => 'Add New',
        'homepage_item_count' => 'Homepage Item Count',
        'paginate' => 'Paginate',
        'services' => 'Services',
        'add_service' => 'Add Service',
        'edit_service' => 'Edit Service',
        'all' => 'All',
        'service_name' => 'Service Name',
        'period' => 'Period',
        'price' => 'Price',
        'demo_url' => 'Demo Url',
        'demo_admin_url' => 'Demo Admin Url',
        'demo_other_info' => 'Demo Other Info',
        'choose_a_plan' => 'Please do not forget to set the service for the period you choose. The selected plan cannot be disabled.',
        'monthly' => 'Monthly',
        'annually' => 'Annually',
        'onetime' => 'Onetime',
        'monthly_price' => 'Monthly Price',
        'annually_price' => 'Annually Price',
        'onetime_price' => 'Onetime Price',
        'feature_list' => 'Feature List',
        'non_feature_list' => 'Non Feature List',
        'tax_value' => 'Tax Value',
        'add_more' => 'Add More',
        'software' => 'Software',
        'enable' => 'Enable',
        'disable' => 'Disable',
        'back' => 'Back',
        'add_software' => 'Add Software',
        'edit_software' => 'Edit Software',
        'software_feature_list' => 'Software Feature List',
        'server_requirements' => 'Server Requirements',
        'tags' => 'Tags',
        'demo_site_url' => 'Demo Site Url',
        'demo_panel_url' => 'Demo Panel Url',
        'external_url' => 'External Url',
        'btn_name' => 'Button Name',
        'btn_url' => 'Button Url',
        'banner' => 'Banner',
        'fixed_content' => 'Fixed Content',
        'about' => 'About',
        'information_list' => 'Information List',
        'add_info' => 'Add Info',
        'edit_info' => 'Edit Info',
        'type' => 'Type',
        'icon' => 'Icon',
        'work_process' => 'Work Process',
        'add_work_process' => 'Add Work Process',
        'edit_work_process' => 'Edit Work Process',
        'features' => 'Features',
        'testimonials' => 'Testimonials',
        'add_testimonial' => 'Add Testimonial',
        'edit_testimonial' => 'Edit Testimonial',
        'job' => 'Job',
        'star' => 'Star',
        'partners' => 'Partners',
        'add_partner' => 'Add Partner',
        'edit_partner' => 'Edit Partner',
        'faqs' => 'Faqs',
        'add_faq' => 'Add Faq',
        'edit_faq' => 'Edit Faq',
        'question' => 'Question',
        'answer' => 'Answer',
        'currency' => 'Currency',
        'example' => 'Example',
        'currency_position' => 'Currency Position',
        'left' => 'Left',
        'right' => 'Right',
        'or' => 'Or',
        'decimal_digit' => 'Decimal Digit',
        'decimal_separator' => 'Decimal Separator',
        'thousand_separator' => 'Thousand Separator',
        'dot' => 'Dot',
        'comma' => 'Comma',
        'space' => 'Space',
        'pages' => 'Pages',
        'add_page' => 'Add Page',
        'edit_page' => 'Edit Page',
        'display_header_menu' => 'Display Header Menu?',
        'other' => 'Other',
        'copy_link' => 'Copy Link',
        'copied_text' => 'Copied Text:',
        'if_you_choose_no' => 'If you choose No, it will appear in the footer section.',
        'if_you_choose_other' => 'If you choose the other, you\'ll know how to create links that you can use on your site.',
        'contact' => 'Contact',
        'contact_info' => 'Contact Info',
        'map_iframe' => 'Map Iframe (link in src)',
        'map_iframe_desc_placeholder' => 'Please find your address on Google Map. And click the Share Button on the Left Side. You will see the Map Placement Area. In the Copy Html field in this section Copy and paste the link in the src from the code inside.',
        'add_contact' => 'Add Contact',
        'edit_contact' => 'Edit Contact',
        'socials' => 'Socials',
        'add_social' => 'Add Social',
        'edit_social' => 'Edit Social',
        'url' => 'Url',
        'messages' => 'Messages',
        'mark_all_as_read' => 'Mark All As Read',
        'subject' => 'Subject',
        'message' => 'Message',
        'read_status' => 'Read Status',
        'read' => 'Read',
        'unread' => 'Unread',
        'mark' => 'Mark',
        'settings' => 'Settings',
        'site_info' => 'Site Info',
        'site_images' => 'Site Images',
        'copyright' => 'Copyright',
        'address' => 'Address',
        'address_map_link' => 'Address Map Link',
        'phone' => 'Phone',
        'favicon' => 'Favicon',
        'admin_logo' => 'Admin Logo',
        'admin_small_logo' => 'Admin Small Logo',
        'site_colored_logo' => 'Site Colored Logo',
        'google_analytic' => 'Google Analytic',
        'breadcrumb' => 'Breadcrumb',
        'sections' => 'Sections',
        'seo' => 'Seo',
        'site_name' => 'Site Name',
        'site_desc' => 'Site Description',
        'site_keywords' => 'Site Keywords',
        'languages' => 'Languages',
        'default_site_language' => 'Default Site Language',
        'add_language' => 'Add Language',
        'language_name' => 'Language Name',
        'language_code' => 'Language Code',
        'direction' => 'Direction',
        'display_dropdown' => 'Display Dropdown?',
        'show' => 'Show',
        'hide' => 'Hide',
        'keywords' => 'Keywords',
        'for_admin_panel' => 'For Admin Panel',
        'for_frontend' => 'For Frontend',
        'profile' => 'Profile',
        'change_password' => 'Change Password',
        'current_password' => 'Current Password',
        'pending_approval' => 'Pending Approval',
        'approval' => 'Approval',
        'data_language' => 'Data Language',
        'which_language' => 'Which language do you want to create the data?',
        'reminding' => 'Please note that all the entries you create will be based on your chosen language.',
        'notifications' => 'Notifications',
        'logout' => 'Logout',
        'optimizer' => 'Optimizer',
        'required_fields' => 'Fields marked are required',
        'site' => 'Site',
        'add_keyword' => 'Add Keyword',
        'key' => 'Key',
        'value' => 'Value',
        'delete_selected' => 'Delete selected?',
        'comments' => 'Comments',
        'homepage_versions' => 'Homepage Versions',
        'order_mode' => 'Order Mode',
        'with_free_trial' => 'With Free Trial',
        'about_us_section' => 'About Us Section',
        'work_process_section' => 'Work Process Section',
        'feature_section' => 'Feature Section',
        'testimonial_section' => 'Testimonial Section',
        'contact_section' => 'Contact Section',
        'partner_section' => 'Partner Section',
        'footer_section' => 'Footer Section',
        'scroll_top_btn' => 'Scroll Top Button',
        'pages_page' => 'Pages Page',
        'service_page' => 'Service Page',
        'software_page' => 'Software Page',
        'blog_page' => 'Blog Page',
        'faq_page' => 'Faq Page',
        'preloader' => 'Preloader',
        'whatsapp_order_requests' => 'Whatsapp Order Requests',
        'via_whatsapp' => 'Via Whatsapp',
        'required_for_order' => 'Required For Order',
        'whatsapp_phone_number' => 'Whatsapp Phone Number',
        'sliders' => 'Sliders',
        'add_slider' => 'Add Slider',
        'edit_slider' => 'Edit Slider',
        'with_your_country_phone_code' => 'With your country\'s phone code.',
        'phone_number' => 'Phone Number',
        'tawk_to' => 'Tawk To',
        'whatsapp_chat' => 'Whatsapp Chat',
        'add_whatsapp_chat' => 'Add Whatsapp Chat',
        'edit_whatsapp_chat' => 'Edit Whatsapp Chat',
        'accessibility' => 'Accessibility',
        'online' => 'Online',
        'offline' => 'Offline',

    ];

}


