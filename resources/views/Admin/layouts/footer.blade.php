<footer class="footer">
    <div class="container">
        <p>© 2025 Company</p>
    </div>
</footer>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
{{-- Bootstrap Bundle Wajib Diload Awal/Tengah agar plugin lain bisa jalan --}}
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>

{{-- 
    PERBAIKAN: 
    ApexCharts & index.js SAYA KOMENTAR/MATIKAN DI SINI.
    Hanya panggil script ini di halaman Dashboard saja menggunakan @push 
--}}
{{-- <script src="{{ asset('assets/plugins/apex/apexcharts.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/index.js') }}"></script> --}}

<script src="{{ asset('assets/js/main.js') }}"></script>
