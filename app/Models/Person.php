<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $guard_name = 'api';
    protected $table = "Persons";

    protected $fillable = [
        'personName'
        , 'personMiddleName'
        , 'personLastName'
        , 'typeDocument'
        , 'document'
        , 'email'
        , 'cellPhone'
    ];
}
