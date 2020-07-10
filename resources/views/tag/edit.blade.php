@extends('main')

@section('title', 'Edit Tag')

@section('content')
<div class="row">
    <div class="col-md-12 m-auto">
        <div class="card shadow-lg">
            <div class="card-header bg-success">
                <p class="h5">Ganti Tag <strong>{{ $tag->isi_tag }}</strong></p>
            </div>
            <div class="card-body">
                <form action="{{ route('tag.update', $tag->id) }}" method="POST">
                    @csrf
                    <label for="isi_tag">Nama Tag Baru: </label>
                    <input type="text" class="form-control mt-2" name="isi_tag" value={{ $tag->name }}>
                    <button type="submit" class="btn btn-success btn-block mt-3">Update Tag</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection