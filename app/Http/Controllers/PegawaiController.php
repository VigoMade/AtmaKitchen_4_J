<?php

namespace App\Http\Controllers;

use App\Mail\MailSend;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PegawaiController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $pegawai = Pegawai::orderBy('id_pegawai', 'desc')->paginate(5);
        return view('MOKaryawan.indexKaryawan', compact('pegawai'));
    }


    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $jabatan = Jabatan::all();
        return view('MOKaryawan.createKaryawan', compact('jabatan'));
    }

    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_pegawai' => 'required',
            'telepon_pegawai' => 'required',
            'email_pegawai' => 'required',
            'foto' => 'image|mimes:jpeg,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('foto')) {
            $destinationPath = 'public/images';
            $fotoPegawai = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->storeAs($destinationPath, $fotoPegawai);
            $input['foto'] = 'storage/images/' . $fotoPegawai;
        }

        if ($request->input('id_role') === '') {
            $input['id_role'] = null;
        }

        $input['username'] = $request->input('username', null);
        $input['password'] = $request->input('password') ? bcrypt($request->input('password')) : null;
        $input['gaji'] = 0;
        $input['bonus_gaji'] = 0;
        $str = Str::random(100);
        $input['verify_key'] = $str;
        try {

            Pegawai::create($input);
            $details = [
                'username' => $request->username,
                'website' => 'Atma Kitchen',
                'datetime' => date('Y-m-d H:i:s'),
                'url' => request()->getHttpHost() . '/registerPegawai/verify/' . $str
            ];

            Mail::to($request->email_pegawai)->send(new MailSend($details));
            Session::flash('message', 'Link Verifikasi telah dikirim ke email anda. Silahkan Cek email anda untuk mengaktifkan akun');
            return redirect()->route('pegawai.index');
        } catch (Exception $e) {
            return redirect()->route('pegawai.index')->with('error', $e->getMessage());
        }
    }


    /**
     * edit
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        $jabatan = Jabatan::all();
        $pegawai = Pegawai::find($id);
        return view('MOKaryawan.editKaryawan', compact('pegawai', 'jabatan'));
    }

    /**
     * update
     *
     * @param mixed $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::find($id);
        $this->validate($request, [
            'nama_pegawai' => 'required',
            'telepon_pegawai' => 'required',
            'email_pegawai' => 'required',
            'foto' => 'image|mimes:jpeg,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
        if ($image = $request->file('foto')) {
            if ($pegawai->foto && file_exists(storage_path('app/public/' . str_replace('storage/', '', $pegawai->foto)))) {
                unlink(storage_path('app/public/' . str_replace('storage/', '', $pegawai->foto)));
            }

            $destinationPath = 'public/images';
            $fotoPegawai = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->storeAs($destinationPath, $fotoPegawai);
            $input['foto'] = 'images/' . $fotoPegawai;
        } else {
            unset($input['foto']);
        }

        if ($request->input('id_role') === '') {
            $input['id_role'] = null;
        }

        $input['username'] = $request->input('username', null);
        $input['password'] = $request->input('password') ? bcrypt($request->input('password')) : null;
        $pegawai->update($input);

        return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();
        return redirect()->route('pegawai.index')->with(['success' => 'Data 
            Berhasil Dihapus!']);
    }


    public function show(Request $request)
    {
        $search = $request->search;
        $pegawai = Pegawai::where('nama_pegawai', 'like', "%" . $search . "%")->paginate(5);
        return view('MOKaryawan.indexKaryawan', compact('pegawai'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $pegawai = Pegawai::where('nama_pegawai', 'like', "%" . $search . "%")->paginate(5);
        return view('MOKaryawan.indexKaryawan', compact('pegawai'));
    }

    public function verifyPegawai($verify_key)
    {
        $keyCheck = Pegawai::select('verify_key')
            ->where('verify_key', $verify_key)
            ->exists();
        if ($keyCheck) {
            $user = Pegawai::where('verify_key', $verify_key)
                ->update([
                    'active' => 1,
                    'email_verified_at' => date('Y-m-d H:i:s'),
                ]);

            return "Verifikasi Berhasil. Akun Anda sudah aktif.";
        } else {
            return 'Keys tidak valid';
        }
    }
}
