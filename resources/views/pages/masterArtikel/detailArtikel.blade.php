<div class="card mt-2">
    <div class="card-header white text-center">
        <strong>DETAIL ARTIKEL</strong>
    </div>
    <div class="card-body">
        <div class="ml-3">
            <div class="row">
                <label class="col-sm-5 font-weight-bold">Artikel Publish</label>
                <label class="col-sm-7">: {{ $article->release_date != null ? Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $article->release_date)->format('d M Y | h:i:s') : '-' }}</label>
            </div>
            <div class="row">
                <label class="col-sm-5 font-weight-bold">Artikel Dibuat</label>
                <label class="col-sm-7">: {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $article->created_at)->format('d M Y | h:i:s') }}</label>
            </div>
            <div class="row">
                <label class="col-sm-5 font-weight-bold">Artikel Dirubah</label>
                <label class="col-sm-7">: {{ $article->updated_at != null ? Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $article->updated_at)->format('d M Y | h:i:s') : '-' }}</label>
            </div>
        </div>
    </div>
</div>