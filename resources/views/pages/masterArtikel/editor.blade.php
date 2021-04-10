<div class="card mt-2">
    <div class="card-header white text-center">
        <strong>EDITOR</strong>
    </div>
    <div class="card-body">
        <div class="ml-3">
            <div class="row">
                <label class="col-sm-3 font-weight-bold">Nama</label>
                <label class="col-sm-8">: {{ $article->editor_id == null ? '-' : $article->editor->adminDetail->nama }}</label>
            </div>
            <div class="row">
                <label class="col-sm-3 font-weight-bold">No Telp</label>
                <label class="col-sm-8">: {{ $article->editor_id == null ? '-' : $article->editor->adminDetail->no_telp }}</label>
            </div>
        </div>
    </div>
</div>