@extends('layouts.navbar')

@section('title', 'Kategori Project')

@section('content')

    {{-- Panel Kategori Project --}}
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">{{ $project->kategoriProject }}</h5>

            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

	<!-- Back -->
    <div class="container-fluid padkonten mg-60" style="padding-bottom: 0;">

        <a href="/admin/kategori-project" class="btn btn-info">
            <i class="arrow-left" style="padding-top: 5px;"></i> Back
        </a>

    </div>

	<!-- konten -->
	<div class="container-fluid padkonten">


		<!-- Form -->
		<form action="/admin/kategori-project/update" method="post">

			@csrf

			<input type="number" name="idProject" id="idProject" value="{{ $project->id }}" hidden>

			<!-- Container Edit -->
			<div class="row">

                <div class="col-md-12 d-flex">

                    <div class="col-md-3">
                        <!-- kategori project -->
                        <p class="h5">
                            Nama Kategori Project
                        </p>
                    </div>

                    <div class="col-md-5">
                        <br>
                        <input type="text" name="kategoriProject" class="form-control" value="{{ $project->kategoriProject }}">
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



    <script>

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
                        url: "/admin/kategori-project/delete",
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
