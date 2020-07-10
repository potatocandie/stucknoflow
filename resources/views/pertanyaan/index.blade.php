@extends('main')

@section('title', "Semua Pertanyaan")

@section('content')

<div class="card shadow-lg">
    <div class="card-header bg-success">
        <a href="{{ route('pertanyaan.create')}}" class="btn bg-maroon px-5">Buat Pertanyaan</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th style="width: 300px">Judul</th>
                    <th>Isi</th>
                    <th style="width: 40px">Detail</th>
                    <th style="width: 40px">Edit</th>
                    <th style="width: 40px">Hapus</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pertanyaan as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ substr(strip_tags($item->judul) , 0, 20) }}
                        {{ strlen(strip_tags($item->judul)) > 20 ? "..." : "" }}</td>
                    <td>{{ substr(strip_tags($item->isi) , 0, 30) }}
                        {{ strlen(strip_tags($item->isi)) > 30 ? "..." : "" }}</td>
                    <td>
                        <a href="{{ route('pertanyaan.show', $item->id)}}">
                            <button class="btn btn-sm btn-secondary px-3">Detail</button>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('pertanyaan.edit', $item->id)}}">
                            <button class="btn btn-sm btn-primary px-3">Edit</button>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('pertanyaan.destroy', $item->id )}}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger px-2">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection