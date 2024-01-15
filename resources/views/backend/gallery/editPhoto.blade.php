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
                <!-- /.card-body -->
            </div>
        </div>
    </div>

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
