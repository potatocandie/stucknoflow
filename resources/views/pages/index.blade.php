@extends('main')

@section('title', "Home")

@section('content')

<div class="jumbotron text-center bg-powder-orange">
    <h1 class="display-4"><strong>Stucknoflow</strong></h1>
    <p class="lead">Karena Anda bisa <strong>Stuck</strong> Sewaktu-Waktu :)</p>
</div>

<div class="card shadow-lg">
    <div class="card-header bg-powder text-center text-powder">
        <span><strong>Ada Pertanyaan Nih</strong> Kuy Bantu</span>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th style="width: 300px">Judul</th>
                    <th>Isi</th>
                    <th>Lihat</th>
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
                        <a href="{{ route('pages.show', $item->id)}}">
                            <button class="btn btn-sm btn-secondary px-3">Detail</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection