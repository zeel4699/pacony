<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'language_id',
        'package_name',
        'demo_link',
        'image_status',
        'price_image',
        'period',
        'monthly_price',
        'annually_price',
        'onetime_price',
        'feature_list',
        'non_feature_list',
        'tax_value',
        'order',
        'status',
    ];
}
