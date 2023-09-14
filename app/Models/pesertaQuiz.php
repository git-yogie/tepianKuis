<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesertaQuiz extends Model
{
    use HasFactory;
    protected $guard = ["id","created_at","update_at"];

    public function peserta(){
        return $this->belongsTo(Peserta::class,"id_peserta");
    }
}
