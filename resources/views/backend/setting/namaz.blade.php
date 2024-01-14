@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Namaz Time Setting</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Namaz Time Setting</li>
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
                                <h3 class="card-title">Namaz Time Setting</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('setting.namaz.update', $namaz->id) }}" method="post" >
                                @csrf
                                <div class="card-body">
                                        <div class="form-group">
                                            <label for="fajr">Fajr</label>
                                            <input type="text" class="form-control" id="fajr" name="fajr" value="{{ $namaz->fajr }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="johr">Johr</label>
                                            <input type="text" class="form-control" id="johr" name="johr" value="{{ $namaz->johr }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="asor">Asor</label>
                                            <input type="text" class="form-control" id="asor" name="asor" value="{{ $namaz->asor }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="magrib">Magrib</label>
                                            <input type="text" class="form-control" id="magrib" name="magrib" value="{{ $namaz->magrib }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="esha">Esha</label>
                                            <input type="text" class="form-control" id="esha" name="esha" value="{{ $namaz->esha }}" required>
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
                @if (session('namaz_update_message'))
                    toastr.success('{{ session('namaz_update_message') }}');
                @endif
            });

        });

    });
    </script>
@endsection