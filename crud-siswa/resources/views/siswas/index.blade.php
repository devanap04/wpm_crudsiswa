@extends('siswas.layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>CRUD Data Siswa</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('siswas.create') }}"> Tambah Data</a>
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
     
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>NIS</th>
            <th>Jenis Kelamin</th>
            <th>Jurusan</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($siswas as $siswa)
        <tr>
            <td>{{ ++$i }}</td>
            <td><img src="/image/{{ $siswa->foto }}" width="100px"></td>
            <td>{{ $siswa->nama }}</td>
            <td>{{ $siswa->nis }}</td>
            <td>{{ $siswa->jenis_kelamin }}</td>
            <td>{{ $siswa->jurusan }}</td>
            <td>
                <form action="{{ route('siswas.destroy',$siswa->id) }}" method="POST">
     
                    <a class="btn btn-info" href="{{ route('siswas.show',$siswa->id) }}">Show</a>
      
                    <a class="btn btn-primary" href="{{ route('siswas.edit',$siswa->id) }}">Edit</a>
     
                    @csrf
                    @method('DELETE')
        
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
    {!! $siswas->links() !!}
        
@endsection