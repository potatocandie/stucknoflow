@extends('main')

@section('title', "Detail Pertanyaan")

@section('stylesheet')
<style>
    .img-user {
        border-radius: 50%;
        height: 70px;
        width: 70px;
        border: 3px solid #fff;
    }

    .btn-buka-jawaban {
        border: 1px solid red;
    }
</style>
@endsection

@section('content')

<div class="card shadow-lg">
    <div class="card-header bg-success">
        <span class="h5"><strong>Detail Pertanyaan</strong></span>
        <div class="lead text-md mt-2">
            <strong>
                <a href="{{ route('pertanyaan.index')}}" class="text-light">Pertanyaan</a>
                <span class="text-light">| Detail Pertanyaan</span>
            </strong>
        </div>
    </div>
    <div class="card-body login-card-body">
        <div class="row">
            <div class="col-md-9">
                <span class="h4"><strong>{{ $pertanyaan->judul}}</strong></span>
                <div class="mt-3 mb-3">
                    @foreach ($pertanyaan->tag as $tag)
                    <button class="btn btn-sm bg-maroon py-0 px-3">{{ $tag->isi_tag }}</button>
                    @endforeach
                </div>
                <div class="lead mb-3">{{ $pertanyaan->isi}}</div>
                <hr>

                <p class="h4 mb-3"><strong>0 Jawaban</strong></p>
                <div class="info-box">
                    <span class="info-box-icon"><i class="far fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-number">Dari Arifin</span>
                        <span class="h6 mt-1">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque nulla facilis molestias
                            velit ducimus magni, placeat dolorum repellat quae autem eveniet ab quia illum! Voluptatem
                            tempora minus consequuntur magnam neque!
                        </span>
                        <span class="info-box-number">
                            Pada {{ date('j M Y | h:i a', strtotime($pertanyaan->created_at)) }}
                        </span>
                    </div>
                </div>
                <div class="row ml-auto mr-auto mb-3">
                    <button id="buka_jawaban" type="submit" class="btn btn-outline-primary btn-block mt-3">Jawab
                        Pertanyaan</button>
                </div>
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
                <div class="info-box bg-primary">
                    <div class="row">
                        <div class="col-md-12 p-2 pl-3">
                            <div class="info-box-content text-center">
                                <span class="info-box-text">Dibuat</span>
                                <span class="info-box-number">
                                    {{ date('j M Y | h:i a', strtotime($pertanyaan->created_at)) }}
                                </span>
                            </div>
                            <hr>
                            <div class="info-box-content text-center">
                                <span class="info-box-text">Terakhir Diupdate</span>
                                <span class="info-box-number">
                                    {{ date('j M Y | h:i a', strtotime($pertanyaan->updated_at)) }}
                                </span>
                            </div>
                            <hr>
                            <div class="info-box-content text-center">
                                <span class="info-box-text">Ditanyakan Oleh</span>
                                <div class="mb-1 mt-1">
                                    <img src="{{ asset('/60.jpg') }}" alt="user" class="img-user">
                                </div>
                                <div class="info-box-content">
                                    <span class="info-box-text">{{ Auth::user()->name }}</span>
                                    <span class="info-box-number">Reputasi: 50</span>
                                </div>
                            </div>
                        </div>
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