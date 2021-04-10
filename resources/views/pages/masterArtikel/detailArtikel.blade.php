<div class="card mt-2">
    <div class="card-header white text-center">
        <strong>DETAIL ARTIKEL</strong>
    </div>
    <div class="card-body">
        <div class="ml-3">
            <div class="form-group row">
                <label class="col-sm-5 col-form-label">Waktu Publish</label>
                <div class="col-sm-7">
                    <label class="form-control-plaintext -ml-30">:&nbsp; {{ $article->release_date }}</label>
                </div>
            </div>
            <div class="form-group row -mt-20">
                <label class="col-sm-5 col-form-label">Artikel Dibuat</label>
                <div class="col-sm-7">
                    <label class="form-control-plaintext -ml-30">:&nbsp; {{ $article->created_at }}</label>
                </div>
            </div>
        </div>
    </div>
</div>