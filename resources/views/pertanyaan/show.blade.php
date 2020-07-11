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
        <span class="h5"><strong>Detail Pertanyaan</strong></span>
        <div class="lead text-md mt-2">
            <strong>
                <a href="{{ route('pertanyaan.index')}}" class="text-powder">Pertanyaan</a>
                <span class="text-gray">| Detail Pertanyaan</span>
            </strong>
        </div>
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

                <div class="row ml-auto mr-auto mb-3">
                    <button id="buka_jawaban" type="submit" class="btn btn-outline-primary btn-block mt-3">Jawab
                        Pertanyaan</button>
                </div>

                <!--- FORM JAWABAN --->
                <div id="form_jawaban" class="row" style="display: none">
                    <div class="col-md-12 m-auto">
                        <div class="card border-primary shadow-lg" style="border: 1px solid">
                            <div class="card-body">
                                <form action="#" method="POST">
                                    @csrf
                                    <textarea type="text" class="form-control mt-2" name="isi_jawaban"
                                        rows="5"></textarea>
                                    <button type="submit" class="btn bg-maroon btn-block mt-3">Kirim Jawaban</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

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

@push('scripts')
<script type="text/javascript">
    var buka_jawaban = document.getElementById('buka_jawaban');
    var form_jawaban = document.getElementById('form_jawaban');

    buka_jawaban.addEventListener("click", function(event){
        event.preventDefault();
        if(this.innerText === 'Jawab Pertanyaan'){
            this.innerText = 'Batal Jawab';
            this.classList.remove('btn-outline-primary');
            this.classList.add('btn-outline-danger');
            form_jawaban.style.display="block";
        } else {
            this.innerText = 'Jawab Pertanyaan';
            this.classList.add('btn-outline-primary');
            this.classList.remove('btn-outline-danger');
            form_jawaban.style.display = 'none';
        }
    });
</script>
@endpush