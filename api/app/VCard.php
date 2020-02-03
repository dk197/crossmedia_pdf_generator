<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VCard extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'position', 'firma', 'adresse', 'telefon_privat', 'telefon_geschaeftlich', 'email', 'webseite'
    ];
}
