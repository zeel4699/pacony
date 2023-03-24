<?php

namespace App\Models\Admin;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'service_slug' => [
                'source' => 'service_name',
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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'language_id',
        'service_name',
        'demo_url',
        'demo_admin_url',
        'demo_other_info',
        'image_status',
        'service_image',
        'period',
        'monthly_price',
        'annually_price',
        'onetime_price',
        'feature_list',
        'non_feature_list',
        'tax_value',
        'whatsapp_phone_number',
        'order',
        'service_slug',
        'meta_desc',
        'meta_keyword',
        'breadcrumb_status',
        'custom_breadcrumb_image',
        'status',
    ];
}
