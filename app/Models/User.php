<?php
// app/Models/User.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Passwords\CanResetPassword;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable,HasFactory,CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     *
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the todos for the user.
     */
    public function todos()
    {
        return $this->hasMany(Todo::class);
    }
}
