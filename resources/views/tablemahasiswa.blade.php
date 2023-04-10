<table border="1" class="table table-bordered text-center" id="tb-mahasiswa">
    <tr>
        <th>Nomor</th>
        <th>NPM</th>
        <th>Nama</th>
        <th>No HP</th>
        <th>Alamat</th>
        <th>Opsi</th>
    </tr>
    <?php $no = 1; ?>
    @foreach ($mahasiswa as $Get)
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $Get['npm'] }}</td>
            <td>{{ $Get['name'] }}</td>
            <td>{{ $Get['phone'] }}</td>
            <td>{{ $Get['address'] }}</td>
            <td>
                <a href="#" onclick="ModalEditMahasiwa({{ $Get['npm'] }} , '{{ $Get['name'] }}', '{{ $Get['phone'] }}', '{{ $Get['address'] }}')"
                    class="btn btn-warning">Update</a>
                <a href="#" onclick="ModalHapusMahasiwa({{ $Get['npm'] }})" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        <?php $no++;?>
    @endforeach
</table>