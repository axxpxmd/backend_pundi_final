<ul class="sidebar-menu">
    <li class="header"><strong>MAIN NAVIGATION</strong></li>
    <li>
        <a href="{{ route('home') }}">
            <i class="icon icon-dashboard2 blue-text s-18"></i> 
            <span>Dashboard</span>
        </a>
    </li>
    @can('master-role')
    <li class="header light"><strong>MASTER ROLE</strong></li>
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
    <li class="header light"><strong>MASTER PENGGUNA</strong></li>
    <li class="no-b">
        <a href="{{ route('pengguna.index') }}">
            <i class="icon icon-user-o text-success s-18"></i> 
            <span>Pengguna</span>
        </a>
    </li>
</ul>
