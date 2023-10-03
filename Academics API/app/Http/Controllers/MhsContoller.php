<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MhsContoller extends Controller
{
    const API_URL="http://127.0.0.1:8000/api/mahasiswa";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $current_url=url()->current();
        $client = new Client();
        $url =static::API_URL;

        if($request->input('page') != null){
            $url .= "?page=" . $request->input('page');
        }

        $response = $client->request('GET',$url);
        $content = $response->getBody()->getContents();
        $contentArr=json_decode($content,true);
        $data = $contentArr['data'];

        foreach($data['links'] as $key => $value){
            $data['links'][$key]['url2']= str_replace(static::API_URL,$current_url,$value['url']);
        }

        return view('mahasiswa.index',['data'=>$data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new Client();
        // value mahasiswa
        $nama = $request->nama;
        $nim = $request->nim;
        $jurusan = $request->jurusan;
        $semester = $request->semester;
    
        $parameter = [
            'nama' => $nama,
            'nim' => $nim,
            'jurusan' => $jurusan,
            'semester' => $semester,
        ];
    
        $url = "http://127.0.0.1:8000/api/mahasiswa";
    
        try {
            $response = $client->request('POST', $url, [
                'headers' => ['Content-type' => 'application/json'],
                'body' => json_encode($parameter),
            ]);
    
            $content = $response->getBody()->getContents();
            $contentArr = json_decode($content, true);
    
            if ($contentArr['status'] != true) {
                $errors = $contentArr['data'];
                return redirect()->to('mahasiswa')->withErrors($errors)->withInput();
            } else {
                return redirect()->to('mahasiswa')->with('success','Berhasil menyimpan data');
            }
        } catch (\Exception $e) {
            return redirect()->to('mahasiswa')->withErrors($e->getMessage())->withInput();    
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/mahasiswa/$id";
        $response = $client->request('GET',$url);
        //dd($response);
        $content = $response->getBody()->getContents();
        $contentArr=json_decode($content,true);
        $data = $contentArr['data'];

        return view('mahasiswa.index',['data'=>$data]);
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
        $client = new Client();
        // value mahasiswa
        $nama = $request->nama;
        $nim = $request->nim;
        $jurusan = $request->jurusan;
        $semester = $request->semester;
    
        $parameter = [
            'nama' => $nama,
            'nim' => $nim,
            'jurusan' => $jurusan,
            'semester' => $semester,
        ];
    
        $url = "http://127.0.0.1:8000/api/mahasiswa/$id";
    
        try {
            $response = $client->request('PUT', $url, [
                'headers' => ['Content-type' => 'application/json'],
                'body' => json_encode($parameter),
            ]);
    
            $content = $response->getBody()->getContents();
            $contentArr = json_decode($content, true);
    
            if ($contentArr['status'] != true) {
                $errors = $contentArr['data'];
                return redirect()->to('mahasiswa')->withErrors($errors)->withInput();
            } else {
                return redirect()->to('mahasiswa')->with('success','Berhasil update data');
            }
        } catch (\Exception $e) {
            return redirect()->to('mahasiswa')->withErrors($e->getMessage())->withInput();    
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
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/mahasiswa/$id";
    
        try {
            $response = $client->request('DELETE', $url);
    
            $content = $response->getBody()->getContents();
            $contentArr = json_decode($content, true);
    
            if ($contentArr['status'] != true) {
                $errors = $contentArr['data'];
                return redirect()->to('mahasiswa')->withErrors($errors)->withInput();
            } else {
                return redirect()->to('mahasiswa')->with('success','Berhasil delete data');
            }
        } catch (\Exception $e) {
            return redirect()->to('mahasiswa')->withErrors($e->getMessage())->withInput();    
        }
    }
}
