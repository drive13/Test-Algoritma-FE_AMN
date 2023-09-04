<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Hello, world!</title>
    </head>
    <body>
        
        <div class="container-fluid">
            <h1>Daftar Penjualan</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">Nama Barang</th>
                        <th class="text-center" scope="col">Jumlah</th>
                        <th class="text-center" scope="col">Harga</th>
                        <th class="text-center" scope="col">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        {{-- <td>
                            <select class="form-select select-barang" name="barang">
                                <option value="">Pilih Barang</option>
                            </select>
                        </td>
                        <td><input type="number" min="1" name="qty" id="qty" value="1" required></td>
                        <td>Rp. <input type="number" min="0" name="harga" id="harga" required></td>
                        <td class="text-center"><button class="btn btn-sm btn-danger remove-row">X</button></td> --}}
                    </tr>
                </tbody>
            </table>

            <button class="btn btn-sm btn-success" id="add-row">Add Row</button>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->
        
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
        {{-- My JS --}}
        <script>
            $(document).ready(function(){
                // Tangani peristiwa klik pada elemen dengan class select-barang
                // Fungsi untuk mengisi opsi-opsi select dengan data barang
                function loadSelectOptions(selectElement) {
                    // Periksa apakah opsi-opsi sudah diisi sebelumnya
                    if (selectElement.find('option').length > 1) {
                        return; // Jika sudah diisi sebelumnya, keluar dari fungsi
                    }

                    // Buat permintaan AJAX untuk mengambil data barang
                    $.ajax({
                        url: '/products', // Ganti dengan URL endpoint yang sesuai
                        method: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            // Isi opsi-opsi select dengan data yang diterima dari server
                            data.forEach(function (item) {
                                selectElement.append($('<option>', {
                                    value: item.id, // Gantilah 'id' dengan properti yang sesuai
                                    text: item.nama // Gantilah 'nama_barang' dengan properti yang sesuai
                                }));
                            });
                        },
                        error: function () {
                            // Tangani kesalahan jika terjadi
                            alert('Terjadi kesalahan saat mengambil data barang.');
                        }
                    });
                }

                // ...

                // Menambahkan baris saat tombol "Add Row" diklik
                $("#add-row").click(function() {
                    var newRow = '<tr>' +
                        '<td>' +
                        '    <select class="form-select select-barang" name="barang">' + // Tambahkan onchange di sini
                        '        <option value="">Pilih Barang</option>' +
                        '        <!-- Daftar opsi barang di sini -->' +
                        '    </select>' +
                        '</td>' +
                        '<td><input type="number" min="1" name="qty" value="1" required></td>' +
                        '<td>Rp. <input type="number" min="0" name="harga" required></td>' +
                        '<td class="text-center"><button class="btn btn-sm btn-danger remove-row">X</button></td>' +
                        '</tr>';
                    
                    $("tbody").append(newRow);
                    loadSelectOptions($(".select-barang:last")); // Mengisi opsi select yang baru ditambahkan
                });

                // Menghapus baris saat tombol "X" diklik
                $("tbody").on("click", ".remove-row", function() {
                    $(this).closest("tr").remove();
                });
                
            });
        </script>
    </body>
</html>