<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\Storage;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'company_id', 'email', 'phone', 'profile_picture'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Accessor for the profile picture path
    public function getProfilePicturePathAttribute()
    {
        return $this->profile_picture ? storage_path('app/private/' . $this->profile_picture) : null;
    }
}
