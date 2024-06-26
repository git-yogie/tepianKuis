<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $guard = ["id","created_at","update_at"];

    public function pesertaQuiz(){
        return $this->hasMany(pesertaQuiz::class,"id_peserta");
    }
}
