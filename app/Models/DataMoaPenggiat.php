<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMoaPenggiat extends Model
{
    protected $table = 'data_moa_penggiat';
    protected $guarded = [];
    use HasFactory;

    public function cekid()
    {
        return $this->belongsTo(DataMoa::class, 'id_lapkerma');
    }

    public function getDataMoa()
    {
            return $this->hasOne(DataMoa::class, 'id', 'id_lapkerma');
    }

    public static function countBadanKemitraan($kemitraan=null,$year=null,$fakultas=null,$prodi=null)
    {
        $data = self::when($kemitraan, function ($query) use ($kemitraan) {
            $query->where('badan_kemitraan', $kemitraan);
        })->whereHas('getDataMoa', function ($query) use ($year,$fakultas,$prodi) {
            $query->when($year, function ($query) use ($year) {
                $query->whereYear('tanggal_awal', $year);
            });
            $query->when($fakultas, function ($query) use ($fakultas) {
                $query->where('fakultas_pihak', $fakultas);
            });
            $query->when($prodi, function ($query) use ($prodi) {
                $query->where('prodi_id', $prodi);
            });
        })
        ->select('nama_pihak')
        ->groupBy('nama_pihak')
        ->get();
        // dd($data);

        return $data;
    }

    public static function countPerguruanTinggi($pt=null,$year=null,$fakultas=null,$prodi=null)
    {
        $data = self::when($pt, function ($query) use ($pt) {
            $query->whereIn('status_pihak', $pt);
        })->whereHas('getDataMoa', function ($query) use ($year,$fakultas,$prodi) {
            $query->when($year, function ($query) use ($year) {
                $query->whereYear('tanggal_awal', $year);
            });
            $query->when($fakultas, function ($query) use ($fakultas) {
                $query->where('fakultas_pihak', $fakultas);
            });
            $query->when($prodi, function ($query) use ($prodi) {
                $query->where('prodi_id', $prodi);
            });
        })
        ->select('nama_pihak')
        ->groupBy('nama_pihak')
        ->get();
        // dd($data);
        return $data;
    }

    public static function countPtqs($ptqs=null,$year=null,$fakultas=null,$prodi=null)
    {
        $data = self::when($ptqs, function ($query) use ($ptqs) {
            $query->where('ptqs', $ptqs);
        })->whereHas('getDataMoa', function ($query) use ($year,$fakultas,$prodi) {
            $query->when($year, function ($query) use ($year) {
                $query->whereYear('tanggal_awal', $year);
            });
            $query->when($fakultas, function ($query) use ($fakultas) {
                $query->where('fakultas_pihak', $fakultas);
            });
            $query->when($prodi, function ($query) use ($prodi) {
                $query->where('prodi_id', $prodi);
            });
        })->select('nama_pihak')
        ->groupBy('nama_pihak')
        ->get();
        // dd($data);
        return $data;
    }
}
