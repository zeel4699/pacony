<?php

namespace App\Models\Admin;

use App\Traits\Shareable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    use HasFactory;
    use Sluggable;
    use Shareable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'software_slug' => [
                'source' => 'title',
                'maxLength'          => null,
                'maxLengthKeepWords' => true,
                'method'             => null,
                'separator'          => '-',
                'unique'             => true,
                'uniqueSuffix'       => null,
                'includeTrashed'     => false,
                'reserved'           => null,
                'onUpdate'           => false
            ]
        ];
    }

    // Share social media
    protected $shareOptions = [
        'columns' => [
            'title' => 'title'
        ],
        'url' => null
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'language_id',
        'category_id',
        'category_name',
        'title',
        'desc',
        'software_feature_list',
        'server_requirement',
        'tag',
        'period',
        'monthly_price',
        'annually_price',
        'onetime_price',
        'tax_value',
        'demo_site_url',
        'demo_panel_url',
        'demo_other_info',
        'image_status',
        'software_image',
        'software_slug',
        'meta_desc',
        'meta_keyword',
        'breadcrumb_status',
        'custom_breadcrumb_image',
        'phone_number',
        'whatsapp_phone_number',
        'order',
        'status',
    ];

    public function software_category()
    {
        return $this->belongsTo('App\Models\Admin\SoftwareCategory','category_id','id');
    }
}
