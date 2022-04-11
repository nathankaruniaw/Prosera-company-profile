@extends('layouts.navbar')

@section('title', 'News')

@section('breadcrumb', 'News')

@section('content')
    
    {{-- Panel News --}}
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">News</h5>

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

                   <a id="buttonModal" class="btn btn-info" onclick="openAddNews()" data-toggle="modal" data-target="#modal"><i class="icon-plus2"></i>Tambah News</a>

                    <!-- Modal -->
                    <div class="modal fade text-left" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog" style="width: 80%;" role="dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="" id="modalLabel">News</h5>
                                    <button type="button" id="modalCloseBtn" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="icon-cross"></i>
                                    </button>
                                </div>

                                <div class="modal-body">

                                    <div class="container-fluid">

                                        <div class="row">

                                            <form class="form-horizontal" method="post" id="formInput" enctype="multipart/form-data" action="/admin/news/insert">
                                                @csrf
                                                <input type="number" class="idNews" name="idNews" value="" hidden>

                                                <div class="col-md-12" id="mainForm">

                                                    <fieldset class="content-group">
                                                        <legend class="text-bold">Data News</legend>

                                                        {{-- Nama News --}}
                                                        <div class="form-group">
                                                            <label class="control-label col-lg-2">Nama</label>
                                                            <div class="col-lg-10">
                                                                <input name="judulNews" id="judulNews" type="text" class="form-control" placeholder="Nama News....">
                                                            </div>
                                                        </div>

                                                        {{-- Tanggal News --}}
                                                        <div class="form-group">
                                                            <label class="control-label col-lg-2" for="tanggalNews">Tanggal</label>
                                                            <div class="col-lg-10">
                                                                <input type="text" id="tanggalNews" class="form-control" name="tanggalNews" />
                                                            </div>
                                                        </div>

                                                        {{-- Kategori News --}}
                                                        <div class="form-group">
                                                            <label class="control-label col-lg-2">Kategori</label>
                                                            <div class="col-lg-10">
                                                                <input name="kategoriNews" id="kategoriNews" type="text" class="form-control" placeholder="Kategori News....">
                                                            </div>
                                                        </div>

                                                        {{-- Deskripsi News --}}
                                                        <div class="form-group">
                                                            <label class="control-label col-lg-2">Deskripsi</label>
                                                            <div class="col-lg-10">
                                                                <textarea name="deskripsiNews" id="deskripsiNews"></textarea>
                                                            </div>
                                                        </div>

                                                        {{-- Foto News --}}
                                                        <div class="form-group">
                                                            <label class="control-label col-lg-2">Foto</label>
                                                            <div class="col-lg-10">
                                                                <input type="file" id="pic" name="fotoNews" class="form-control-file">
                                                            </div>
                                                        </div>

                                                        <div class="text-right">
                                                            <button id="buttonSubmit" type="submit" class="btn btn-primary">Add <i class="icon-arrow-right14 position-right"></i></button>
                                                        </div>

                                                    </fieldset>

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
                <table id="tableNews" class="table table-striped">

                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Detail</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <?php $count = 1; ?>
                        @foreach($data as $news)
                            <tr>
                                <td><?php echo $count ?></td>                                
                                <td>{{$news->judulNews}}</td>                        
                                <td style="max-width: 80px; text-overflow: ellipsis;    overflow: hidden; white-space: nowrap;">
                                    <?php
                                        $str = $news->deskripsiNews;
                                        echo htmlspecialchars_decode($str);
                                    ?>
                                </td>
                                <td><a id="buttonDetail{{$news->id}}" data-id="{{$news->id}}" onclick="detailNews(`{{$news->id}}`)"><i style="color: black;" class="icon-pencil7"></i></a></td>
                                <td><a id="'buttonDelete{{$news->id}}" data-id="{{$news->id}}" onclick="deleteNews({{$news->id}})"><i style="color: red;" class="icon-trash-alt"></i></a></td>
                            </tr>
                            <?php $count += 1 ?>
                        @endforeach
                    </tbody>

                </table>

            </div>

        </div>
    </div>

@endsection

<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'deskripsiNews' );
</script> 
<script>
    function openAddNews(){
        $("#tanggalNews").flatpickr({
            altInput: true,
            altFormat: "d M Y",
            dateFormat: "d M Y",
            defaultDate: Date.now(),
            weekNumbers: true
        });    
    }
     
    // Edit Data
    function detailNews(id) {
        var id = id;
        window.location = '/admin/news/edit/' + id;
    }
    // Delete Data
    function deleteNews(id) {
        console.log(id);
        var id_news = id;
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
                var id = id_news;

                $.ajax({
                    type: "post",
                    url: "/admin/news/delete",
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

    <script src="/js/pages/news.js"></script>

@endsection
