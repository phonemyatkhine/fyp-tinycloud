<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoredData extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function folder() {
        return $this->belongsTo('App\Models\Folder','folder_id');
    }
    public function storage()
    {
        $folder = $this->folder;
        return $folder->storage();
    }
}
