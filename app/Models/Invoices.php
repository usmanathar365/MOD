<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoices extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $guarded = [];

    protected $table = 'invoice';
      
    public function items()
    {
        return $this->hasMany(InvoiceItems::class,'invoice_id','id');
    }

    public function taxes()
    {
        return $this->hasMany(Taxes::class,'invoice_id','id');
    }

    public function brand()
    {
        return $this->belongsTo(Brands::class,'brand_id','id');
    }


    public function client()
    {
        return $this->belongsTo(Clients::class,'client_id','id');
    }



    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }



    public function payment_methods()
    {
        return $this->belongsTo(PaymentMethods::class,'payment_method','id');
    }



}
