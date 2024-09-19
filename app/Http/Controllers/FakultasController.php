<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Attribute;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fakultas = Fakultas::all();
        $data['success'] = true;
        $data['result'] = $fakultas;
        return response()->json($data,Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required|unique:fakultas'
        ]);

        $result = Fakultas::create($validate);// Simpan ke Table
        if($result){
            $data['success'] = true;
            $data['message'] = 'Data fakultas berhasil disimpan';
            $data['result'] = $result;
            return response()->json(data: $data, status:Response::HTTP_CREATED);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Fakultas $fakultas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fakultas $fakultas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate(rules:['nama '=>'required']);
        $result = Fakultas::where(column:'id', operator : $id)->update(attributes: $validate);
        if ($result){
            $data['succes'] = true;
            $data['masssage']= 'Data fakultas berhasil di update';
            $data['result']=$result;
            return Response()->json(data:$data,
            status:Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fakultas = Fakultas::find(id:$id);
        if($fakultas){
            $fakultas->delete();
            $data['succes']= true;
            $data['mesage']= "data fakultas dihapus";
            return response()->json(data:$data, status: Response::HTTP_OK);
        }else
        $data['succes']= false;
        $data['mesage'] = "data fakultas tidak ditemukan";
        return response()->json(data:$data, status: response::HTTP_NOT_FOUND);
    }
}
