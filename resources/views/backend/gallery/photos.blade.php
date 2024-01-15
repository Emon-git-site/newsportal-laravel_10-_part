@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Photo Gallery</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Photo Gallery </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif    

        <!-- /.content-header -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Photo Gallery Table</h3>
                    <button class="btn btn-primary btn-sm" style="float: right" data-toggle="modal"
                        data-target="#add_photo_modal">Add New</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="PhotoTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($photos as $photo)
                                <tr>
                                    <td>{{ $photo->title }}</td>
                                    <td><img src="{{ asset($photo->photo) }}" width="90px" height="70px"></td>
                                    <td>
                                        @if ($photo->type == 1)
                                            <span class="badge badge-success">Big Photo</span>
                                        @else
                                            <span class="badge badge-info">Small Photo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('gallery.photo.editPhoto', $photo->id) }}" class="btn btn-secondary btn-sm">UPDATE</a>
                                        <a href="{{ route('gallery.photo.delete', $photo->id) }}" class="btn btn-danger btn-sm" onclick="categoryDeleteAlert(event)">DELETE</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    {{--  new photo added modal --}}
    <div class="modal fade" id="add_photo_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Insert New Photo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('gallery.photo.storePhoto') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="photo_title" class="form-label">Photo Title</label>
                            <input type="text" class="form-control" id="photo_title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="bangla" class="form-label">Upload Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image"
                                        name="photo" required>
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>                        </div>
                        <div class="mb-3">
                            <label for="bangla" class="form-label">Photo Type</label>
                            <select name="type" class="form-control" required>
                                <option value="1">Big Photo</option>                        
                                <option value="0">Small Photo</option>                        
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">SUBMIT</button>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- ! new category added modal --}}


    {{-- update category modal --}}
    <div class="modal fade" id="category_update_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Category</h4>
                    <div id="category_update_message"></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="category_id" name="id" required>
                        </div>
                        <div class="mb-3">
                            <label for="english" class="form-label">Category Name English</label>
                            <input type="text" class="form-control" id="english_update" name="category_en" required>
                        </div>
                        <div class="mb-3">
                            <label for="bangla" class="form-label">Category Name Bangla</label>
                            <input type="text" class="form-control" id="bangla_update" name="category_bn" required>
                        </div>

                        <button type="submit" id="update_category" class="btn btn-success btn-block">Submit</button>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- ! update category modal --}}
@endsection

@section('script')
    <script>
        // data table pdf, copy, csv
        $(function() {
            $("#PhotoTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#PhotoTable_wrapper .col-md-6:eq(0)');

        });

           // Display the selected file name in the label

   $('.custom-file-input').on('change', function(){
	var fileName = $(this).val().split('\\').pop();
	$(this).next('.custom-file-label').html(fileName);
});

        // toaster success message function
        $(document).ready(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            // this is show success insert message
            $(function() {
                @if (session('photo_upload_message'))
                    toastr.success('{{ session('photo_upload_message') }}');
                @endif
            });

            // this is  show delete message
            $(function() {
                @if (session('photo_delete_message'))
                    toastr.error('{{ session('photo_delete_message') }}');
                @endif
            });

        });

        // category delete alert message
        function categoryDeleteAlert(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
                    title: "Are you sure to Delete this post",
                    text: "You will not be able to revert this!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willCancel) => {
                    if (willCancel) {
                        window.location.href = urlToRedirect;

                    }
                });
        }
    </script>
@endsection
