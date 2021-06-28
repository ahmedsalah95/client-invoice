<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    //client function that define the relation between client and invoice tables

    public function client(){
        //invoice belngsTo one client
        return $this->belongsTo(Client::class);
    }

    protected $fillable=[
        'client_id',
        'amount'
    ];
}
