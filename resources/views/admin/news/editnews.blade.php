@extends('layouts.navbar')

@section('title', 'News')

@section('content')

    {{-- Panel News --}}
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">{{ $news->judulNews }}</h5>

            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

	<!-- Back -->
    <div class="container-fluid padkonten mg-60" style="padding-bottom: 0;">

        <a href="/admin/news" class="btn btn-info">
            <i class="arrow-left" style="padding-top: 5px;"></i> Back
        </a>

    </div>

	<!-- konten -->
	<div class="container-fluid padkonten">


		<!-- Form -->
		<form action="/admin/news/update" method="post" enctype="multipart/form-data">

			@csrf

			<input type="number" name="idNews" id="idNews" value="{{ $news->id }}" hidden>

			<!-- Container Edit -->
			<div class="row">

                <div class="col-md-12">
                    <div class="col-md-2">
                        <!-- Foto News -->
                        <p class="h3 mg-20">
                            Foto
                        </p>
                    </div>
                    <div class="col-md-6">
                        <br>
                        @if($news->photoNews != null)
                            <div class="container-input-foto-News row">
                                <div class="container-foto-News col-md-4" style="margin-bottom: 10px;">
                                    <img src="{{ url('/images/news/'.$news->photoNews) }}" class="foto-News">
                                </div>
                            </div>
                        @endif
                        <input type="file" id="pic" name="fotoNews" class="form-control-file">

                    </div>

                </div>

                


                <div class="col-md-12">

                    <div class="col-md-2">
                        <!-- Judul News -->
                        <p class="h3">
                            Judul
                        </p>
                    </div>

                    <div class="col-md-6">
                        <br>
                        <input type="text" name="judulNews" class="form-control" value="{{ $news->judulNews }}">
                    </div>

                </div>

                <div class="col-md-12">

                    <div class="col-md-2">
                        <!-- tanggal News -->
                        <p class="h3">
                            Tanggal
                        </p>
                    </div>

                    <div class="col-md-6">
                        <br>
                        <input type="text" id="tanggalNews" name="tanggalNews" class="form-control">
                    </div>

                </div>

                <div class="col-md-12">

                    <div class="col-md-2">
                        <!-- kategori News -->
                        <p class="h3">
                            Kategori
                        </p>
                    </div>

                    <div class="col-md-6">
                        <br>
                        <input type="text" name="kategoriNews" class="form-control" value="{{ $news->kategoriNews }}">
                    </div>

                </div>

                

                <div class="col-md-12">

                    <div class="col-md-2">
                        <p class="h3">
                            Deskripsi
                        </p>
                    </div>

                    <div class="col-md-6">
                        <br>
                        <textarea class="form-control" id="deskripsiNews" name="deskripsiNews" style="white-space: pre-wrap;">{{$news->deskripsiNews}}</textarea>
                    </div>

                </div>

			</div>

            <div class="text-center">

                <button type="submit" class="h3 btn btn-info" id="buttonSubmit">
                    Save
				</button>

			</div>

		</form>

	</div>



    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'deskripsiNews' );
    </script>   
    <script>
        $("#tanggalNews").flatpickr({
            altInput: true,
            altFormat: "d M Y",
            dateFormat: "d M Y",
            defaultDate: `{{ $news->tanggalNews }}`,
            weekNumbers: true
        });    

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $('body').on('click', '#buttonDelete', function () {
            Swal.fire({
                title: 'Delete ?',
                icon: 'question',
                timer: 2000,
                timerProgressBar: true,
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Delete`,
                denyButtonText: `Don't Delete`,
            }).then((result) => {
                if (result.isConfirmed) {

                    var id = $(this).data("id");
                    console.log(id);

                    $.ajax({
                        type: "post",
                        url: "/admin/news/delete",
                        data: {
                            id: id
                        },
                        success: function (data) {
                            window.location.reload();
                            Swal.fire({
                                title: 'Deleted',
                                icon: 'success',
                                timer: 1000,
                                timerProgressBar: true,
                                position: 'bottom-end',
                                showConfirmButton: false,
                            });
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire('Canceled', '', 'info')
                }
            });
        })

    </script>

@endsection
