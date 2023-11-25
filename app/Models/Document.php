<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Record;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['name','path', 'user_id'];

    public function file(): HasMany
    {
        return $this->hasMany(File::class);
    }
    public function records()
{
    return $this->hasMany(Record::class);
}
}
