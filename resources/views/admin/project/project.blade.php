@extends('layouts.navbar')

@section('title', 'Project')

@section('breadcrumb', 'Project')

@section('content')
    
    {{-- Panel Project --}}
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Kategori Project</h5>

            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

            <div class="container-fluid">

                {{-- Modal --}}
                <div class="row">

                   <a id="buttonModal" class="btn btn-info" data-toggle="modal" data-target="#modal"><i class="icon-plus2"></i>Tambah Kategori Project</a>

                    <!-- Modal -->
                    <div class="modal fade text-left" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog" style="width: 80%;" role="dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="" id="modalLabel">Kategori Project</h5>
                                    <button type="button" id="modalCloseBtn" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="icon-cross"></i>
                                    </button>
                                </div>

                                <div class="modal-body">

                                    <div class="container-fluid">

                                        <div class="row">

                                            <form class="form-horizontal" method="post" id="formInput" enctype="multipart/form-data" action="/admin/kategori-project/insert">
                                                @csrf
                                                <input type="number" class="idProject" name="idProject" value="" hidden>

                                                <div class="col-md-12" id="mainForm">

                                                    {{-- Nama Project --}}
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-2">Nama Kategori</label>
                                                        <div class="col-lg-10">
                                                            <input name="kategoriProject" id="kategoriProject" type="text" class="form-control" placeholder="Nama Kategori Project....">
                                                        </div>
                                                    </div>

                                                    <div class="text-right">
                                                        <button id="buttonSubmit" type="submit" class="btn btn-primary">Add <i class="icon-arrow-right14 position-right"></i></button>
                                                    </div>

                                                </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Main Table --}}
                <table id="tableProject" class="table table-striped">

                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Detail</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <?php $count = 1; ?>
                        @foreach($data as $Project)
                            <tr>
                                <td><?php echo $count ?></td>                                
                                <td>{{$Project->kategoriProject}}</td>
                                <td><a id="buttonDetail{{$Project->id}}" data-id="{{$Project->id}}" onclick="detailProject(`{{$Project->id}}`)"><i style="color: black;" class="icon-pencil7"></i></a></td>
                                <td><a id="'buttonDelete{{$Project->id}}" data-id="{{$Project->id}}" onclick="deleteProject({{$Project->id}})"><i style="color: red;" class="icon-trash-alt"></i></a></td>
                            </tr>
                            <?php $count += 1 ?>
                        @endforeach
                    </tbody>

                </table>

            </div>

        </div>
    </div>

@endsection

<script>
    // Edit Data
    function detailProject(id) {
        var id = id;
        window.location = '/admin/kategori-project/edit/' + id;
    }
    // Delete Data
    function deleteProject(id) {
        console.log(id);
        var id_Project = id;
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
                var id = id_Project;

                $.ajax({
                    type: "post",
                    url: "/admin/kategori-project/delete",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        Swal.fire({
                            title: 'Deleted',
                            icon: 'success',
                            timer: 1000,
                            timerProgressBar: true,
                            position: 'bottom-end',
                            showConfirmButton: false,
                        });
                        setTimeout(reload, 1000)
                        function reload(){
                            location.reload();    
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Canceled', '', 'info')
            }
        });
    }
</script>

@section('javascript')

    <script src="/js/pages/project.js"></script>

@endsection
