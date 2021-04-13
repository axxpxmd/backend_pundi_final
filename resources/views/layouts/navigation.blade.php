@php
    $articleNotPublish = App\Models\Article::where('status', 0)->count();
@endphp
<ul class="sidebar-menu">
    <li class="header"><strong>MAIN NAVIGATION</strong></li>
    <li>
        <a href="{{ route('home') }}">
            <i class="icon icon-dashboard2 blue-text s-18"></i> 
            <span>Dashboard</span>
        </a>
    </li>
    @can('master-role')
    <li class="header light"><strong>ROLE</strong></li>
    <li class="no-b">
        <a href="{{ route('master-role.permission.index') }}">
            <i class="icon icon-clipboard-list text-red s-18"></i> 
            <span>Permission</span>
        </a>
    </li>
    <li>
        <a href="{{ route('master-role.role.index') }}">
            <i class="icon icon-key3 amber-text s-18"></i> 
            <span>Role</span>
        </a>
    </li>
    @endcan
    <li class="header light"><strong>PENGGUNA</strong></li>
    <li class="no-b">
        <a href="{{ route('pengguna.index') }}">
            <i class="icon icon-user-o cyan-text s-18"></i> 
            <span>Pengguna</span>
        </a>
    </li>
    <li class="header light"><strong>KATEGORI</strong></li>
    <li class="no-b">
        <a href="{{ route('kategori.index') }}">
            <i class="icon icon-list text-red s-18"></i> 
            <span>Kategori</span>
        </a>
        <a href="{{ route('sub-kategori.index') }}">
            <i class="icon icon-list green-text s-18"></i> 
            <span>Sub Kategori</span>
        </a>
        <a href="{{ route('judul-section.index') }}">
            <i class="icon icon-list text-black s-18"></i> 
            <span>Judul Section</span>
        </a>
    </li>
    <li class="header light"><strong>USER</strong></li>
    <li class="no-b">
        <a href="{{ route('master-user.index') }}">
            <i class="icon icon-user-circle-o text-yellow s-18"></i> 
            <span>User</span>
        </a>
    </li>
    <li class="header light"><strong>ARTIKEL</strong></li>
    <li class="no-b">
        {{-- <li class="no-b">
            <a href="#">
                <i class="icon icon-document-checked text-success s-18"></i> 
                <span>Terverifikasi</span>
            </a>
        </li> --}}
        <li class="no-b">
            <a href="{{ route('artikel.publish.index') }}">
                <i class="icon icon-clipboard-upload cyan-text s-18"></i> 
                <span>Publish Artikel</span>
                <span class="badge badge-danger pull-right">{{ $articleNotPublish }}</span>
            </a>
        </li>
        <li class="no-b">
            <a href="{{ route('artikel.semua.index') }}">
                <i class="icon icon-document text-danger s-18"></i>  
                <span>Artikel</span>
            </a>
        </li>
        {{-- <li class="treeview">
            <a href="#">
                <i class="icon icon-documents purple-text s-18"></i><span>Posisi Artikel</span><i class="icon icon-angle-left s-18 pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a href="panel-page-dashboard1-rtl.html"><i class="icon icon-file-o"></i>Artikel 1</a></li>
                <li><a href="panel-page-dashboard1-rtl.html"><i class="icon icon-file-o"></i>Artikel 2</a></li>
                <li><a href="panel-page-dashboard1-rtl.html"><i class="icon icon-file-o"></i>Artikel 3</a></li>
                <li><a href="panel-page-dashboard1-rtl.html"><i class="icon icon-file-o"></i>Artikel 4</a></li>
                <li><a href="panel-page-dashboard1-rtl.html"><i class="icon icon-file-o"></i>Artikel 5</a></li>
            </ul>
        </li> --}}
    </li>
    <li class="header light"><strong>GAMBAR</strong></li>
    <li class="no-b">
        <a href="#">
            <i class="icon icon-picture-o text-blue s-18"></i> 
            <span>Logo</span>
        </a>
        <a href="{{ route("gambar.poster.index") }}">
            <i class="icon icon-file-picture-o amber-text s-18"></i> 
            <span>Poster</span>
        </a>
    </li>
    <li class="header light"><strong>KONSULTASI</strong></li>
    <li class="no-b">
        <a href="#">
            <i class="icon icon-question-circle-o green-text s-18"></i> 
            <span>Pertanyaan</span>
        </a>
        <a href="#">
            <i class="icon icon-document-text3 amber-text s-18"></i> 
            <span>Konsultasi</span>
        </a>
    </li>
    <li class="header light"><strong>KOMEN</strong></li>
    <li class="no-b">
        <a href="#">
            <i class="icon icon-comments-o blue-text s-18"></i> 
            <span>Komentar</span>
        </a>
    </li>
</ul>
