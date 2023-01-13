<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $table = 'pengaduan';

    protected $fillable = [
        'KODE_PENGADUAN',
        'ID_PELANGGARAN',
        'NAMA_TERLAPOR',
        'LOKASI',
        'TANGGAL',
        'URAIAN',
        'FILE',
        'STATUS',
        'KETERANGAN',
        'NAMA_PELAPOR',
        'ID_PROVINSI',
        'ID_KABUPATEN',
        'ID_KECAMATAN',
        'ID_KELURAHAN',
        'ALAMAT',
    ];

    public function violation()
    {
        return $this->hasOne(Violation::class, 'ID', 'ID_PELANGGARAN');
    }

    public function setDateFormat($date)
    {
        return $this->attributes['CREATED_AT'] = Carbon::parse($date)->isoFormat('D MMMM Y');
    }
}
