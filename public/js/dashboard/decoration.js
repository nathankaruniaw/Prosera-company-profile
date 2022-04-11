var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function formatNumber(num) {

    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
}

function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if(n == 1 && !validateForm()) return false;
    // Hide the current tab:
    if(currentTab == 0){
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;
    }
    else{
        currentTab = currentTab + n;
    }
    console.log('Status : '+ n);

    // if you have reached the end of the form...
    var catatan = $('#catatan').val();
    var namaPenerima = $('#namaPenerima').val();
    var alamatPenerima = $('#alamatPenerima').val();
    if (n == 2) {
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
            // Photoshoot
            if($('input[name="firstForm"]:checked').val() == 'Photo Shoot'){
                var firstForm = $('input[name="firstForm"]:checked').val();
                var photoShootType = $('input[name="photoShootType"]:checked').val();
                var min = $('#sliderMinPhotoShoot').val();
                var max = $('#sliderMaxPhotoShoot').val();
                var hargaMin = 50000;
                var hargaMax = 2500000;
                var hargaMinFinal = ((min/100)*hargaMax) + (((100-min)/100)*hargaMin);
                var hargaMaxFinal = ((max/100)*hargaMax) + (((100-max)/100)*hargaMax);
                location.href='https:wa.me/6281338540524?text=Halo Kak, Saya sudah melakukan pemesanan dengan rincian sebagai berikut:%0a%0aNama Penerima :  *'+ namaPenerima +'*%0aAlamat : *'+ alamatPenerima +'*%0aProduk : *'+ firstForm +' - '+ photoShootType +'*%0aCatatan : *'+ catatan +'*%0aRange Harga : *Rp '+ formatNumber(hargaMinFinal) +' - Rp '+ formatNumber(hargaMaxFinal) +'*%0a%0a%0aMohon segera di proses ya%0a%0a----------------';
            }

            // Table Planner
            else if($('input[name="firstForm"]:checked').val() == 'Table Planner'){
                var firstForm = $('input[name="firstForm"]:checked').val();
                var tablePlannerSecond = $('input[name="tablePlannerSecond"]:checked').val();
                if(tablePlannerSecond == 'Bridal Shower'){
                    var harga = $('input[name="tablePlannerPrice"]:checked').val();
                    location.reload();
                    location.href='https:wa.me/6281338540524?text=Halo Kak, Saya sudah melakukan pemesanan dengan rincian sebagai berikut:%0a%0aNama Penerima :  *'+ namaPenerima +'*%0aAlamat : *'+ alamatPenerima +'*%0aProduk : *'+ firstForm +' - '+ tablePlannerSecond +'*%0aCatatan : *'+ catatan +'*%0aTotal produk : *Rp '+ formatNumber(harga) +'*%0a%0a%0aMohon segera di proses ya%0a%0a----------------';
                }
                else{

                    var min = $('#sliderMinTablePlanner').val();
                    var max = $('#sliderMaxTablePlanner').val();
                    var hargaMin = 500000;
                    var hargaMax = 30000000;
                    var hargaMinFinal = ((min/100)*hargaMax) + (((100-min)/100)*hargaMin);
                    var hargaMaxFinal = ((max/100)*hargaMax) + (((100-max)/100)*hargaMax);
                    location.href='https:wa.me/6281338540524?text=Halo Kak, Saya sudah melakukan pemesanan dengan rincian sebagai berikut:%0a%0aNama Penerima : *'+ namaPenerima +'*%0aAlamat : *'+ alamatPenerima +'*%0aProduk : *'+ firstForm +' - '+ tablePlannerSecond +'*%0aCatatan : *'+ catatan +'*%0aRange Harga : *Rp '+ formatNumber(hargaMinFinal) +' - Rp '+ formatNumber(hargaMaxFinal) +'*%0a%0a%0aMohon segera di proses ya%0a%0a----------------';
                }
            }

            // Intimate Wedding Decoration
            else if($('input[name="firstForm"]:checked').val() == 'Intimate Wedding Decoration'){
                var firstForm = $('input[name="firstForm"]:checked').val();
                var IntimateWeddingPrice = $('input[name="IntimateWeddingPrice"]:checked').val();
                location.href='https:wa.me/6281338540524?text=Halo Kak, Saya sudah melakukan pemesanan dengan rincian sebagai berikut:%0a%0aNama Penerima :  *'+ namaPenerima +'*%0aAlamat : *'+ alamatPenerima +'*%0aProduk : *'+ firstForm +' - '+ IntimateWeddingPrice +'*%0aCatatan : *'+ catatan +'*%0a%0a%0aMohon segera di proses ya%0a%0a----------------';
            }
        }
    }
    // Otherwise, display the correct tab:
    else if(n != 2){
        showTab(currentTab);
    }
}

function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");

    //... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
        document.getElementById("nextBtn").style.display = "none";
    } else {
        document.getElementById("nextBtn").style.display = "none";
        document.getElementById("prevBtn").style.display = "inline";
    }
    // tampil button next
    // if (n == (x.length - 1)) {
    //     document.getElementById("nextBtn").style.display = "inline";
    //     document.getElementById("nextBtn").innerHTML = "Contact Us";
    //     $('#nextBtn').attr('onclick', 'nextPrev(2)');
    // }
    // else {
    //     document.getElementById("nextBtn").innerHTML = "Next";
    // }

    var indicator = $('#indicateForm');

    indicator.empty();

    // Custom Show Tab
    if(currentTab == 0){
        x[n].style.display = "block";
        x[n].parentNode.childNodes[3].setAttribute('class', 'd-none');
        x[n].parentNode.childNodes[5].setAttribute('class', 'd-none');
        x[n].parentNode.childNodes[7].setAttribute('class', 'd-none');
        x[n].parentNode.childNodes[9].setAttribute('class', 'd-none');
        x[n].parentNode.childNodes[11].setAttribute('class', 'd-none');
        x[n].parentNode.childNodes[13].setAttribute('class', 'd-none');
        console.log('Masuk Kondisi Current tab : ');
        indicator.append('<span class="step"></span>');
    }
    else if(currentTab == 1){
        // Photoshoot
        if($('input[name="firstForm"]:checked').val() == "Photo Shoot"){
            // Matiin yang lain
            $('#second-tab-intimateweddingdecor').attr('class', 'd-none');
            $('#second-tab-tableplanner').attr('class', 'd-none');
            $('#third-tab-photoshoot').attr('class', 'd-none');

            // Nampilin Tab
            $('#second-tab-photoshoot').attr('class', 'tab');
            $('#second-tab-photoshoot').attr('style', 'display:block');
            indicator.append('<span class="step"></span>');
            indicator.append('<span class="step"></span>');
            indicator.append('<span class="step"></span>');
        }
        // Table Planner
        else if($('input[name="firstForm"]:checked').val() == "Table Planner"){
            // Matiin yang lain
            $('#second-tab-intimateweddingdecor').attr('class', 'd-none');
            $('#second-tab-photoshoot').attr('class', 'd-none');
            $('#third-tab-tableplanner').attr('class', 'd-none');
            $('#third-tab-tableplanner-price').attr('class', 'd-none');

            // Nampilin Tab
            $('#second-tab-tableplanner').attr('style', 'display:block');
            $('#second-tab-tableplanner').attr('class', 'tab');
            indicator.append('<span class="step"></span>');
            indicator.append('<span class="step"></span>');
            indicator.append('<span class="step"></span>');
        }
        // Intimate
        else if($('input[name="firstForm"]:checked').val() == "Intimate Wedding Decoration"){
            // Matiin yang lain
            $('#second-tab-photoshoot').attr('class', 'd-none');
            $('#second-tab-tableplanner').attr('class', 'd-none');

            $('#second-tab-intimateweddingdecor').attr('class', 'tab');
            $('#second-tab-intimateweddingdecor').attr('style', 'display:block');
            $('#nextBtn').attr('onclick', 'nextPrev(2)');
            document.getElementById("nextBtn").style.display = "inline";
            document.getElementById("nextBtn").innerHTML = "Contact Us";
            indicator.append('<span class="step"></span>');
            indicator.append('<span class="step"></span>');
            $('#addTablePlannerPrice').empty();
            $('#addTablePlanner').empty();
            $('#addPhotoshoot').empty();
            var add =  $('#addTablePlannerIntimate');
            add.empty();
            add.append('<div class="col-md-12"><input type="text" id="namaPenerima" class="form-control wedding-bouqet-select" placeholder="Nama Penerima"></div><div class="col-md-12"><input type="text" id="alamatPenerima" class="form-control wedding-bouqet-select" placeholder="Alamat Penerima"></div><div class="col-md-12"><input type="text" id="catatan" class="form-control wedding-bouqet-select" placeholder="Bila ada catatan cantumkan disini"></div>');
        }
    }
    else if(currentTab == 2){
        // Photoshoot
        if($('input[name="firstForm"]:checked').val() == "Photo Shoot"){
            $('#second-tab-photoshoot').attr('class', 'tab d-none');
            $('#third-tab-photoshoot').attr('class', 'tab');
            $('#third-tab-photoshoot').attr('style', 'display:block');
            $('#nextBtn').attr('onclick', 'nextPrev(2)');
            document.getElementById("nextBtn").style.display = "inline";
            document.getElementById("nextBtn").innerHTML = "Contact Us";
            indicator.append('<span class="step"></span>');
            indicator.append('<span class="step"></span>');
            indicator.append('<span class="step"></span>');
            $('#addTablePlannerPrice').empty();
            $('#addTablePlanner').empty();
            $('#addTablePlannerIntimate').empty();
            var add =  $('#addPhotoshoot');
            add.empty();
            add.append('<div class="offset-md-3 col-md-6"><input type="text" id="namaPenerima" class="form-control wedding-bouqet-select" placeholder="Nama Penerima"></div><div class="offset-md-3 col-md-6"><input type="text" id="alamatPenerima" class wedding-bouqet-select="form-control" placeholder="Alamat Penerima"></div><div class="offset-md-3 col-md-6"><input type="text" id=" wedding-bouqet-selectcatatan" class="form-control" placeholder="Bila ada catatan cantumkan disini"></div>');
        }

        // table Planner
        else if($('input[name="firstForm"]:checked').val() == "Table Planner"){
            if($('input[name="tablePlannerSecond"]:checked').val() == 'Bridal Shower'){
                $('#third-tab-tableplanner').attr('class', 'd-none');
                $('#third-tab-tableplanner-price').attr('class', 'tab');
                $('#third-tab-tableplanner-price').attr('style', 'display:block');
                $('#addTablePlannerPrice').empty();
                $('#addPhotoshoot').empty();
                $('#addTablePlannerIntimate').empty();
                var add =  $('#addTablePlanner');
                add.empty();
                add.append('<div class="col-md-12"><input type="text" id="namaPenerima" class="form-control wedding-bouqet-select" placeholder="Nama Penerima"></div><div class="col-md-12"><input type="text" id="alamatPenerima" class="form-control wedding-bouqet-select" placeholder="Alamat Penerima"></div><div class="col-md-12"><input type="text" id="catatan" class="form-control wedding-bouqet-select" placeholder="Bila ada catatan cantumkan disini"></div>');
            }
            else{
                $('#third-tab-tableplanner-price').attr('class', 'd-none');
                $('#third-tab-tableplanner').attr('class', 'tab');
                $('#third-tab-tableplanner').attr('style', 'display:block');
                $('#addTablePlanner').empty();
                $('#addPhotoshoot').empty();
                $('#addTablePlannerIntimate').empty();
                var add =  $('#addTablePlannerPrice');
                add.empty();
                add.append('<div class="col-md-12"><input type="text" id="namaPenerima" class="form-control wedding-bouqet-select" placeholder="Nama Penerima"></div><div class="col-md-12"><input type="text" id="alamatPenerima" class="form-control wedding-bouqet-select" placeholder="Alamat Penerima"></div><div class="col-md-12"><input type="text" id="catatan" class="form-control wedding-bouqet-select" placeholder="Bila ada catatan cantumkan disini"></div>');
            }
            indicator.append('<span class="step"></>');
            indicator.append('<span class="step"></span>');
            indicator.append('<span class="step"></span>');
            $('#second-tab-tableplanner').attr('style', 'display:none');
            document.getElementById("nextBtn").style.display = "inline";
            document.getElementById("nextBtn").innerHTML = "Contact Us";
            $('#nextBtn').attr('onclick', 'nextPrev(2)');
        }
    }

    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
}

function validateForm() {
    // This function deals with validation of the form fields
    console.log('Validation On Check');
    var x, y, i= true;
    var valid = false;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByClassName("inputForm");
    // console.log('Y : '+ y.length + ' X : '+ x.length);
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].checked){
            // add an "invalid" class to the field:
            // and set the current valid status to false
            valid = true;
        }
    }
    // If the valid status is true, mark the step as finished and valid:

    if(valid){
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    else{
        Swal.fire({
            position: 'top-end',
            icon: 'info',
            title: 'Form must be Full Filled',
            showConfirmButton: false,
            timer: 500
        })
    }

    return valid; // return the valid status
}

function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
}
