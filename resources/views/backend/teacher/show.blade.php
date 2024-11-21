@extends('backend.template.main')

@section('title', 'Detail Guru')

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- Header --}}
            <div class="page-header">
                <h4 class="page-title">Detail Guru</h4>
                <ul class="breadcrumbs">
                    <li class="nav-item">
                        <a href="{{ route('panel.dashboard') }}"> <i class="fas fa-home"></i> Dashboard</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('panel.teacher.index') }}">Data Guru</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Detail Guru</a>
                    </li>
                </ul>
            </div>
            {{-- End Header --}}

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <div class="d-flex align-items-center">
                                <!-- Ikon -->
                                <i class="fas fa-user-tie fa-2x me-3"></i>

                                <!-- Teks -->
                                <div class="d-flex flex-column">
                                    <h4 class="card-title mb-0 text-white">Detail Profil : {{ $teacher->name }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>NIP</th>
                                        <td>{{ $teacher->nip }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ $teacher->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $teacher->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $teacher->phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $teacher->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Photo</th>
                                        <td>
                                            @if ($teacher->photo)
                                                <img src="{{ asset('storage/' . $teacher->photo) }}"
                                                    alt="{{ $teacher->name }}" class="img-fluid rounded"
                                                    style="max-width: 120px; height: auto;">
                                            @else
                                                <p>No photo available</p>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-end mt-4">
                                <a href="{{ route('panel.teacher.edit', $teacher->id) }}"
                                    class="btn btn-warning btn-round ms-auto">Edit</a>
                                <a href="{{ route('panel.teacher.index') }}"
                                    class="btn btn-danger btn-round ms-auto">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
