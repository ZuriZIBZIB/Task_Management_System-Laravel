@extends('layouts.guest')

@section('title', 'Verifikasi Email')

@section('content')
    <p class="text-muted small mb-3">
        Terima kasih sudah mendaftar! Sebelum memulai, mohon verifikasi email kamu dengan mengklik link yang sudah kami kirimkan. Kalau belum menerima email-nya, kami bisa kirimkan lagi.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success">
            Link verifikasi baru sudah dikirim ke email kamu.
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary btn-sm">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link btn-sm text-muted">
                Logout
            </button>
        </form>
    </div>
@endsection