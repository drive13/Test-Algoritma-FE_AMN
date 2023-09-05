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
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <title>Hello, world!</title>
    </head>
    <body>
        
        <div class="container-fluid">
            <h1>Daftar Penjualan</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">Kode Barang</th>
                        <th class="text-center" scope="col">Nama Barang</th>
                        <th class="text-center" scope="col">Harga</th>
                        <th class="text-center" scope="col">Jumlah</th>
                        <th class="text-center" scope="col">Sub Total</th>
                        <th class="text-center" scope="col">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> 
                            <select class="select-barang" name="kodeBarang[]" style="width: 100%">
                            </select>
                        </td> 
                        <td><input class="nama-barang" type="text" name="namaBarang[]" required style="width: 100%" readonly></td> 
                        <td>Rp. <input class="harga-barang" type="number" min="0" name="harga[]" required style="width:90%" readonly></td> 
                        <td><input class="qty-barang" type="number" min="1" name="qty[]" value="1" required style="width: 100%"></td> 
                        <td><input class="sub-tot" type="number" min="1" name="subTot[]" required style="width: 100%"></td> 
                        <td class="text-center"><button class="btn btn-sm btn-danger remove-row">X</button></td> 
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td>Grand Total</td>
                        <td class="text-start" colspan="5"><input class="grand-total" type="number" name="grand-total" id="grand-total" readonly></td>
                    </tr>
                </tfoot>
            </table>

            <button class="btn btn-sm btn-success" id="add-row">Add Row</button>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->
        
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
        {{-- My JS --}}
        <script>
            $(document).ready(function(){
                var dataBarang = {};
                loadSelectOptions($(".select-barang:first"));
                var newSelect = $(".select-barang:first");
                    newSelect.select2();

                    newSelect.on("change", function() {
                        var selectedValue = $(this).val();
                        var namaInput = $(this).closest("tr").find(".nama-barang");
                        var hargaInput = $(this).closest("tr").find(".harga-barang");
                        var subTot = $(this).closest("tr").find(".sub-tot");
                        if (dataBarang[selectedValue]) {
                            namaInput.val(dataBarang[selectedValue].nama);
                            hargaInput.val(dataBarang[selectedValue].harga);
                            subTot.val(dataBarang[selectedValue].harga);
                        } else {
                            namaInput.val('');
                            hargaInput.val('');
                            subTot.val('');
                        }

                        updateSubTotalAndGrandTotal();
                    });
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
                                    text: item.kode
                                }));

                                dataBarang[item.id] = {
                                    nama: item.nama,
                                    harga: item.harga
                                };
                            });

                            selectElement.select2();
                        },
                        error: function () {
                            alert('Terjadi kesalahan saat mengambil data barang.');
                        }
                    });
                }

                function updateSubTotalAndGrandTotal() {
                    var grandTotal = 0;

                    $("tbody tr").each(function() {
                        var selectElement = $(this).find(".select-barang");
                        var qtyInput = $(this).find(".qty-barang");
                        var hargaInput = $(this).find(".harga-barang");
                        var subTotalInput = $(this).find(".sub-tot");

                        var selectedValue = selectElement.val();
                        var qty = parseInt(qtyInput.val());
                        var harga = parseInt(hargaInput.val());

                        if (dataBarang[selectedValue] && !isNaN(qty) && !isNaN(harga)) {
                            var subTotal = qty * harga;
                            subTotalInput.val(subTotal);

                            grandTotal += subTotal;
                        } else {
                            subTotalInput.val('');
                        }
                    });

                    $("#grand-total").val(grandTotal);
                }

                $("#add-row").click(function() {
                    var newRow = '<tr>' +
                        '<td>' +
                            '<select class="select-barang" name="kodeBarang[]" style="width: 100%">' +
                            '</select>' +
                        '</td>' + 
                        '<td><input class="nama-barang" type="text" name="namaBarang[]" required style="width: 100%" readonly></td>' + 
                        '<td>Rp. <input class="harga-barang" type="number" min="0" name="harga[]" required style="width:90%" readonly></td>' + 
                        '<td><input class="qty-barang" type="number" min="1" name="qty[]" value="1" required style="width: 100%"></td>' + 
                        '<td><input class="sub-tot" type="number" min="1" name="subTot[]" required style="width: 100%"></td> ' +
                        '<td class="text-center"><button class="btn btn-sm btn-danger remove-row">X</button></td>' +
                        '</tr>';
                    
                    $("tbody").append(newRow);
                    var newSelect = $(".select-barang:last");
                    loadSelectOptions(newSelect); 
                    newSelect.select2();

                    newSelect.on("change", function() {
                        var selectedValue = $(this).val();
                        var namaInput = $(this).closest("tr").find(".nama-barang");
                        var hargaInput = $(this).closest("tr").find(".harga-barang");
                        var subTot = $(this).closest("tr").find(".sub-tot");

                        if (dataBarang[selectedValue]) {
                            namaInput.val(dataBarang[selectedValue].nama);
                            hargaInput.val(dataBarang[selectedValue].harga);
                            subTot.val(dataBarang[selectedValue].harga);
                        } else {
                            namaInput.val('');
                            hargaInput.val('');
                            subTot.val('');
                        }

                        updateSubTotalAndGrandTotal();
                    });

                    $(".qty-barang:last").on("change", function() {
                        updateSubTotalAndGrandTotal();
                    });
                    $(".qty-barang:first").on("change", function() {
                        updateSubTotalAndGrandTotal();
                    });
                });

                $("tbody").on("click", ".remove-row", function() {
                    $(this).closest("tr").remove();
                    updateSubTotalAndGrandTotal();
                });

                $('.select-barang').select2();
            });
        </script>
    </body>
</html>