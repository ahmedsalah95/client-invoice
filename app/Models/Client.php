<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobile',
        'email',
        'name',

    ];
    //invoice function that define the relation between client and invoice tables
    public function invoice(){
        //client table has many invoices
        $this->hasMany(Invoice::class);
    }
}
