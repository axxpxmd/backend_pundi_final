@extends('layouts.app')
@section('title', '| '.$title.'')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
<div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon icon-clipboard-upload"></i>
                        Menampilkan Artikel
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul role="tablist" class="nav nav-material nav-material-white responsive-tab">
                    <li>
                        <a class="nav-link" href="{{ route($route.'index') }}"><i class="icon icon-arrow_back"></i>Kembali</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active show" id="tab1" data-toggle="tab" href="#semua-data" role="tab"><i class="icon icon-document"></i>Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab2" data-toggle="tab" href="#edit-data" role="tab"><i class="icon icon-document-edit"></i>Edit Artikel</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid relative animatedParent animateOnce">
        <div class="mt-3">
            @include('layouts.alerts')
        </div>
        <div class="tab-content mt-3" id="pills-tabContent">
            <div class="tab-pane animated fadeInUpShort show active" id="semua-data" role="tabpanel">
                <div class="row">
                    <div class="col-md-3 pr-0">
                        <!-- Author -->
                        @include('pages.masterArtikel.penulis')
                        <!-- Editor -->
                        @include('pages.masterArtikel.editor')
                        <!-- Detail Article -->
                        @include('pages.masterArtikel.detailArtikel')
                        <!-- Action -->
                        <div class="card  mt-2">
                            <div class="card-header white text-center">
                                <strong>AKSI UNTUK ARTIKEL</strong>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    @if ($article->status == 0)
                                    <form action="{{ route('artikel.publish.publishArticle', $article->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('POST') }}
                                        <button type="submit" class="btn btn-sm btn-primary mr-1"><i class="icon-publish mr-1"></i>Publish</button>
                                        <button class="btn btn-sm btn-secondary">
                                            <a class="text-white" href="{{ route('artikel.publish.index') }}"><i class="icon-arrow_back mr-1"></i>Kembali</a>
                                        </button>
                                    </form>
                                    @else
                                    <button class="btn btn-sm btn-danger mr-1" data-toggle="modal" data-target="#unpublish"><i class="icon-undo mr-1"></i>Tarik Artikel</button>
                                    <button class="btn btn-sm btn-secondary">
                                        <a class="text-white" href="{{ route('artikel.publish.index') }}"><i class="icon-arrow_back mr-1"></i>Kembali</a>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Arikel -->
                    <div class="col-md-9 justify-content-center">
                        <div class="card ">
                            <div class="card-header white text-center">
                                <strong>ARTIKEL</strong>
                            </div>
                            <div class="card-body">
                                <img class="mx-auto d-block img-fluid rounded" width="300"  src="{{ config('app.ftp_src').'/images/artikel/'.$article->image }}" alt="photo">
                                <h6 class="text-center m-1">{{ $article->source_image != null ? $article->source_image : '-' }}</h6>
                                <h4 class="font-weight-bold text-center mt-3">{{ $article->title }}</h4>
                                <div class="m-r-100 m-l-100">
                                    {!! $article->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit Artikel -->
            @include('pages.masterArtikel.belumTerverifikasi.edit')
        </div>
    </div>
    <div class="modal fade" id="unpublish" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">
                        Yakin ingin menarik artikel ini ?
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">
                        <i class="icon-cancel mr-1"></i><span class="fs-14">Cancel</span>
                    </button>
                    <form action="{{ route('artikel.publish.unPublishArticle', $article->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <button class="btn btn-sm btn-danger"><i class="icon-undo mr-1"></i>Tarik Artikel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.js"></script>
<script type="text/javascript">
    (function () {
        'use strict';
        $('.input-file').each(function () {
            var $input = $(this),
                $label = $input.next('.js-labelFile'),
                labelVal = $label.html();

            $input.on('change', function (element) {
                var fileName = '';
                if (element.target.value) fileName = element.target.value.split('\\').pop();
                fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label
                    .removeClass('has-file').html(labelVal);
            });
        });
    })();

    function tampilkanPreview(gambar, idpreview) {
        var gb = gambar.files;
        for (var i = 0; i < gb.length; i++) {
            var gbPreview = gb[i];
            var imageType = /image.*/;
            var preview = document.getElementById(idpreview);
            var reader = new FileReader();
            if (gbPreview.type.match(imageType)) {
                preview.file = gbPreview;
                reader.onload = (function (element) {
                    return function (e) {
                        element.src = e.target.result;
                    };
                })(preview);
                reader.readAsDataURL(gbPreview);
            } else {
                $.confirm({
                    title: '',
                    content: 'Tipe file tidak boleh! haruf format gambar (png, jpg)',
                    icon: 'icon icon-close',
                    theme: 'modern',
                    closeIcon: true,
                    animation: 'scale',
                    type: 'red',
                    buttons: {
                        ok: {
                            text: "ok!",
                            btnClass: 'btn-primary',
                            keys: ['enter'],
                        }
                    }
                });
            }
        }
    }

    $('#editor').summernote({
        placeholder: 'Tulis disini ...',
        tabsize: 2,
        height: 600,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear', 'italic']],
            ['fontsize', ['fontsize']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['insert', ['picture']],
            ['paragraph', ['ul', 'ol', 'paragraph', 'height']],
            ['view', ['fullscreen', 'codeview']]
        ]
    });
</script>
@endsection
