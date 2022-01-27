<?php

namespace App\Http\Controllers\Admin\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class Pegawai extends Controller
{
    public function index()
    {
        return view('admin.kepegawaian.pegawai.index');
    }

    public function create()
    {
        return view('admin.kepegawaian.pegawai.create');
    }

    public function store(Request $request)
    {
        $data = User::create([
            'name' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'tlp' => $request->tlp,
            'foto' => 'admin.png',
            'status' => '1',
        ]);

        $data->assignRole($request->role);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function show($id)
    {
        $data = User::findOrFail($id);
        return view('admin.kepegawaian.pegawai.show', compact('data'));
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('admin.kepegawaian.pegawai.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);
        $data->update([
            'name' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'tlp' => $request->tlp,
        ]);

        if ($request->password != "") {
            $data->update([
                'password' => bcrypt($request->password),
            ]);
        }

        $data->syncRoles($request->role);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');

        $return = array('id' => $data->id, 'status' => $return_status);
        echo json_encode($return);
    }

    public function destroy(Request $request)
    {
        $data = User::findOrFail($request->id);
        $data->update([
            'status' => '0',
        ]);

        $return_status = ($data != '' ? 'Valid' : 'Tidak Valid');
        $return = array('status' => $return_status, 'text' => 'Berhasil menghapus pegawai.');
        echo json_encode($return);
    }

    public function dt()
    {
        $data = User::where('status', '1')->role(['Penjaga Tambang', 'Supir', 'Kernek', 'Operator Excavator']);
        return DataTables::of($data)
            ->addColumn('posisi', function ($data) {
                return $data->getRoleNames()->first();
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('Admin Kepegawaian Pegawai Show', $data) . '" class="btn btn-xs btn-primary"><i class="fas fa-search"></i></a>';
            })
            ->make(true);
    }
}
