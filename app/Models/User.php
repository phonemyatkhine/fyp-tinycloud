<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function storages()
    {
        return $this->hasMany('App\Models\Storage');
    }
    // public function shared_folders()
    // {
    //     $storages = $this->storages();
    //     $storage
    // }
    public function collaborators() {
        return $this->hasMany('App\Models\Collaborators');
    }
    public function payment_details() {
        return $this->hasOne('App\Models\PaymentDetails');
    }
    // public function teams_user() {
    //     return $this->hasMany('App\Models\TeamUser');
    // }

    public function getSharedFolders() {
        $data = [ ];
        $shared_folders = $this->collaborators;
        foreach ($shared_folders as $shared_folder) {
            if($shared_folder->verified) {
              $data[] = $shared_folder;
            }
        }
        return $data;
    }
    // public function getTeams() {
    //     $teams = $this->teams_user;
    //     return $teams;
    // }

    public function pendingSharedFolders() {
        $data = [];
        $shared_folders = $this->collaborators;
        foreach ($shared_folders as $key => $shared_folder) {
            if(!$shared_folder->verified) {
                $data[] = $shared_folder;
            }
        }
        return $data;
    }
}