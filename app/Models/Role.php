<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_name',
        'status',
    ];

    /**
     * Quan hệ với User (nếu có): Một role có thể gán cho nhiều người dùng.
     * Kích hoạt nếu bạn có cột 'role_id' trong bảng users.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
