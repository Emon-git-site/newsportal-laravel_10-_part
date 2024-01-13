@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Social Setting</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Social Setting</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6 mx-auto">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Post Insert Panel</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('setting.social.update', $social->id) }}" method="post" >
                                @csrf
                                <div class="card-body">
                                        <div class="form-group">
                                            <label for="facebook">Facebook</label>
                                            <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $social->facebook }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="twitter">Twitter</label>
                                            <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $social->twitter }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="linkedin">Linkedin</label>
                                            <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{ $social->linkedin }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="instagram">Instagram</label>
                                            <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $social->instagram }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="youtube">Youtube</label>
                                            <input type="text" class="form-control" id="youtube" name="youtube" value="{{ $social->youtube }}" required>
                                        </div>

                                  <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">UPDATE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>


@endsection

@section('script')
    <script>

        // data table pdf, copy, csv
        $(function() {
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
                @if (session('social_update_message'))
                    toastr.success('{{ session('social_update_message') }}');
                @endif
            });

        });

    });
    </script>
@endsection