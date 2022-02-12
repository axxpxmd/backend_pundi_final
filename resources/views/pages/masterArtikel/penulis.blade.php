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
        <table class="ml-3 mt-3 table-responsive">
            <tr>
                <td><span class="font-weight-bold fs-14">Email</span></td>
                <td><span class="fs-14">: {{ $article->author->email }}</span></td>
            </tr>
            <tr>
                <td><span class="font-weight-bold fs-14">No Telp</span></td>
                <td><span class="fs-14">: {{ $article->author->no_telp }}</span></td>
            </tr>
        </table>
    </div>
</div>