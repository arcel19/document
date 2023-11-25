<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
    ];

    public function assignedDocuments()
    {
        return $this->hasManyThrough(Document::class, Record::class, 'assigned_id', 'id', 'id', 'document_id'); // La relation pour les documents attribués à l'utilisateur
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'user_id'); // La relation pour les documents créés par l'utilisateur
    }

    public function createdRecords()
    {
        return $this->hasMany(Record::class, 'created_id');
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public static function logUserActivity($message)
    {
        $userId = Auth::id();
        $username = Auth::user()->name;
        $time = now();

        $logMessage = "[User ID: $userId | Username: $username| $message | $time";



        Log::info($logMessage);


        $filename = "user-activity/user_$userId.log";
        Storage::disk('local')->append($filename, $logMessage);


        // Save to Database
        $log = new LogHistory();
        $log->message = $logMessage = "[User ID: $userId | Username: $username] $message | $time";
        $log->save();
    }
}
