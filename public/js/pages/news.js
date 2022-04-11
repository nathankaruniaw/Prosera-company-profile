$(document).ready(function () {

    // Hide
    console.log('INI NEWS')

    // Ajax Setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    // Clear modal
    $('#buttonModal').click(function () {

        $('#mainForm').attr('class', 'col-md-12');
        $('#idNews').val('');
        $('#judulNews').val('');
        $('#deskripsiNews').val('');
        $('#kategoriNews').val('');

        $('#buttonSubmit').html('Add <i class="icon-arrow-right14 position-right"></i>');
    })

    // Input
    $('#formInput').submit(function () {

        event.preventDefault();

        console.log('Form Submitted');

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log('Succes', data);
                $('#modalCloseBtn').click();
                Swal.fire({
                    title: 'Added',
                    icon: 'success',
                    timer: 1000,
                    timerProgressBar: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                });
                location.reload()
            },
            error: function (data) {
                console.log('Error : ', data);
            }
        })
    })
})
