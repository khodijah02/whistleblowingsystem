<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ComplaintExport;
use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            DB::statement(DB::raw('set @rownum=0'));
            $status = $request->get('status');
            $complaint = Complaint::select([DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'ID', 'KODE_PENGADUAN', 'ID_PELANGGARAN', 'NAMA_TERLAPOR', 'CREATED_AT', 'STATUS'])
                ->when($status, function($query) use($status) {
                    return $query->where('STATUS', $status);
                })->orderBy('CREATED_AT', 'desc')->get();

                return DataTables::of($complaint)
                    ->addColumn('violation', function($item) {
                        return $item->violation->NAMA;
                    })
                    ->addColumn('date', function($item) {
                        return Carbon::parse($item->CREATED_AT)->isoFormat('D MMMM Y');
                    })
                    ->addColumn('action', function($item) {
                        $encrypt = Crypt::encryptString($item->ID);
                        return '<a class="btn btn-primary" href="'.route('admin.complaint.show', $encrypt).'">Detail</a>';
                    })
                    ->addColumn('status', function($item) {
                        if ($item->STATUS == 1) {
                            return '<span class="badge rounded-pill badge-warning">Laporan Masuk</span>';
                        } else if ($item->STATUS == 2) {
                            return '<span class="badge rounded-pill badge-primary">Laporan Diproses</span>';
                        } else if ($item->STATUS == 3) {
                            return '<span class="badge rounded-pill badge-success">Laporan Diterima</span>';
                        } else {
                            return '<span class="badge rounded-pill badge-danger">Laporan Ditolak</span>';
                        }
                    })
                    ->rawColumns(['action', 'status'])->make();
        }
        return view('admin.complaint.index');
    }

    public function show($id)
    {
        $decrypt = Crypt::decryptString($id);

        $complaint = Complaint::where('ID', $decrypt)->first();
        $complaint->ID = Crypt::encryptString($complaint->ID);
        $complaint->TANGGAL = Carbon::parse($complaint->TANGGAL)->isoFormat('D MMMM Y');
        $complaint->CREATED_AT = Carbon::parse($complaint->CREATED_AT)->isoFormat('D MMMM Y');

        $data = ['complaint' => $complaint,];
        return view('admin.complaint.show', $data);
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $decrypt = Crypt::decryptString($id);
            $status = $request->get('status');

            if ($status == 1) {
                $message = 'Laporan Akan Segera Diproses';
            } else if ($status == 2) {
                $message = 'SPI Sedang Observasi Laporan';
            } else if ($status == 3) {
                $message = 'Laporan Diterima';
            } else {
                $message = 'Laporan Ditolak';
            }

            Complaint::where('ID', $decrypt)->update([
                'STATUS' => $status,
                'KETERANGAN' => $message
            ]);

            return response()->json([
                'code' => 200
            ]);
        }
    }

    public function report()
    {
        $montlyReport = Complaint::select('ID_PELANGGARAN', DB::raw('COUNT(ID_PELANGGARAN) as JUMLAH'))
                            ->whereMonth('CREATED_AT', date('m'))->groupBy('ID_PELANGGARAN')->get();
        $annualReport = Complaint::select(DB::raw('COUNT(ID_PELANGGARAN) as JUMLAH'))
                            ->whereYear('CREATED_AT', date('Y'))->groupByRaw('MONTH(CREATED_AT)')->get();

        $montlyData = [];
        $annualData = [];
        $violation = [];

        foreach ($montlyReport as $key) {
            $montlyData[] = $key->JUMLAH;
            $violation[] = $key->violation->NAMA;
        }

        foreach ($annualReport as $key) {
            $annualData[] = $key->JUMLAH;
        }

        $data = [
            'monthly' => $montlyData,
            'annual' => $annualData,
            'violation' => $violation,
        ];
        // return dd($annualReport);
        return view('admin.complaint.report', $data);
    }

    public function export(Request $request)
    {
        return Excel::download(new ComplaintExport($request->i_date, $request->e_date), 'complaint.xlsx');
    }

    public function print($id)
    {
        $decrypt = Crypt::decryptString($id);

        $complaint = Complaint::where('ID', $decrypt)->first();
        $complaint->TANGGAL = Carbon::parse($complaint->TANGGAL)->isoFormat('D MMMM Y');
        $complaint->CREATED_AT = Carbon::parse($complaint->CREATED_AT)->isoFormat('D MMMM Y');

        $data = ['complaint' => $complaint];
        return view('export.complaint-print', $data);
    }
}
