<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\Province;
use App\Models\Violation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaint = Complaint::select('ID_PELANGGARAN', DB::raw('COUNT(ID_PELANGGARAN) as JUMLAH'))
                            ->whereMonth('CREATED_AT', date('m'))->groupBy('ID_PELANGGARAN')->get();
        $c = [];
        $v = [];

        foreach ($complaint as $key) {
            $c[] = $key->JUMLAH;
            $v[] = $key->violation->NAMA;
        }

        $data = [
            'complaint' => $c,
            'violation' => $v
        ];
        // return dd($violation);
        return view('user.complaint.index', $data);
    }

    public function create()
    {
        $violation = Violation::all();
        $province = Province::all();
        $complaintTicket = 'WBS'.date('Ymd').round(microtime(true) * 1000);

        $data = [
            'violation' => $violation,
            'province'  => $province,
            'complaintTicket' => $complaintTicket,
        ];
        return view('user.complaint.create', $data);
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validation = $this->validation($request);

            if ($validation->fails()) {
                return response()->json([
                    'code' => 400,
                    'message' => $validation->messages(),
                ]);
            } else {
                // $data = $request->all();
                $complaint = Complaint::create([
                    'KODE_PENGADUAN'    => $request->complaint_ticket,
                    'ID_PELANGGARAN'    => $request->violation_type,
                    'NAMA_TERLAPOR'     => $request->reported_name,
                    'LOKASI'            => $request->address,
                    'TANGGAL'           => $request->date,
                    'URAIAN'            => $request->desc,
                    'FILE'              => $request->file = $request->file('file')->storeAs('uploads', 'Complaint_'.$request->complaint_ticket.'.'.$request->file->extension()),
                    'STATUS'            => 1,
                    'KETERANGAN'        => 'Laporan Akan Segera Diproses',
                    'NAMA_PELAPOR'      => $request->reporter_name,
                    'ID_PROVINSI'       => $request->province,
                    'ID_KABUPATEN'      => $request->regency,
                    'ID_KECAMATAN'      => $request->district,
                    'ID_KELURAHAN'      => $request->village,
                    'ALAMAT'            => $request->reporter_address,
                ]);
                $complaint->save();

                return response()->json([
                    'code' => 200,
                    'message' => 'Input Sukses',
                    'ticket' => $request->complaint_ticket
                ]);
            }
        }
    }

    public function show()
    {
        return view('user.complaint.show');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $complaintTicket = $request->get('complaint');
            $output = '';

            $query = Complaint::where('KODE_PENGADUAN', $complaintTicket)->first();

            if ($query) {
                if ($query->STATUS == 1) {
                    $asset = "assets/images/landing/warning.png";
                    $message = 'Pengaduan Masuk';
                } else if ($query->STATUS == 2) {
                    $asset = "assets/images/landing/warning.png";
                    $message = 'Pengaduan Diproses';
                } else {
                    $asset = "assets/images/landing/checklist.png";
                    $message = 'Pengaduan Diterima';
                }

                $output .= '
                    <div class="card" id="search_result">
                        <div class="card-header" style="background-color: #4154f1">
                            <div class="container">
                                <div class="d-flex justify-content-between text-start">
                                    <span class="fw-bold text-white">Tiket Pengaduan</span>
                                    <span class="fw-bold text-white">WBS RSUD Kota Bogor</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-4 text-start mt-3">
                                        <div>
                                            <p class="fs-6 m-0">Nomor Pengaduan</p>
                                            <h5 class="fw-bold">'.$query->KODE_PENGADUAN.'</h5>
                                        </div>
                                        <div class="">
                                            <p class="fs-6 m-0">Tanggal Pengaduan</p>
                                            <h5 class="fw-bold">'.$query->setDateFormat($query->CREATED_AT).'</h5>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-start mt-3">
                                        <div>
                                            <p class="fs-6 m-0">Jenis Pelanggaran</p>
                                            <h5 class="fw-bold">'.$query->violation->NAMA.'</h5>
                                        </div>
                                        <div class="">
                                            <p class="fs-6 m-0">Note</p>
                                            <h5 class="fw-bold">'.$query->KETERANGAN.'</h5>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="text-center">
                                            <img src="'.asset($asset).'" alt="" srcset="" class="img-fluid">
                                            <p class="m-0 fw-bold">'.$message.'</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            } else {
                $output .= '
                    <div class="card" style="border-width: 2px; border-color: #dc3545">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                            <img src="'.asset('assets/images/landing/cancel.png').'" alt="" srcset="">
                                            <div class="fs-3 fw-bold" style="color: #dc3545">Data Pengaduan Tidak Ditemukan</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
            }

            return response()->json([
                'complaint' => $output
            ]);
        }
    }

    public function validation(Request $request)
    {
        $rules = [
            'complaint_ticket'  => 'required',
            'violation_type'    => 'required',
            'reported_name'     => 'required',
            'address'           => 'required',
            'date'              => 'required',
            'desc'              => 'required',
            'file'              => ['required', 'max:81920', 'mimes:doc,docx,xls,xlsx,pdf,jpg,jpeg,png,avi,mp4,3gp,mp3'],

            'reporter_name'     => 'required',
            'province'          => 'required',
            'regency'           => 'required',
            'district'          => 'required',
            'village'           => 'required',
            'reporter_address'  => 'required'
        ];

        $messages = [
            'complaint_ticket.required'     => 'Nomor pengaduan harus diisi',
            'violation_type.required'       => 'Jenis pelanggaran harus diisi',
            'reported_name.required'        => 'Nama terlapor harus diisi',
            'address.required'              => 'Lokasi kejadian harus diisi',
            'date.required'                 => 'Tanggal perkiraan kejadian harus diisi',
            'desc.required'                 => 'Uraian Pengaduan harus diisi',
            'file.required'                 => 'Bukti harus diisi',
            'file.max'                      => 'File bukti maksimal 10 mb',
            'file.max'                      => 'Isi file bukti dengan format yang diwajibkan',
            'reporter_name.required'        => 'Nama pelapor harus diisi',
            'province.required'             => 'Provinsi harus diisi',
            'regency.required'              => 'Kabupaten harus diisi',
            'district.required'             => 'Kecamatan harus diisi',
            'village.required'              => 'Kelurahan harus diisi',
            'reporter_address.required'     => 'Alamat pelapor harus diisi',
        ];

        return Validator::make($request->all(), $rules, $messages);
    }
}
