<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
        'birthdate',
        'school_origin',
        'age_category',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'birthdate' => 'date',
        ];
    }

     /**
     * Set the age_category based on the birthdate.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setAgeCategoryAttribute($value)
    {
        if ($this->birthdate) {
            $birthdate = Carbon::parse($this->birthdate);
            $age = $birthdate->age;

            // Tentukan kategori usia berdasarkan umur
            if ($age >= 0 && $age <= 12) {
                $this->attributes['age_category'] = 'Anak-anak'; 
            } elseif ($age >= 13 && $age <= 19) {
                $this->attributes['age_category'] = 'Remaja'; 
            } else {
                $this->attributes['age_category'] = 'Dewasa'; 
            }
        }
    }
}
