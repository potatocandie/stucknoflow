@extends('main')

@section('title', "Buat Pertanyaan")

@section('stylesheet')
<link rel="stylesheet" href="{{ asset('/css/select2.min.css') }}">
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #fff;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #d81b60;
        border: 1px solid #d81b60;
    }
</style>
@endsection

@section('content')

<div class="card shadow-lg">
    <div class="card-header bg-success">
        <span class="h5"><strong>Buat Pertanyaan</strong></span>
        <div class="lead text-md mt-2">
            <strong>
                <a href="{{ route('pertanyaan.index')}}" class="text-light">Pertanyaan</a>
                <span class="text-light">| Buat Pertanyaan</span>
            </strong>
        </div>
    </div>
    <div class="card-body login-card-body">
        <form action="{{ route('pertanyaan.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="judul">Judul Pertanyaan :</label>
                <input name="judul" type="text" class="form-control">
            </div>
            <div class="mb-3">
                <label for="tag">Tag: </label>
                <select name="tag[]" class="form-control js-example-basic-multiple" multiple="multiple">
                    @foreach ($tag as $item)
                    <option value="{{ $item->id }}">{{ $item->isi_tag }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="isi">Detail Pertanyaan:</label>
                <textarea name="isi" type="text" class="form-control" rows="5"></textarea>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn bg-maroon btn-block">Kirim Pertanyaan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
         $('.js-example-basic-multiple').select2();
    });
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
<script type="text/javascript" src="{{ asset('/js/select2.min.js') }}"></script>
@endpush