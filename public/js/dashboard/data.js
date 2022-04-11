$(document).ready(function(){

    // Formatter
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
    }

    function getBestPick(){

        $.ajax({
            url: '/get-best-pick',
            method: 'get',
            success: function(data){
                console.log('Success : ', data);
                var list = $('#bestPickContainer');
                list.empty();
                for(var i = 0; i < data.length; i){
                    var foto = data[i].fotoBarang;
                    list.append('<div class="col-6 col-md-4 card-our-best-pick mgb-10"><img src="/images/barang/'+ foto +'" alt="Recomendation" class="gambar-our-best-pick mgb-10"><p class="font-heading-6">'+ data[i].namaBarang +'</p><p class="font-keterangan" style="color: #727272;">IDR '+ formatNumber(data[i].hargaBarang) +'</p></div>');
                }
            },
            error: function(data){
                console.log('Error : ' + data);
            }
        })
    }

    // getBestPick();
})
