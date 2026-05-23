<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneModel extends Model
{
    // Tambahkan baris ini di sini:
    protected $fillable = ['brand', 'model_name'];
}