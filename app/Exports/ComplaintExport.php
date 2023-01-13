<?php

namespace App\Exports;

use App\Models\Complaint;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class ComplaintExport implements FromView
{

    protected $iDate;
    protected $eDate;

    function __construct($iDate, $eDate) {
        $this->iDate = $iDate;
        $this->eDate = $eDate;
    }

    public function view(): View
    {
        DB::statement(DB::raw('set @rownum=0'));
        $select = [DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'ID_PELANGGARAN', 'NAMA_TERLAPOR', 'LOKASI', 'TANGGAL', 'URAIAN', 'CREATED_AT'];
        return view('export.complaint-excel', [
            'iDate' => Carbon::parse($this->iDate)->isoFormat('D MMMM Y'),
            'eDate' => Carbon::parse($this->eDate)->isoFormat('D MMMM Y'),
            'complaint' => Complaint::select($select)->whereBetween('CREATED_AT', [$this->iDate, $this->eDate])->get(),
        ]);
    }
}
