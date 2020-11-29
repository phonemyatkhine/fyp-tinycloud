<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

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

    public function getStoredData(){
        $data = new Collection;
        $folders = $this->folders;
        foreach ($folders as $key => $folder) {
            $data = $folder->stored_data;
        }
        // dd($data);
        return $data;
    }
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

}
