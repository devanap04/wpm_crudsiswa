<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswas = Siswa::latest()->paginate(5);

        return view('siswas.index',compact('siswas'))->with('i',(request()->input('page', 1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siswas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'nis'=>'required',
            'jenis_kelamin'=>'required',
            'jurusan'=>'required',
            'foto'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        

        $input = $request->all();

        if($foto = $request->file('image')){
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." .$foto->getClientOriginalExtension();
            $foto->move($destinationPath, $profileImage);
            $input['foto'] = "$profileImage";
        }

        Siswa::create($input);

        return redirect()->route('siswas.index')->with('success','Create data siswa berhasil!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        return view('siswas.show',compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        return view('siswas.edit',compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nama'=>'required',
            'nis'=>'required',
            'jenis_kelamin'=>'required',
            'jurusan'=>'required',
            'foto'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

  

        if ($foto = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $foto->move($destinationPath, $profileImage);
            $input['foto'] = "$profileImage";
        }else{
            unset($input['image']);
        }

        $siswa->update($input);

        return redirect()->route('siswas.index')->with('success','Update data siswa berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
     
        return redirect()->route('siswas.index')->with('success','Delete data siswa berhasil!');
    }
}
