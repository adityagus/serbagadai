<?php

namespace App\Models;

use App\Util\Constant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'role',
        'phone',
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

    const FORM_DETAIL = [
        'username' => 'Username',
        'email' => 'Email',
        'name' => 'Nama',
        'phone' => 'Telepon',
        'role' => 'Role',
    ];

    const exportData = [
        'username'=>'Username',
        'email'=>'Email',
        'name'=>'Name',
        'phone'=>'Phone',
        'role'=>'Role',
        'created_at'=>'Created',
        'updated_at'=>'Updated',
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
        ];
    }

    public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)
            ->where('users.deleted', 0);
    }

    public function scopeActive($query)
    {
        return $query->where('users.status', Constant::COMMON_STATUS_ACTIVE);
    }

    public function notification()
    {
        return $this->hasMany(Notification::class,'userId');
    }

    public function unreadNotifications()
    {
        return $this->notification()->where('status',Constant::NOTIFICATION_STATUS_UNREAD);
    }

    public function latestNotifications()
    {
        return $this->notification()->where('status',Constant::NOTIFICATION_STATUS_UNREAD)->limit(10)->orderBy('created_at','desc');
    }
}
