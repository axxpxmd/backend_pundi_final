<div class="card">
    <div class="card-header white text-center">
        <strong>PENULIS</strong>
    </div>
    <div class="card-body">
        <div class="text-center">
            @if (Storage::disk('ftp')->exists('images/ava/' . $article->author->photo) == true)
            <img class="mx-auto d-block rounded-circle img-circular" height="80" width="80"  src="{{ config('app.ftp_src').$path.$article->author->photo }}" alt="photo">
            @else
            <img class="mx-auto d-block rounded-circle img-circular" width="80" src="{{ asset('images/ava/default.png') }}" alt="photo">
            @endif
            <p class="mt-2 font-weight-bold" style="margin-bottom: -3px">{{ $article->author->name }}</p>
            <span>{{ $article->author->bio }}</span>
        </div>
        <div class="mt-3 ml-3">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <label class="form-control-plaintext -ml-30">:&nbsp; {{ $article->author->email }}</label>
                </div>
            </div>
            <div class="form-group row -mt-20">
                <label class="col-sm-3 col-form-label">Kontak</label>
                <div class="col-sm-9">
                    <label class="form-control-plaintext -ml-30">:&nbsp; {{ $article->author->no_telp }}</label>
                </div>
            </div>
        </div>
    </div>
</div>