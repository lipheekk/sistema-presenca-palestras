<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Palestra extends Model
{
    protected $fillable = ['titulo', 'palestrante', 'data', 'local', 'descricao'];

    protected $casts = ['data' => 'datetime'];
}
