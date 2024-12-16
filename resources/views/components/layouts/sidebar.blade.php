@php
    $jenis = auth()->user()->jenis;
@endphp

<nav class="col-md-2 bg-dark sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('home') ? 'active-menu' : '' }} text-white"
                    href="{{ route('home') }}">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>

            @if ($jenis === 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('member') ? 'active-menu' : '' }} text-white"
                        href="{{ route('member') }}">
                        <span data-feather="users"></span>
                        Manage Members
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('buku') ? 'active-menu' : '' }} text-white"
                        href="{{ route('buku') }}">
                        <span data-feather="book"></span>
                        Manage Books
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('pinjam') ? 'active-menu' : '' }} text-white"
                        href="{{ route('pinjam') }}">
                        <span data-feather="file"></span>
                        Manage Loans
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('kembali') ? 'active-menu' : '' }} text-white"
                        href="{{ route('kembali') }}">
                        <span data-feather="check-circle"></span>
                        Manage Returns
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('kategori') ? 'active-menu' : '' }} text-white"
                        href="{{ route('kategori') }}">
                        <span data-feather="tag"></span>
                        Manage Categories
                    </a>
                </li>
            @elseif ($jenis === 'member')
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('member') ? 'active-menu' : '' }} text-white"
                        href="{{ route('member') }}">
                        <span data-feather="users"></span>
                        View Members
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('buku') ? 'active-menu' : '' }} text-white"
                        href="{{ route('buku') }}">
                        <span data-feather="book-open"></span>
                        View Books
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('pinjam') ? 'active-menu' : '' }} text-white"
                        href="{{ route('pinjam') }}">
                        <span data-feather="clock"></span>
                        View Loans
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('kembali') ? 'active-menu' : '' }} text-white"
                        href="{{ route('kembali') }}">
                        <span data-feather="check-circle"></span>
                        View Returns
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>
