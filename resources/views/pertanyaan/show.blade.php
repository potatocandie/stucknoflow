@extends('main')

@section('title', "Detail Pertanyaan")

@section('stylesheet')
<style>
    .img-user {
        border-radius: 50%;
        height: 70px;
        width: 70px;
        border: 3px solid #fff;
        object-fit: cover;
    }

    .btn-buka-jawaban {
        border: 1px solid red;
    }
</style>
@endsection

@section('content')

<div class="card shadow-lg">
    <div class="card-header bg-powder text-powder">
        <p class="h5"><strong>Detail Pertanyaan</strong></p>
        <a href="{{ url('/pertanyaan') }}" class="mr-3"><i class="fas fa-reply text-powder mr-2"></i>Semua
            Pertanyaan</a>
    </div>
    <div class="card-body login-card-body">
        <div class="row">
            <div class="col-md-9">
                <span class="h4"><strong>{{ $pertanyaan->judul}}</strong></span>
                <div class="mt-3 mb-3">
                    @foreach ($pertanyaan->tag as $tag)
                    <button class="btn btn-sm bg-powder text-powder py-0 px-3">{{ $tag->isi_tag }}</button>
                    @endforeach
                </div>
                <div class="lead mb-3">{!! $pertanyaan->isi !!}</div>
                <hr>

                <!----JAWABAN ----->
                <p class="h5 mb-3"><strong>{{ count($pertanyaan->jawaban) }} Jawaban</strong></p>
                @foreach ($pertanyaan->jawaban as $jawaban)
                <div class="info-box">
                    <span class="info-box-icon">
                        <img src="{{ is_null($jawaban->users->profil->user_img) ? asset('/images/default_pic.png') : asset('/images/'. $jawaban->users->profil->user_img)}}"
                            alt="user" class="img-user">
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-number">Dari {{ $jawaban->users->name }}</span>
                        <span class="h6 mt-1">
                            {{ $jawaban->isi_jawaban }}
                        </span>
                        <span class="text-sm">
                            <em>diunggah {{ $jawaban->created_at->diffForHumans() }}</em>
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-md-3">
                <div class="card bg-powder-orange-soft">
                    <div class="card-body text-center">
                        <span class="text-muted">Dibuat</span>
                        <p class="text-bold text-muted">
                            {{ $pertanyaan->created_at->diffForHumans() }}
                        </p>
                        <hr>
                        <span class="text-muted">Terakhir Diupdate</span>
                        <p class="text-bold text-muted">
                            {{ $pertanyaan->updated_at->diffForHumans() }}
                        </p>
                        <hr>
                        <p class="text-muted">Ditanyakan Oleh</p>
                        <img src="{{ is_null($pertanyaan->users->profil->user_img) ? asset('/images/default_pic.png') : asset('/images/'. $pertanyaan->users->profil->user_img)}}"
                            alt="user" class="img-user mt-0 mb-2">
                        <p class="mb-0">{{ $pertanyaan->users->name }}</p>
                        <p>Reputasi: 50</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection