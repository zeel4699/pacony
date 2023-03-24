<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'user_id',
        'product_quantity',
        'selected_price',
        'type',
    ];

    public function service()
    {
        return $this->belongsTo('App\Models\Admin\Service','product_id','id');
    }

    public function software()
    {
        return $this->belongsTo('App\Models\Admin\Software','product_id','id');
    }
}
