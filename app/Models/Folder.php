<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'storage_id',
        'privacy',
        'path'
    ];

    public function stored_data () {
        return $this->hasMany('App\Models\StoredData');
    }
    public function storage() {
        return $this->belongsTo('App\Models\Storage');
    }


}
