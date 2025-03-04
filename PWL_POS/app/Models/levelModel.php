<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class levelModel extends Model
{
    protected $table = 'm_level';  // Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'level_id';  // Mendefinisikan primary key dari tabel yang digunakan

    public function user(): HasOne
    {
        return $this->hasOne(UserModel::class, 'level_id', 'level_id');
    }
}
