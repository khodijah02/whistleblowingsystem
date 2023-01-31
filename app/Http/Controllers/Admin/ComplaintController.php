<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ComplaintExport;
use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Tymon\JWTAuth\Facades\JWTAuth;
use Yajra\DataTables\Facades\DataTables;

class ComplaintController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {
            DB::statement(DB::raw('set @rownum=0'));
            $complaint = Complaint::select([DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'ID', 'KODE_PENGADUAN', 'ID_PELANGGARAN', 'NAMA_TERLAPOR', 'CREATED_AT'])
                ->where('STATUS', 1)
                ->orderBy('CREATED_AT', 'desc')->get();

                return DataTables::of($complaint)
                    ->addColumn('violation', function($item) {
                        return $item->violation->NAMA;
                    })
                    ->addColumn('date', function($item) {
                        return Carbon::parse($item->CREATED_AT)->isoFormat('D MMMM Y');
                    })
                    ->addColumn('action', function($item) {
                        $encrypt = Crypt::encryptString($item->ID);
                        return '<button class="btn btn-primary proceed_complaint" type="button" id="proceed_complaint" data-id="'.$encrypt.'" data-status="2">Proses</button>';
                    })
                    ->rawColumns(['action', 'status'])->make();
        }
        return view('admin.complaint.index');
    }

    public function indexFollowUp(Request $request)
    {
        if($request->ajax())
        {
            DB::statement(DB::raw('set @rownum=0'));
            $complaint = Complaint::select([DB::raw('@rownum  := @rownum  + 1 AS rownum'), 'ID', 'KODE_PENGADUAN', 'ID_PELANGGARAN', 'NAMA_TERLAPOR', 'CREATED_AT'])
                ->where('STATUS', '!=', 1)
                ->orderBy('CREATED_AT', 'desc')->get();

                return DataTables::of($complaint)
                    ->addColumn('violation', function($item) {
                        return $item->violation->NAMA;
                    })
                    ->addColumn('date', function($item) {
                        return Carbon::parse($item->CREATED_AT)->isoFormat('D MMMM Y');
                    })
                    ->addColumn('action', function($item) {
                        $encryptId = Crypt::encryptString($item->ID);
                        $encryptFile = Crypt::encryptString($item->FILE);
                        return '
                            <div class="btn-group">
                                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Aksi
                                </button>
                                <ul class="dropdown-menu">
                                    <li><button class="dropdown-item proceed_complaint" type="button" id="proceed_complaint" data-id="'.$encryptId.'" data-status="1">Batalkan Pengaduan</button></li>
                                    <li><a class="dropdown-item" href="'.route("admin.complaint.download", $encryptId).'" target="_blank">Download Pengaduan</a></li>
                                    <li><a class="dropdown-item" href="'.route("admin.complaint.print", $encryptId).'" target="_blank">Print Pengaduan</a></li>
                                </ul>
                            </div>
                        ';
                    })
                    ->rawColumns(['action', 'status'])->make();
        }
        return view('admin.complaint.index-followup');
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

    public function download($id)
    {
        $decrypt = Crypt::decryptString($id);
        $complaint = Complaint::where('ID', $decrypt)->first();

        if (Storage::exists($complaint->FILE)) {
            return Storage::download($complaint->FILE);
        } else {
            return abort(404);
        }
    }
}
