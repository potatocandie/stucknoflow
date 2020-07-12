<div class="card shadow-lg">
    <div class="card-header bg-powder">
        <?php 
            $nameSlice = explode(" ", Auth::user()->name); 
            $last = count($nameSlice);  
        ?>
        <h3 class="card-title">Hallo, {{ $nameSlice[$last-1] }} !</h3>
        <div class="card-tools">
            <span class="badge badge-primary">Profil</span>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-2 justify-content-center">
            <div class="img-user-all-container text-center">
                <img src="{{ is_null(Auth::user()->profil->user_img) ? asset('/images/default_pic.png') : asset('/images/'. Auth::user()->profil->user_img)}}"
                    alt="user" class="img-user-all">
            </div>
        </div>
        <div class="row justify-content-center mb-3">
            <div class="col-md-12 text-center">
                <p class="h5 text-bold text-muted mb-0">
                    {{ is_null(Auth::user()->profil->akun_github) ? $nameSlice[$last-1] : '@'.Auth::user()->profil->akun_github }}
                </p>
                <p class="text-muted">bergabung {{ Auth::user()->created_at->diffForHumans() }}</p>
            </div>
        </div>
        <div class="info-box bg-powder-orange">
            <span class="info-box-icon"><i class="fas fa-chess-king text-powder-orange-dark"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Reputasi</span>
                <span class="info-box-number h4 m-0">{{ Auth::user()->profil->reputasi }}</span>
                <div class="progress">
                    <div class="progress-bar"
                        style="width: {{ (Auth::user()->profil->reputasi)-5 }}%; background-color: red">
                    </div>
                </div>
            </div>
        </div>
        <div class="info-box bg-powder-orange">
            <span class="info-box-icon"><i class="fas fa-bullhorn text-powder-orange-dark"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Mengirim Pertanyaan</span>
                <span class="info-box-number h4 m-0">{{ count(Auth::user()->pertanyaan) }}</span>
            </div>
        </div>
        <div class=" info-box bg-powder-orange">
            <span class="info-box-icon"><i class="fab fa-twitch text-powder-orange-dark"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Menjawab Pertanyaan</span>
                <span class="info-box-number h4 m-0">{{ count(Auth::user()->jawaban) }}</span>
            </div>
        </div>
        <div class="info-box bg-powder-orange">
            <span class="info-box-icon"><i class="fas fa-comment text-powder-orange-dark"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Mengirim Komentar</span>
                <span class="info-box-number h4 m-0">{{ count(Auth::user()->comments) }}</span>
            </div>
        </div>
    </div>
</div>