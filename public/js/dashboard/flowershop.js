getKategori();

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
}

var breadcrumb = $('#flowerShopBreadcrumb');
breadcrumb.hide();

function getKategori(){

    $.ajax({
        url: '/get-kategori',
        method: 'get',
        success: function(data){
            console.log('Success : ', data);
            var item = $('#flowerShopList');
            item.empty();
            breadcrumb.empty();
            breadcrumb.hide();
            for(var i=0; i<data.length; i++){
                item.append('<div class="col-6 col-md-4 card-flower-shop mgb-10 d-flex justify-content-center" type="button" onclick="getSubKategori('+ data[i].idKategori +')"><img src="/images/kategori/'+ data[i].fotoKategori +'" alt="Recomendation" class="card-flower-class-image mgb-10"><div class="card-flower-class-text text-center"><p class="font-heading-5 font-alegreya">'+ data[i].namaKategori +'</p></div></div>');
            }

        },
        error: function(data){
            console.log('Error : ', data);

        }
    })
}

function getSubKategori(idKategori){

    $.ajax({
        url: '/get-sub-kategori',
        method: 'post',
        data:{
            idKategori: idKategori
        },
        success: function(data){
            console.log('Success : ', data);
            breadcrumb.show();
            breadcrumb.empty();
            var item = $('#flowerShopList');
            item.empty();
            for(var i=0; i<data.length; i++){
                var namaKategori = data[i].namaKategori;
                item.append('<div class="col-6 col-md-4 card-flower-shop mgb-10 d-flex justify-content-center" onclick="getBarang('+ data[i].idSubKategori +')"><img src="/images/subkategori/'+ data[i].fotoSubKategori +'" alt="Recomendation" class="card-flower-class-image mgb-10"><div class="card-flower-class-text text-center"><p class="font-heading-5 font-alegreya">'+ data[i].namaSubKategori +'</p></div></div>');
            }
            breadcrumb.append('<li class="breadcrumb-item active font-alegreya" onclick="getKategori()">'+ namaKategori +'</li>');
        },
        error: function(data){
            console.log('Error : ', data);

        }
    })
}

function getBarang(idSubKategori){

    $.ajax({
        url: '/get-barang',
        method: 'post',
        data:{
            idSubKategori: idSubKategori
        },
        success: function(data){
            console.log('Success : ', data);
            var item = $('#flowerShopList');
            item.empty();
            for(var i=0; i<data.length; i++){
                var foto = data[i].fotoBarang;
                var id = data[i].idSubKategori;
                var namaSubKategori = data[i].namaSubKategori;
                if(foto == null || foto == ''){
                    foto = 'default.jpg';
                }
                // item.append('<div class="col-6 col-md-4 card-flower-shop mgb-10 d-flex justify-content-center" onclick="window.location.href=\'https:wa.me/6281338540524?text=Halo min odoroki, %0asaya mau pesan '+ data[i].namaBarang +'\'"><img src="/images/barang/'+ foto +'" alt="Recomendation" class="card-flower-class-image mgb-10"><div class="card-flower-class-text text-center"><p class="font-heading-5 font-alegreya">'+ data[i].namaBarang +'</p><p class="font-heading-5 font-alegreya">IDR '+ formatNumber(data[i].hargaBarang) +'</p></div></div>');
                item.append('<div class="col-6 col-md-4 card-flower-shop mgb-10 d-flex justify-content-center" onclick="openModal('+ data[i].idBarang +')"><img src="/images/barang/'+ foto +'" alt="Recomendation" class="card-flower-class-image mgb-10"><div class="card-flower-class-text text-center"><p class="font-heading-5 font-alegreya">'+ data[i].namaBarang +'</p><p class="font-heading-5 font-alegreya">IDR '+ formatNumber(data[i].hargaBarang) +'</p></div></div>');
            }
            breadcrumb.append('<li class="breadcrumb-item active font-alegreya" onclick="getSubKategori('+ id +')">'+ namaSubKategori +'</li>');
        },
        error: function(data){
            console.log('Error : ', data);

        }
    })

}

// modal
var modalImage = $('#flowerShopModalImage');
var modalNamaProduk = $('#flowerShopModalNamaProduk');
var modalLabel = $('#modalLabel');
var modalHargaProduk = $('#flowerShopModalHargaProduk');
var modalKeterangan = $('#flowerShopModalKeterangan');
var modalVarian = $('#flowerShopModalVarian');
var modalSubTotal = $('#flowerShopModalSubTotal');
var namaBarang = '';
var namaSubKategori = '';
var namaKategori = '';

function openModal(idBarang){
    $('#flowerShopModal').modal('show');

    $.ajax({
        url: '/get-flower-shop',
        method: 'post',
        data:{
            idBarang: idBarang
        },
        success: function(data){
            console.log('Success : ', data);

            // Clear
            modalImage.empty();
            modalNamaProduk.html('');
            modalHargaProduk.html('');
            modalKeterangan.html('');
            modalSubTotal.html('');
            modalVarian.empty();

            //Insert Data
            modalNamaProduk.html(data[0].namaBarang);
            modalLabel.html(data[0].namaBarang);
            modalHargaProduk.html('IDR '+formatNumber(data[0].hargaBarang));
            modalKeterangan.html(data[0].deskripsiBarang);

            namaBarang = data[0].namaBarang;
            namaSubKategori = data[0].namaSubKategori;
            namaKategori = data[0].namaKategori;

            // Loop Foto
            var sub = 0;
            for(var i=0; i<data[1].length; i++){
                modalImage.append('<div class="wedding-bouqet-detail-image-container"><img src="/images/barang/'+ data[1][i].fotoBarang +'" alt="" class="landing-page-carousel-mobile-image"></div>');
            }

            if(data[1].length <= 0){
                modalImage.append('<div class="wedding-bouqet-detail-image-container"><img src="/images/barang/default.jpg" alt="" class="landing-page-carousel-mobile-image"></div>');
            }

            $('.wedding-bouqet-carousel-container').slick({
                slidesToShow: 1,
                infinite: true,
                dots: true,
                autoplay: true,
                autoplaySpeed: 800
            })

            // Show Varian
            if(data[2].length > 0){
                modalVarian.show();
            }

            // Loop Varian
            for(var i=0; i<data[2].length; i++){
                modalVarian.append('<option value="'+ data[2][i].namaVarian +'*'+ data[2][i].hargaBarang +'">'+ data[2][i].namaVarian +'</option>');
            }

            getSub();
        },
        error: function(data){
            console.log('Error : ', data);

        }
    })
}

function closeModal(){
    $('#flowerShopModal').modal('hide');
}

function order(){

    var catatan = $('#catatan').val();
    var namaPenerima = $('#namaPenerima').val();
    var alamatPenerima = $('#alamatPenerima').val();
    var jumlah = $('#jumlahBarang').val();
    var varian = $('#flowerShopModalVarian').val();
    varian = varian.split("*");
    varian = varian[0];

    if(namaPenerima == '' || namaPenerima == null ){
        Swal.fire({
            icon: 'info',
            title: 'Nama Penerima Harus Diisi !',
            showConfirmButton: false,
            timer: 800
        })
    }
    else if(alamatPenerima == '' || alamatPenerima == null){
        Swal.fire({
            icon: 'info',
            title: 'Alamat Penerima Harus Diisi !',
            showConfirmButton: false,
            timer: 800
        })
    }
    else{
        if(varian != null || varian != ''){
            location.href='https:wa.me/6281338540524?text=Halo Kak, Saya sudah melakukan pemesanan dengan rincian sebagai berikut:%0a%0aNama Penerima :  *'+ namaPenerima +'*%0aAlamat : *'+ alamatPenerima +'*%0aProduk : *'+ namaKategori +'* - *'+ namaSubKategori +'* - *'+ namaBarang +'* *('+ jumlah +' x)*%0aVarian produk : *'+ varian +'*%0aCatatan : *'+ catatan +'*%0aTotal produk : *Rp '+ $('#flowerShopModalSubTotal').html() +'*%0a%0a%0aMohon segera di proses ya%0a%0a----------------';
        }
        else{
            location.href='https:wa.me/6281338540524?text=Halo Kak, Saya sudah melakukan pemesanan dengan rincian sebagai berikut:%0a%0aNama Penerima :  *'+ namaPenerima +'*%0aAlamat : *'+ alamatPenerima +'*%0aProduk : *'+ namaKategori +'* - *'+ namaSubKategori +'* - *'+ namaBarang +'* (*'+ jumlah +'* x)*%0aCatatan : *'+ catatan +'*%0aTotal produk : *Rp '+ $('#flowerShopModalSubTotal').html() +'*%0a%0a%0aMohon segera di proses ya%0a%0a----------------';
        }
    }
}

$('#flowerShopModalVarian').change(function(){
    var data = $(this).val();
    data = data.split("*");
    console.log('Harga', data);
    modalHargaProduk.html('IDR '+ formatNumber(data[1]));
    getSub();
})

function getSub(){
    var harga = $('#flowerShopModalVarian').val();
    harga = harga.split("*");

    var jumlah = $('#jumlahBarang').val();

    harga = harga[1] * jumlah;

    modalSubTotal.html('IDR '+ formatNumber(harga));
}

$('#buttonMinBarang').click(function(){
    if($('#jumlahBarang').val() >= 1){
        $('#jumlahBarang').val(parseInt($('#jumlahBarang').val())-1);
        getSub();
    }
});

$('#buttonPlusBarang').click(function(){
    $('#jumlahBarang').val(parseInt($('#jumlahBarang').val())+1);
    getSub();
});


$(document).ready(function(){

})
