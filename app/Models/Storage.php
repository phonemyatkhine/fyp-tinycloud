<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Storage extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'total_space',
        'used_space',
        'type',
        'path'
    ];
    public function folders() {
        return $this->hasMany('App\Models\Folder');
    }
}
