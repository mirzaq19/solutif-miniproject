<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;
    use UUID;

    protected $fillable = ['name', 'nim', 'gender','address','major','year'];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }
}
