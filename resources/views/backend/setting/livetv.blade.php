@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Live TV Setting</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Live TV Setting</li>
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
                                <h3 class="card-title">Live TV Setting</h3>
                                @if($livetv->status == 1)
                                <a href="{{ route('setting.livetv.deactive', $livetv->id) }}" style="float: right" class="btn btn-danger">DeActive</a>
                                @else
                                <a href="{{ route('setting.livetv.active', $livetv->id) }}" style="float: right" class="btn btn-success">Active</a>
                                @endif
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('setting.namaz.update', $livetv->id) }}" method="post" >
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="embed_code">Embed Code</label>
                                        <textarea class="form-control" name="embed_code">
                                            {{ $livetv->embed_code }}
                                           </textarea>
                                           @if($livetv->status==1)
                                           <small class="text-success">Now Live TV are Active Now</small>
                                           @else
                                           <small class="text-danger">Now Live TV are DeActive Now</small>
                                           @endif
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

            // this is show success update message
            $(function() {
                @if (session('livetv_update_message'))
                    toastr.success('{{ session('livetv_update_message') }}');
                @endif
            });
            // this is show success active message
            $(function() {
                @if (session('livetv_active_message'))
                    toastr.success('{{ session('livetv_active_message') }}');
                @endif
            });
            // this is show success deactive message
            $(function() {
                @if (session('livetv_deactive_message'))
                    toastr.error('{{ session('livetv_deactive_message') }}');
                @endif
            });

        });

    });
    </script>
@endsection