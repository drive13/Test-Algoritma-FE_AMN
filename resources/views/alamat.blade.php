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
            <h1>Pilih Lokasi Anda!</h1>
            <div class="row">
                <div class="col">
                    <div class="province">
                        <h3>Provinsi</h3>
                        <select id="select-provinsi" class="form-select">
                            <option value="null" selected>- Pilih Provinsi -</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <h3>Kota/Kabupaten</h3>
                    <select id="select-kota" class="form-select">
                        <option disabled>- Pilih Kota -</option>
                    </select>
                </div>
                <div class="col">
                    <h3>Kecamatan</h3>
                    <select id="select-kecamatan" class="form-select">
                        <option disabled>- Pilih Kecamatan -</option>
                    </select>
                </div>
                <div class="col-12 mt-2">
                    <button class="btn btn-primary" id="submit">Submit</button>
                </div>
            </div>
        </div>

        <!-- Optional JavaScript; choose one of the two! -->
        
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
        {{-- My JS --}}
        <script>
            $(document).ready(function(){
                getProvince();

                function getProvince() {
                    $.ajax({
                        type: 'get',
                        url: "https://drive13.github.io/api-wilayah-indonesia/api/provinces.json",
                        dataType: 'json',
                        success: function (response) {
                            // Loop melalui array objek provinsi
                            $.each(response, function(i, item){
                                var o = new Option(item.name, item.id);
                                $("#select-provinsi").append(o);
                            });
                        },
                        // error: function(jqXHR, textStatus, errorThrown) {
                        //     console.error("Permintaan Ajax gagal:", textStatus, errorThrown);
                        // }
                    });
                };

                $('#select-provinsi').on('change', function(){

                    let provinceID = $('#select-provinsi').find(':selected').val();
                    $("#select-kota").empty();
                    
                    $("#select-kecamatan").empty();
                    // console.log(provinceID);
                        $.ajax({
                            type: 'get',
                            url: 'https://drive13.github.io/api-wilayah-indonesia/api/regencies/' +provinceID+'.json',
                            dataType: 'json',
                            success: function (response) {
                                // console.log(response);
                                // Loop melalui array objek provinsi
                                $.each(response, function(i, item){
                                    var o = new Option(item.name, item.id);
                                    $("#select-kota").append(o);
                                });
                            },
                            // error: function(jqXHR, textStatus, errorThrown) {
                            //     console.error("Permintaan Ajax gagal:", textStatus, errorThrown);
                            // }
                        });
                        $("#select-kota").append('<option selected disabled value="">Pilih Kota</option>');
                        $("#select-kecamatan").append('<option selected disabled value="">Pilih Kecamatan</option>');
                });

                $('#select-kota').on('change', function(){

                    let kotaID = $('#select-kota').find(':selected').val();
                    $("#select-kecamatan").empty();
                    // console.log(kotaID);
                        $.ajax({
                            type: 'get',
                            url: 'https://drive13.github.io/api-wilayah-indonesia/api/districts/' +kotaID+'.json',
                            dataType: 'json',
                            success: function (response) {
                                // console.log(response);
                                // Loop melalui array objek provinsi
                                $.each(response, function(i, item){
                                    var o = new Option(item.name, item.id);
                                    $("#select-kecamatan").append(o);
                                });
                            },
                            // error: function(jqXHR, textStatus, errorThrown) {
                            //     console.error("Permintaan Ajax gagal:", textStatus, errorThrown);
                            // }
                        });
                        // $("#select-kecamatan").append('<option selected disabled value="">Pilih Kecamatan</option>');
                });

                $('#submit').on('click', function(){
                    showLoc();
                });

                function showLoc(){
                    let province = $('#select-provinsi').find(':selected').text();
                    let regency = $('#select-kota').find(':selected').text();
                    let district = $('#select-kecamatan').find(':selected').text();

                    alert("Lokasi anda adalah : Provinsi " + province + ", Kota " + regency + ", Kecamatan " + district);
                }
            });
        </script>
    </body>
</html>