<?php

namespace App\Exports;

use App\Models\pesertaQuiz;
use Maatwebsite\Excel\Concerns\FromCollection;

class rekapExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $kuis;
    public function __construct($kuis)
    {
        $this->kuis = $kuis;
    }
    public function collection()
    {
        return pesertaQuiz::with("peserta")->where("kuis_code",$this->kuis)->get()->map(function($item){
            if($item->jawaban_kuis_cbt == "{}"){
                return [
                    "nama" => $item->peserta->nama,
                    "nis"=> $item->peserta->nis,
                    "email" => $item->peserta->email,
                    "nilai" => "belum mengerjakan",
                    "waktu selesai"=> $item->updated_at,
                ];
            }
            return [
                "nama" => $item->peserta->nama,
                "email" => $item->peserta->email,
                "nilai" => json_decode($item->jawaban_kuis_cbt)->nilai,
                "waktu selesai"=> $item->updated_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            "nama",
            "nis",
            "email",
            "nilai",
            "waktu selesai"
        ];
    }
}
