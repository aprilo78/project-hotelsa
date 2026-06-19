<footer>
    <div class="container">
        <div class="footer-grid">
            <div>
                <div class="footer-brand">🏨 DRG Hotel</div>
                <p class="footer-desc">
                    Hotel premium yang menghadirkan pengalaman menginap mewah dengan sentuhan keramahan Indonesia.
                    Kami berkomitmen memberikan pelayanan terbaik untuk setiap tamu.
                </p>
            </div>

            <div class="footer-col">
                <h4>Navigasi</h4>
                <ul>
                    <li><a href="{{ route('landing') }}">Beranda</a></li>
                    <li><a href="{{ route('landing') }}#kamar">Kamar & Suite</a></li>
                    <li><a href="{{ route('landing') }}#restoran">Restoran</a></li>
                    <li><a href="{{ route('landing') }}#tentang">Tentang Kami</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Layanan</h4>
                <ul>
                    <li><a href="#">Booking Kamar</a></li>
                    <li><a href="#">Reservasi Restoran</a></li>
                    <li><a href="#">Event & Meeting</a></li>
                    <li><a href="#">Spa & Wellness</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Kontak</h4>
                <ul>
                    <li><a href="#">📍 Jl. Hotel Raya No. 1</a></li>
                    <li><a href="tel:+62211234567">📞 (021) 123-4567</a></li>
                    <li><a href="mailto:info@drghotel.com">✉️ info@drghotel.com</a></li>
                    <li><a href="#">🕐 24 Jam / 7 Hari</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            © {{ date('Y') }} DRG Hotel. Semua hak dilindungi undang-undang.
        </div>
    </div>
</footer>
