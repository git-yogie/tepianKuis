<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $guarded = ["id","created_at","update_at"];


    public function soal(){
        return $this->hasMany(Soal::class,"id_kuis");
    }

    public function peserta(){
        return $this->hasMany(pesertaQuiz::class,"id_kuis");
    }



}
