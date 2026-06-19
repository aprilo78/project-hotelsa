<nav class="navbar">
    <a href="{{ route('landing') }}" class="navbar-brand">🏨 DRG Hotel</a>

    <ul class="navbar-nav">
        <li><a href="{{ route('landing') }}">Beranda</a></li>
        <li><a href="{{ route('landing') }}#kamar">Kamar</a></li>
        <li><a href="{{ route('landing') }}#restoran">Restoran</a></li>
        <li><a href="{{ route('landing') }}#tentang">Tentang</a></li>

        @auth
            @php $role = auth()->user()->role->name ?? ''; @endphp
            @if($role === 'admin')
                <li><a href="{{ route('admin.dashboard') }}" style="color:var(--gold)">Dashboard</a></li>
            @elseif($role === 'ceo')
                <li><a href="{{ route('ceo.dashboard') }}" style="color:var(--gold)">Dashboard</a></li>
            @elseif($role === 'resepsionis')
                <li><a href="{{ route('resepsionis.dashboard') }}" style="color:var(--gold)">Dashboard</a></li>
            @elseif($role === 'kasir_hotel')
                <li><a href="{{ route('kasir.hotel.dashboard') }}" style="color:var(--gold)">Dashboard</a></li>
            @elseif($role === 'kasir_restoran')
                <li><a href="{{ route('kasir.restoran.dashboard') }}" style="color:var(--gold)">Dashboard</a></li>
            @else
                <li><a href="{{ route('customer.dashboard') }}" style="color:var(--gold)">Dashboard</a></li>
            @endif

            <li>
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button type="submit" class="btn btn-sm"
                        style="background:rgba(255,255,255,0.1);color:rgba(255,255,255,0.8);border:1px solid rgba(255,255,255,0.25);padding:6px 16px;border-radius:6px;cursor:pointer;font-size:0.85rem">
                        Logout
                    </button>
                </form>
            </li>
        @else
            <li><a href="{{ route('login') }}" style="color:rgba(255,255,255,0.85)">Login</a></li>
            <li>
                <a href="{{ route('register') }}" class="btn btn-gold btn-sm"
                   style="padding:7px 18px;font-size:0.85rem">Daftar</a>
            </li>
        @endauth
    </ul>
</nav>
