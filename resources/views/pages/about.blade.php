@extends('main')

@section('title', "About")

@section('content')

<div class="jumbotron text-center bg-primary">
    <h1 class="display-4"><strong>Stucknoflow</strong></h1>
    <p class="lead"><strong>Kami buat karena tanpa karena</strong> :D</p>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="info-box bg-success">
            <span class="info-box-icon"><i class="fab fa-github"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Maftukhatul Arifin</span>
                <span class="info-box-number">potatocandie</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="info-box bg-success">
            <span class="info-box-icon"><i class="fab fa-github"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Riski</span>
                <span class="info-box-number">rizkiq</span>
            </div>
        </div>
    </div>
</div>

@endsection