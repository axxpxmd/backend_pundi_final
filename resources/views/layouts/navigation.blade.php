<ul class="sidebar-menu">
    <li class="header"><strong>MAIN NAVIGATION</strong></li>
    <li>
        <a href="{{ route('home') }}">
            <i class="icon icon-dashboard2 blue-text s-18"></i> 
            <span>Dashboard</span>
        </a>
    </li>
    @can('role')
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
    @can('pengguna')
    <li class="header light"><strong>PENGGUNA</strong></li>
    <li class="no-b">
        <a href="{{ route('pengguna.index') }}">
            <i class="icon icon-user-o cyan-text s-18"></i> 
            <span>Pengguna</span>
        </a>
    </li>
    @endcan
    @can('kategori')
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
    @endcan
    @can('user')
    <li class="header light"><strong>USER</strong></li>
    <li class="no-b">
        <a href="{{ route('master-user.index') }}">
            <i class="icon icon-user-circle-o text-yellow s-18"></i> 
            <span>User</span>
        </a>
    </li>
    @endcan
    @can('artikel')
    <li class="header light"><strong>ARTIKEL</strong></li>
    <li class="no-b">
        <li class="no-b">
            <a href="{{ route('artikel.publish.index') }}">
                <i class="icon icon-clipboard-upload cyan-text s-18"></i> 
                <span>Publish Artikel</span>
                <span class="badge badge-danger pull-right">{{ $articleNotPublish }}</span>
            </a>
        </li>
        <li class="no-b">
            <a href="{{ route('artikel.semua.index') }}">
                <i class="icon icon-list text-danger s-18"></i>  
                <span>Artikel</span>
            </a>
        </li>
    </li>
    @endcan
    @can('gambar')
    <li class="header light"><strong>GAMBAR</strong></li>
    <li class="no-b">
        <a href="{{ route("gambar.poster.index") }}">
            <i class="icon icon-file-picture-o amber-text s-18"></i> 
            <span>Poster</span>
        </a>
    </li>
    @endcan
    @can('konsultasi')
    <li class="header light"><strong>KONSULTASI</strong></li>
    <li class="no-b">
        <a href="{{ route('pertanyaan.index') }}">
            <i class="icon icon-question-circle-o green-text s-18"></i> 
            <span>Pertanyaan</span>
        </a>
        <a href="{{ route('konsultasi.index') }}">
            <i class="icon icon-document-text3 amber-text s-18"></i> 
            <span>Konsultasi</span>
        </a>
    </li>
    @endcan
    @can('komen')
    <li class="header light"><strong>KOMEN</strong></li>
    <li class="no-b">
        <a href="{{ route('komentar.index') }}">
            <i class="icon icon-comment-o blue-text s-18"></i> 
            <span>Komentar</span>
        </a>
    </li>
    @endcan
</ul>
