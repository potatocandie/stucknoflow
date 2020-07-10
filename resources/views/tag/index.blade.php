@extends('main')

@section('title', 'Tag')

@section('content')

<div class="row">
    <div class="col-md-8 mr-1">
        <div class="card shadow-md">
            <div class="card-body p-0">
                <table class="table text-center">
                    <thead class="bg-success">
                        <tr>
                            <th scope="col" style="width: 40px">#</th>
                            <th scope="col">Nama Tag</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tag as $item)
                        <tr>
                            <th scope="col">{{ $item->id }}</th>
                            <th scope="col"><a href="{{ route('tag.show', $item->id) }}"
                                    class="nav-link">{{ $item->isi_tag }}</a>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-3 align-self-start">
        <div class="card">
            <div class="card-header">
                <p class="h5">Tambah Tag</p>
            </div>
            <div class="card-body">
                <form action="{{ route('tag.store') }}" method="POST">
                    @csrf
                    <label for="isi_tag">Name : </label>
                    <input type="text" class="form-control mt-2" name="isi_tag">
                    <button type="submit" class="btn btn-success btn-block mt-3">Tambah Tag</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection