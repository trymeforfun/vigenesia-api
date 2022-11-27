<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motivasi extends Model
{
    use HasFactory;

    public $table = 'motivasi';

    const CREATED_AT = 'tanggal_input';
    const UPDATED_AT = 'tanggal_update';

    protected $guarded = ["id"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
