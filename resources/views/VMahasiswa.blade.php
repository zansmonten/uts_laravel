@extends('Layout')
@section('Content')
    <h3 class="text-center">Table Mahasiswa</h3>
    <a href="#" onclick="ModalTambahMahasiwa()" class="btn btn-success mb-3"> + Add New Data</a>

    <div id="loaddata">
        @include('tablemahasiswa')
    </div>

    <form action="" method="post">
        @csrf
        <div class="modal fade" id="ModalTambahMahasiwa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Form Tambah</h5>
                        <button type="button" onclick="Batal()" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div id="errMsg"></div>

                        <div class="mb-3">
                            <label class="form-label">NPM</label>
                            <input type="text" class="form-control" name="npm" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <textarea name="n_mahasiswa" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No HP</label>
                            <input name="hp_mahasiswa" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="a_mahasiswa" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="Batal()" data-bs-dismiss="modal" id="btn-batal">Batal</button>
                        <input type="button" class="btn btn-primary" id="btn-tambah" value="Simpan">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="" method="delete">
        @csrf
        <div class="modal fade" id="ModalHapusMahasiwa" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Form Hapus</h5>
                        <button type="button" class="btn-close" id="btn-batal" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
                    <div class="modal-footer">
                        <input type="hidden" name="npm_d">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Batal</button>
                        <input type="button" class="btn btn-primary" id="btn-delete" value="Hapus">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="" method="put">
        @csrf
        <div class="modal fade" id="ModalEditMahasiwa" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Form Ubah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div id="errMsg_e"></div>

                        <div class="mb-3">
                            <label class="form-label">NPM</label>
                            <input type="text" class="form-control" name="npm_e" required readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="n_mahasiswa_e" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No HP</label>
                            <input name="hp_mahasiswa_e" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="a_mahasiswa_e" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Batal</button>
                        <input type="button" class="btn btn-primary" id="btn-ubah" value="Ubah">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function ModalTambahMahasiwa() {
            $('#ModalTambahMahasiwa').modal('show');
            $('#ModalTambahMahasiwa').on('shown.bs.modal', function() {
                $('[name="npm"]').focus()
            })
        };

        function ModalHapusMahasiwa($id) {
            $('[name="npm_d"]').val($id);
            $('#ModalHapusMahasiwa').modal('show');
        };

        function ModalEditMahasiwa(id, nama, nohp, alamat) {

            $('[name="npm_e"]').val(id);
            $('[name="n_mahasiswa_e"]').val(nama);
            $('[name="hp_mahasiswa_e"]').val(nohp);
            $('[name="a_mahasiswa_e"]').val(alamat);
            $('#ModalEditMahasiwa').modal('show');

            $('#ModalEditMahasiwa').on('shown.bs.modal', function() {
                $('[name="n_mahasiswa_e"]').focus()
            })

        };

        $("#btn-tambah").on('click', function() {
            let npm = $('[name="npm"]').val();
            let nama = $('[name="n_mahasiswa"]').val();
            let nohp = $('[name="hp_mahasiswa"]').val();
            let alamat = $('[name="a_mahasiswa"]').val();
            $.ajax({
                method: 'POST',
                url: "{{ route('mahasiswa/tambah') }}",
                data: {
                    npm: npm,
                    nama: nama,
                    nohp: nohp,
                    alamat: alamat,
                },
                success: function() {
                    $('[name="npm"]').val('');
                    $('[name="n_mahasiswa"]').val('');
                    $('[name="hp_mahasiswa"]').val('');
                    $('[name="a_mahasiswa"]').val('');
                    $('#errMsg').html('')
                    $('#ModalTambahMahasiwa').modal('hide');
                    LoadData()
                },
                error: function(err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('#errMsg').append('<span class="text-danger">' + value +
                            '</span><br>')
                    });
                },
            });
        });

        $("#btn-delete").on('click', function() {
            let npm = $('[name="npm_d"]').val();
            $.ajax({
                method: 'DELETE',
                url: "{{ route('mahasiswa/hapus') }}",
                data: {
                    npm: npm
                },
                success: function() {
                    $('[name="npm_d"]').val('');
                    $('#ModalHapusMahasiwa').modal('hide');
                    LoadData()
                }
            });
        });

        $("#btn-ubah").on('click', function() {
            let npm = $('[name="npm_e"]').val();
            let nama = $('[name="n_mahasiswa_e"]').val();
            let nohp = $('[name="hp_mahasiswa_e"]').val();
            let alamat = $('[name="a_mahasiswa_e"]').val();
            console.log(npm + nama + alamat + nohp);
            $.ajax({
                method: 'PUT',
                url: "{{ route('mahasiswa/edit') }}",
                data: {
                    npm: npm,
                    nama: nama,
                    nohp: nohp,
                    alamat: alamat,
                },
                success: function() {
                    $('[name="npm_e"]').val('');
                    $('[name="n_mahasiswa_e"]').val('');
                    $('[name="hp_mahasiswa_e"]').val('');
                    $('[name="a_mahasiswa_e"]').val('');
                    $('#errMsg_e').html('')
                    $('#ModalEditMahasiwa').modal('hide');
                    LoadData()
                },
                error: function(err) {
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('#errMsg_e').append('<span class="text-danger">' + value +
                            '</span><br>')
                    });
                },
            });
        });

        function LoadData() {
            $.get("{{ url('mahasiswa/tampilkan') }}", {}, function(mahasiswa, status) {
                $('#loaddata').html(mahasiswa);
            })
        };

        function Batal() {
            $('[name="npm"]').val('');
            $('[name="n_mahasiswa"]').val('');
            $('[name="hp_mahasiswa"]').val('');
            $('[name="a_mahasiswa"]').val('');
            $('#errMsg').html('')
        };
    </script>
@endsection