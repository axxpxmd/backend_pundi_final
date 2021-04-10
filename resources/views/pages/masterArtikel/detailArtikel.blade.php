<div class="card mt-2">
    <div class="card-header white text-center">
        <strong>DETAIL ARTIKEL</strong>
    </div>
    <div class="card-body">
        <div class="ml-3">
            <div class="row">
                <label class="col-sm-5 font-weight-bold">Waktu Publish</label>
                <label class="col-sm-7">: {{ $article->release_date }}</label>
            </div>
            <div class="row">
                <label class="col-sm-5 font-weight-bold">Artikel Dibuat</label>
                <label class="col-sm-7">: {{ $article->created_at }}</label>
            </div>
        </div>
    </div>
</div>