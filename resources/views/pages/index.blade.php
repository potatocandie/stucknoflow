@extends('main')

@section('title', "Home")

@section('content')

<div class="jumbotron text-center bg-powder-orange">
    <p class="h1 text-light jumbo-text"><strong><span class="bg-powder-orange-dark px-2">Stuck</span>noflow</strong>
    </p>
    <span class="text-light h5">Karena Kamu bisa <strong>Stuck</strong> Sewaktu-Waktu <i
            class="far fa-dizzy text-light"></i></span>
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
<div class="row justify-content-center mt-5">
    <div class="text-center">
        {!! $pertanyaan->links() !!}
    </div>
</div>

@endsection