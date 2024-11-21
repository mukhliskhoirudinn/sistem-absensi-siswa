@extends('backend.template.main')

@section('title', 'Daftar Guru')

@push('css')
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/plugin/datatables/datatables.min.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- Header --}}
            <div class="page-header">
                <h4 class="page-title">Daftar Guru</h4>
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
                </ul>
            </div>
            {{-- End Header --}}

            {{-- Tabel --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between w-100 flex-wrap">
                            <h4 class="card-title">Data Guru</h4>
                            <div>
                                <a href="{{ route('panel.teacher.create') }}" class="btn btn-primary btn-round ms-auto">
                                    <i class="fa fa-plus me-2"></i>Create
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Foto</th> <!-- Kolom Foto -->
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Alamat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teachers as $index => $teacher)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    @if ($teacher->photo)
                                                        <img src="{{ asset('storage/' . $teacher->photo) }}"
                                                            alt="{{ $teacher->name }}" class="img-fluid rounded"
                                                            style="max-width: 50px; height: auto;">
                                                    @else
                                                        <p>No photo</p>
                                                    @endif
                                                </td>
                                                <td>{{ $teacher->nip }}</td>
                                                <td>{{ $teacher->name }}</td>
                                                <td>{{ $teacher->email }}</td>
                                                <td>{{ $teacher->phone }}</td>
                                                <td>{{ Str::limit($teacher->address, 30, '...') }}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Action Buttons">
                                                        <a href="{{ route('panel.teacher.show', $teacher->id) }}"
                                                            class="btn btn-info btn-sm" title="View Details">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('panel.teacher.edit', $teacher->id) }}"
                                                            class="btn btn-warning btn-sm" title="Edit Data">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('panel.teacher.destroy', $teacher->id) }}"
                                                            method="POST" class="delete-form" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm delete-button"
                                                                title="Delete Data">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- DataTables JS -->
    <script src="{{ asset('backend/assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script> <!-- SweetAlert JS -->
    <script>
        $(document).ready(function() {
            $('#basic-datatables').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                lengthChange: true
            });

            $('.delete-button').on('click', function(e) {
                e.preventDefault(); // Mencegah pengiriman form secara default

                const form = $(this).closest('.delete-form'); // Mengambil form terdekat

                // Menampilkan modal konfirmasi
                swal({
                    title: "Anda Yakin?",
                    text: "Data guru ini akan dihapus secara permanen!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        // Mengirimkan form jika pengguna mengkonfirmasi
                        form.submit();

                        // Menampilkan modal sukses setelah pengiriman form
                        swal({
                            title: "Berhasil!",
                            text: "Data guru telah dihapus.",
                            icon: "success",
                            button: "OK",
                            timer: 3000, // Otomatis menutup setelah 3 detik
                        });
                    } else {
                        swal(
                            "Penghapusan dibatalkan!"
                        ); // Menampilkan pesan jika pengguna membatalkan
                    }
                });
            });
        });
    </script>
@endpush
