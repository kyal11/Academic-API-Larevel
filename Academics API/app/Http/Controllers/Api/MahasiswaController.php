<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Validator;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = Mahasiswa::orderBy('nama', 'asc')->paginate(10);
            
            if ($data === null ) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                    'data' => []
                ], 404); // Respon 404 jika data tidak ditemukan
            }
    
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 400); // Respon 400 untuk kesalahan umum
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            
            $validator = Validator::make($request->all(),[
                'nama'=>'required',
                'nim'=>'required',
                'jurusan'=>'required',
                'semester'=>'required',
            ]);
    
            if($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Semua input harus diisi',
                    'data' => $validator->errors()
                ]);
            }
    
            $dataMhs = new Mahasiswa;
            $dataMhs->nama = $request->nama;
            $dataMhs->nim = $request->nim;
            $dataMhs->jurusan = $request->jurusan;
            $dataMhs->semester = $request->semester;
    
            $dataMhs->save();
    
            return response()->json([
                'status' => true,
                'message' => 'Data mahasiswa berhasil disimpan',
                'data' => $dataMhs
            ], 201); // Respon 201 untuk Created
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 400); // Respon 400 untuk kesalahan umum
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   try {
            $data = Mahasiswa::find($id);

            if($data === null){
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                    'data' => []
                ], 404); // Respon 404 jika data tidak ditemukan
            }
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 400); // Respon 400 untuk kesalahan umum
        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $dataMhs =Mahasiswa::find($id);

            if(empty($dataMhs)){
                return response()->json([
                    'status'=>false,
                    'message'=>'Data tidak ditemukan'
                ],404);
            }


            $validator = Validator::make($request->all(),[
                'nama'=>'required',
                'nim'=>'required',
                'jurusan'=>'required',
                'semester'=>'required',
            ]);
    
            if($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'gagal Memasukkan data',
                    'data' => $validator->errors()
                ],400);
            }
    
            $dataMhs->nama = $request->nama;
            $dataMhs->nim = $request->nim;
            $dataMhs->jurusan = $request->jurusan;
            $dataMhs->semester = $request->semester;
    
            $dataMhs->save();
    
            return response()->json([
                'status' => true,
                'message' => 'Data mahasiswa berhasil di update',
                'data' => $dataMhs
            ], 201); // Respon 201 untuk Created
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 400); // Respon 400 untuk kesalahan umum
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $dataMhs =Mahasiswa::find($id);

            if(empty($dataMhs)){
                return response()->json([
                    'status'=>false,
                    'message'=>'Data tidak ditemukan'
                ],404);
            }

            $dataMhs->delete();
    
            return response()->json([
                'status' => true,
                'message' => 'Data mahasiswa berhasil di hapus',
                'data' => $dataMhs
            ], 201); // Respon 201 untuk Created
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 400); // Respon 400 untuk kesalahan umum
        }
    }
}

