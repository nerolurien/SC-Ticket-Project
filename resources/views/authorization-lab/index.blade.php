@extends('layouts.app')

@section('title', 'Lab Otorisasi (RBAC)')

@section('content')
<div class="container-fluid">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold"><i class="bi bi-person-badge text-primary"></i> Lab Otorisasi (RBAC)</h1>
        <p class="lead text-muted">Mempelajari Role-Based Access Control pada Laravel</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    <i class="bi bi-info-circle"></i> Skenario Lab
                </div>
                <div class="card-body">
                    <p>Sistem ini menggunakan 3 jenis Role (Peran) untuk membatasi akses:</p>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item">
                            <span class="badge bg-danger">Admin</span> : Memiliki akses penuh ke seluruh sistem (Dashboard Admin, Kelola User, Semua Tiket).
                        </li>
                        <li class="list-group-item">
                            <span class="badge bg-info">Staff</span> : Bisa melihat laporan dan menangani tiket yang ditugaskan kepadanya.
                        </li>
                        <li class="list-group-item">
                            <span class="badge bg-secondary">User</span> : Hanya bisa membuat tiket dan melihat tiket miliknya sendiri.
                        </li>
                    </ul>
                    <a href="{{ route('authorization-lab.login') }}" class="btn btn-outline-primary w-100">
                        <i class="bi bi-arrow-right-circle"></i> Mulai Simulasi Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection