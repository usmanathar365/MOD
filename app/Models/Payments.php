<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Payments extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    
    
    protected $table = 'payments';


    public function invoice()
    {
        return $this->belongsTo(Invoices::class,'invoice_id','id');
    }



}
