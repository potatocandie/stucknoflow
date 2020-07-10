@extends('main')

@section('title', "".ucfirst($tag->isi_tag))

@section('content')
<div class="card shadow-lg">
    <div class="card-header d-flex align-items-center">
        <span class="sh5"><strong>{{ ucfirst($tag->isi_tag) }}</strong> : {{ $tag->pertanyaan()->count()}}
            Pertanyaan</span>
        <div class="ml-auto d-flex align-items-center"">
            <a href=" {{ route('tag.edit', $tag->id)}}" class="text-decoration-none mr-3">
            <button class="btn btn-outline-success btn-block">Edit Tag</button>
            </a>
            <form action="{{ route('tag.destroy', $tag->id) }}" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-outline-danger btn-block">Hapus Tag</button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul Pertanyaan</th>
                        <th scope="col">Tag Terkait</th>
                        <th scope="col">Lihat Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tag->pertanyaan as $pertanyaan)
                    <tr>
                        <th scope="col">{{ $pertanyaan->id }}</th>
                        <td scope="col">{{ $pertanyaan->judul }}</td>
                        <td scope="col">
                            @foreach ($pertanyaan->tag as $tag)
                            <button class="btn btn-secondary py-0"><span
                                    class="badge">{{ $tag->isi_tag}}</span></button>
                            @endforeach
                        </td>
                        <td scope="col">
                            <a href="{{ route('pertanyaan.show', $pertanyaan->id)}}">
                                <button class="btn bg-maroon">Detail</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection