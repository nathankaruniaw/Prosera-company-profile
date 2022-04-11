@extends('layouts.navbar')

@section('title', 'Project')

@section('content')

    {{-- Panel Sub Project --}}
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">{{ $project->namaCluster }}</h5>

            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

	<!-- Back -->
    <div class="container-fluid padkonten mg-60" style="padding-bottom: 0;">

        <a href="/admin/project" class="btn btn-info">
            <i class="arrow-left" style="padding-top: 5px;"></i> Back
        </a>

    </div>

	<!-- konten -->
	<div class="container-fluid padkonten">


		<!-- Form -->
		<form action="/admin/project/update" method="post" enctype="multipart/form-data">

			@csrf

			<input type="number" name="idSubProject" id="idSubProject" value="{{ $project->id }}" hidden>

			<!-- Container Edit -->
			<div class="row">

                <div class="col-md-12">
                    <div class="col-md-2">
                        <!-- Foto Sub Project -->
                        <p class="h3 mg-20">
                            Foto
                        </p>
                    </div>
                    <div class="col-md-6">
                        <br>
                        @if($project->photoCluster != null)
                            <div class="container-input-foto-Sub Project row">
                                <div class=" col-md-4" style="margin-bottom: 10px;">
                                    <img src="{{ url('/images/project/'.$project->photoCluster) }}" class="">
                                </div>
                            </div>
                        @endif
                        <input type="file" id="pic" name="photoCluster" class="form-control-file">

                    </div>

                </div>

                <div class="col-md-12">

                    <div class="col-md-2">
                        <!-- Nama Cluster -->
                        <p class="h3">
                            Nama
                        </p>
                    </div>

                    <div class="col-md-6">
                        <br>
                        <input type="text" id="namaCluster" name="namaCluster" class="form-control" value="{{ $project->namaCluster }}">
                    </div>

                </div>

                <div class="col-md-12">

                    <div class="col-md-2">
                        <!-- Kota Cluster -->
                        <p class="h3">
                            Kota
                        </p>
                    </div>

                    <div class="col-md-6">
                        <br>
                        <input type="text" id="kotaCluster" name="kotaCluster" class="form-control" value="{{ $project->kotaCluster }}">
                    </div>

                </div>

                <div class="col-md-12">

                    <div class="col-md-2">
                        <!-- Luas Cluster -->
                        <p class="h3">
                            Luas
                        </p>
                    </div>

                    <div class="col-md-6">
                        <br>
                        <input type="text" id="luasCluster" name="luasCluster" class="form-control" value="{{ $project->luasCluster }}">
                    </div>

                </div>

                

                <div class="col-md-12">

                    <div class="col-md-2">
                        <p class="h3">
                            Kategori Project
                        </p>
                    </div>

                    <div class="col-md-6">
                        <br>
                        <select id="idKategoriProject" name="idKategoriProject">
                            @foreach($data as $cluster)
                                @if($cluster->id == $project->idProject)
                                    <option value="{{ $cluster->id }}" selected>{{ $cluster->kategoriProject }}</option>
                                @else
                                    <option value="{{ $cluster->id }}">{{ $cluster->kategoriProject }}</option>
                                @endif
                            @endforeach
                        </select>
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
                        url: "/admin/project/delete",
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
