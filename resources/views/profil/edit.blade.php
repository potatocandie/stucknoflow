@extends('main')

@section('title', 'Edit Profil')

@section('stylesheet')
<style>
    .img-container {
        height: 200px;
        width: 200px;
        position: relative;
    }

    .img-user {
        border-radius: 50%;
        height: 100%;
        width: 100%;
        border: 6px solid rgb(184, 182, 182);
        object-fit: cover;
        position: relative;
    }

    .overlay {
        position: absolute;
        bottom: 0;
        background-color: #000;
        color: #464444;
        width: 100%;
        transition: .5s ease;
        opacity: 0.5;
        font-size: 20px;
        font-weight: bold;
        padding: 20px;
        background: red;
    }

    .img-container:hover .overlay {
        opacity: 1;
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 m-auto">
        <div class="card shadow-lg">
            <div class="card-header bg-powder text-powder text-center">
                <p class="h5">Profil <strong>{{ $user->name }}</strong></p>
            </div>
            <div class="card-body">
                <form action="{{ route('profil.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3 justify-content-center">
                        <div class="img-container">
                            <img src="{{ is_null(Auth::user()->profil->user_img) ? asset('/images/default_pic.png') : asset('/images/'. Auth::user()->profil->user_img)}}"
                                alt="user" class="img-user">
                            <div class="overlay"><i class="fas fa-camera mr-2"></i>Ganti Foto
                                <input type="file" name="user_img" style="opacity: 0" class="overlay custom-input-file">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 justify-content-center"">
                        <p class=" file-name">
                        </p>
                    </div>
                    <div class=" row p-3">
                        <div class="col-md-6">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" class="form-control mt-1 mb-3" name="name" value="{{ $user->name }}">
                            <label for="email">Alamat Email</label>
                            <input type="text" class="form-control mt-1 mb-3" name="email" value="{{ $user->email }}"
                                disabled>
                            <label for="created_at">Bergabung Pada</label>
                            <input type="text" class="form-control mt-1 mb-3" name="created_at"
                                value="{{ date('j M Y', strtotime($user->created_at)) }}" disabled>
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control mt-1 mb-3" name="tempat_lahir"
                                value="{{ is_null(Auth::user()->profil) ? '' : $user->profil->tempat_lahir }}">
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control mt-1 mb-3" name="tanggal_lahir"
                                value="{{ is_null(Auth::user()->profil) ? '' : $user->profil->tanggal_lahir }}">
                            <label for="jenis_kelamin">Gender</label>
                            <select name="jenis_kelamin" class="form-control mb-3">
                                @if (is_null(Auth::user()->profil))
                                <option value="0">Laki-Laki</option>
                                <option value="1">Perempuan</option>
                                @else
                                <option value="{{ $user->profil->jenis_kelamin }}" selected>
                                    {{ ($user->profil->jenis_kelamin) === 0 ? "Laki-Laki" : "Perempuan" }}
                                </option>
                                <option value="{{ ($user->profil->jenis_kelamin) === 0 ? 1 : 0 }}">
                                    {{ ($user->profil->jenis_kelamin) === 0 ? "Perempuan" : "Laki-Laki" }}
                                </option>
                                @endif
                            </select>
                            <label for="akun_github">Akun Github</label>
                            <input type="text" class="form-control mt-1 mb-3" name="akun_github"
                                value="{{ is_null(Auth::user()->profil) ? '' : $user->profil->akun_github }}">
                        </div>
                        <button type="submit" class="btn btn-outline-primary btn-block m-1">Update Profil</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(".custom-input-file").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(".file-name").text(fileName);
    });
</script>
@endpush