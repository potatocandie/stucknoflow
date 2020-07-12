@extends('main')

@section('title', "Detail Pertanyaan")

@section('stylesheet')
<style>
    /* user-image */
    .img-user {
        border-radius: 50%;
        height: 70px;
        width: 70px;
        border: 3px solid #fff;
        object-fit: cover;
    }
</style>
@endsection

@section('content')

<div class="card shadow-lg">
    <div class="card-header bg-powder text-powder">
        <p class="h5"><strong>Detail Pertanyaan</strong></p>
        <a href="{{ url('/') }}" class="mr-3"><i class="fas fa-reply text-powder mr-2"></i>Semua
            Pertanyaan</a>
    </div>
    <div class="card-body login-card-body">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-1 text-center" data-pertanyaanid="{{ $pertanyaan->id }}">
                        <div data-like="true">
                            <a href="#" class="vote-like"><i
                                    class="fa fa-caret-up fa-3x up-vote {{ Auth::check() ? (Auth::user()->likes()->where('pertanyaan_id', $pertanyaan->id)->first() ? ( (Auth::user()->likes()->where('pertanyaan_id', $pertanyaan->id)->first()->like === 1) ? 'text-powder-orange' : 'text-gray') : 'text-gray') : 'text-gray' }}"></i></a>
                        </div>
                        <div>
                            <span class="h4" id="count">{{ $count }}</span>
                        </div>
                        <div data-like="false">
                            <a href="#" class="vote-like"><i
                                    class="fa fa-caret-down fa-3x down-vote {{ Auth::check() ? (Auth::user()->likes()->where('pertanyaan_id', $pertanyaan->id)->first() ? ( (Auth::user()->likes()->where('pertanyaan_id', $pertanyaan->id)->first()->like === 0) ? 'text-powder-orange' : 'text-gray') : 'text-gray') : 'text-gray' }}"></i></a>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <span class="h4"><strong>{{ $pertanyaan->judul}}</strong></span>
                        <div class="h5 mb-3 mt-3">{!! $pertanyaan->isi !!}</div>
                        <div class="mt-3 mb-3">
                            @foreach ($pertanyaan->tag as $tag)
                            <button class="btn btn-sm bg-powder py-0 px-3 text-powder">{{ $tag->isi_tag }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
                <hr>

                <!----KOMENTAR PERTANYAAN----->
                <div class="row mb-0">
                    <div class="col-md-12">
                        <a href="" class="text-md" id="buka-komentar">Beri Komentar</a>
                    </div>
                </div>

                <div id="form-komentar" class="row align-items-center mb-3 mr-1" style=" display: none">
                    <div class="col-md-12 mt-2">
                        <form
                            action="{{ route('comment.store', ['commentable_id' => $pertanyaan->id, 'commentable_type' => 'pertanyaan']) }}"
                            method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="isi_comment">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="far fa-paper-plane text-powder"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>

                @foreach ($pertanyaan->comments->sortByDesc('created_at') as $comment)
                <div class="row mb-0 mt-2 ml-3">
                    <div class="col-md-12">
                        <span class="badge bg-powder py-1 px-2 text-powder text-sm">
                            {{ is_null($comment->users->profil->akun_github) ? $comment->users->name : '@'.$comment->users->profil->akun_github }}

                        </span>
                        <span class="text-md buka-komentar">{{ $comment->isi_comment }}</span>
                        <span
                            class="badge bg-powder-gray py-1 px-2 text-powder">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                @endforeach


                <!----JAWABAN ----->
                <p class="h5 mb-3 mt-3"><strong>{{ count($pertanyaan->jawaban) }} Jawaban</strong></p>
                @foreach ($pertanyaan->jawaban as $jawaban)
                        <div class="info-box">
                            <span class="info-box-icon">
                                <img src="{{ is_null($jawaban->users->profil->user_img) ? asset('/images/default_pic.png') : asset('/images/'. $jawaban->users->profil->user_img)}}"
                                    alt="user" class="img-user">
                            </span>
                            <div class="col">
                                <span class="info-box-number">Dari {{ $jawaban->users->name }}</span>
                                <p class="h6 mt-1">
                                    {{ $jawaban->isi_jawaban }}
                                </p>
                                <p class="badge bg-powder-gray py-1 px-2 text-powder">
                                    diunggah {{ $jawaban->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>

                        <!----LIST KOMENTAR JAWABAN ----->
                        @foreach ($jawaban->comments->sortByDesc('created_at') as $comment)
                        <div class="row mb-0 mt-2 ml-3">
                            <div class="col-md-12">
                                <span class="badge bg-powder py-1 px-2 text-powder text-sm">
                                    {{ is_null($comment->users->profil->akun_github) ? $comment->users->name : '@'.$comment->users->profil->akun_github }}

                                </span>
                                <span class="text-md buka-komentar">{{ $comment->isi_comment }}</span>
                                <span
                                    class="badge bg-powder-gray py-1 px-2 text-powder">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        @endforeach

                        <!----KOMENTAR JAWABAN FORM----->
                        <div class="row mb-0 mt-3">
                            <div class="col-md-12">
                                <a href="" class="text-md buka-komentar-jawaban"
                                    data-idjawaban="{{ $jawaban->id }}">Beri
                                    Komentar</a>
                            </div>
                        </div>

                        <div class="row row align-items-center mb-3 mr-1 form-komentar-jawaban"
                            data-idjawaban="{{ $jawaban->id }}"">

                        </div>
                @endforeach

                @if (Auth::user())
                    @if (Auth::id() == $pertanyaan->users->id)
                    <div class=" row ml-auto mr-auto mb-3">
                        <button id="buka_jawaban" type="submit" class="btn btn-outline-danger btn-block mt-3" disabled>Kamu
                            Tidak Bisa Menjawab Pertanyaan Sendiri</button>
                    </div>
                    @else
                    <div class="row ml-auto mr-auto mb-3">
                        <button id="buka_jawaban" type="submit" class="btn btn-outline-primary btn-block mt-3">Jawab
                            Pertanyaan</button>
                    </div>
                    @endif

                    <!--- FORM JAWABAN --->
                    <div id="form_jawaban" class="row" style="display: none">
                        <div class="col-md-12 m-auto">
                            <div class="card border-primary shadow-lg" style="border: 1px solid">
                                <div class="card-body">
                                    <form action="{{ route('jawaban.store', $pertanyaan->id) }}" method="POST">
                                        @csrf
                                        <textarea type="text" class="form-control mt-2" name="isi_jawaban"
                                            rows="5"></textarea>
                                        <button type="submit" class="btn bg-maroon btn-block mt-3">Kirim
                                            Jawaban</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                <div class="row ml-auto mr-auto mb-3">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-block mt-3">Login
                        Untuk Ikut
                        Menjawab</a>
                </div>
                @endif
            </div>

            <!---- SIDEBAR RIGHT --->
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
                        <p class="text-muted mb-2">Ditanyakan Oleh</p>
                        <?php 
                            $nameSlice = explode(" ", $pertanyaan->users->name); 
                            $last = count($nameSlice);  
                        ?>
                        <div class="row justify-content-center mb-1">
                            <div class="img-user-all-container" style="width: 75px; height: 75px">
                                <img src="{{ is_null($pertanyaan->users->profil->user_img) ? asset('/images/default_pic.png') : asset('/images/'. $pertanyaan->users->profil->user_img)}}"
                                    alt="user" class="img-user-all">
                            </div>
                        </div>
                        <p class="mb-0 text-bold">
                            <p class="mb-0 text-bold">
                                {{ is_null($pertanyaan->users->profil->akun_github) ? $nameSlice[$last-1] : '@'.$pertanyaan->users->profil->akun_github }}
                            </p>
                            <p class="h6 text-bold bg-powder-gray py-1 px-2 text-powder">Reputasi:
                                {{ $pertanyaan->users->profil->reputasi }}</p>
                    </div>
                </div>
            </div><!----END OF SIDE BAR --->

        </div> <!----END OF ROW --->
    </div><!----END OF CARD BODY --->
</div><!----END OF CARD --->

@endsection

@push('scripts')
<script type="text/javascript">
    //pertanyaan
    var buka_komentar = document.getElementById('buka-komentar');
    var form_komentar = document.getElementById('form-komentar');

    if (buka_komentar != null) {
        buka_komentar.addEventListener("click", function(event){
        event.preventDefault();
        if(this.innerText === 'Beri Komentar'){
            this.innerText = 'Batal';
            form_komentar.style.display="block";
        } else {
            this.innerText = 'Beri Komentar';
            form_komentar.style.display = 'none';
        }
    });
    }

    // jawaban
    var buka_komentar_jawaban = document.querySelectorAll('.buka-komentar-jawaban');
    let form_komentar_jawaban = `
                    <div class="col-md-12 mt-2">
                        <form
                            action="{{ route('comment.store', ['commentable_id' => $jawaban->id, 'commentable_type' => 'jawaban']) }}"
                            method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="isi_comment">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="far fa-paper-plane text-powder"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>`;

    buka_komentar_jawaban.forEach(element => {
        if (buka_komentar_jawaban != null) {
            element.addEventListener("click", function(event){
            event.preventDefault();

            if(this.innerText === 'Beri Komentar'){
                this.innerText = 'Batal';
                // form_komentar.style.display="block";
            } else {
                this.innerText = 'Beri Komentar';
                // form_komentar.style.display = 'none';
            }
            
            

            });
        }
    });
    
</script>

<script type="text/javascript">
    var buka_jawaban = document.getElementById('buka_jawaban');
    var form_jawaban = document.getElementById('form_jawaban');

    if (buka_jawaban != null) {
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
    }
</script>

<script type="text/javascript">
    var isAuth = {{ Auth::check() }}
    document.querySelectorAll('.vote-like').forEach(item => {
        item.addEventListener('click', function(event){
            event.preventDefault();
            
            if (isAuth == 1) {
                pertanyaanId = event.target.parentNode.parentNode.parentNode.dataset['pertanyaanid'];
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var postLikeAPI = '/like';
            var isLike = false;
            if (event.target.parentNode.parentNode.dataset['like'] == 'true') {
                isLike = true;
            } else if (event.target.parentNode.parentNode.dataset['like'] == 'false') {
                isLike = false;
            }
            
            fetch(postLikeAPI, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token
                        },
                    method: 'post',
                    credentials: "same-origin",
                    body: JSON.stringify({
                        isLike: isLike,
                        pertanyaan_id: pertanyaanId,
                        _token: token
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error("HTTP error " + response.status);
                    }
                    return response.text();
                })
                .then((data) => {
                    var object = JSON.parse(data);

                    document.getElementById('count').innerText = object['count'];
                    if (object['isLike'] == true) {
                        document.querySelector('.up-vote').classList.remove('text-gray');
                        document.querySelector('.up-vote').classList.add('text-powder-orange');
                        document.querySelector('.down-vote').classList.remove('text-powder-orange');
                        document.querySelector('.down-vote').classList.add('text-gray');
                    } else if (object['isLike'] == false){
                        document.querySelector('.up-vote').classList.remove('text-powder-orange');
                        document.querySelector('.up-vote').classList.add('text-gray');
                        document.querySelector('.down-vote').classList.remove('text-gray');
                        document.querySelector('.down-vote').classList.add('text-powder-orange');
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
            } else {
                window.location = '/login';
            }
        })
    });
</script>
@endpush