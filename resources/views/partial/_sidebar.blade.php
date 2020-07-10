<div class="card shadow-lg">
    <div class="card-header bg-success">
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
        <div class="info-box bg-success">
            <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Rputasi</span>
                <span class="info-box-number">80</span>
                <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                </div>
            </div>
        </div>
    </div>
</div>