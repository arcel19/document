<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;
    protected $fillable = [
        'document_id',
        'created_id',
        'assigned_id',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_id');
    }
}
