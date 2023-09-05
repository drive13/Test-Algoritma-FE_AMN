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
                        <td> 
                            <select class="form-select select-barang" name="barang"> 
                                <option value="">Pilih Barang</option> 
                                <!-- Daftar opsi barang di sini --> 
                            </select> 
                        </td> 
                        <td><input type="number" min="1" name="qty" value="1" required></td> 
                        <td>Rp. <input type="number" min="0" name="harga" required></td> 
                        <td class="text-center"><button class="btn btn-sm btn-danger remove-row">X</button></td> 
                        </tr>
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
                loadSelectOptions($(".select-barang:first")); 
                function loadSelectOptions(selectElement) {
                    if (selectElement.find('option').length > 1) {
                        return; 
                    }
                    
                    $.ajax({
                        url: '/products', 
                        method: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            data.forEach(function (item) {
                                selectElement.append($('<option>', {
                                    value: item.id, 
                                    text: item.nama 
                                }));
                            });
                        },
                        error: function () {
                            alert('Terjadi kesalahan saat mengambil data barang.');
                        }
                    });
                }

                $("#add-row").click(function() {
                    var newRow = '<tr>' +
                        '<td>' +
                        '    <select class="form-select select-barang" name="barang">' +
                        '        <option value="">Pilih Barang</option>' +
                        '        <!-- Daftar opsi barang di sini -->' +
                        '    </select>' +
                        '</td>' +
                        '<td><input type="number" min="1" name="qty" value="1" required></td>' +
                        '<td>Rp. <input type="number" min="0" name="harga" required></td>' +
                        '<td class="text-center"><button class="btn btn-sm btn-danger remove-row">X</button></td>' +
                        '</tr>';
                    
                    $("tbody").append(newRow);
                    loadSelectOptions($(".select-barang:last")); 
                });

                $("tbody").on("click", ".remove-row", function() {
                    $(this).closest("tr").remove();
                });
                
            });
        </script>
    </body>
</html>