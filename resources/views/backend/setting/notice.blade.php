@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Notice Setting</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Notice Setting</li>
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
                                <h3 class="card-title">Notice Setting</h3>
                                @if($notice->status == 1)
                                <a href="{{ route('setting.notice.deactive', $notice->id) }}" style="float: right" class="btn btn-danger">DeActive</a>
                                @else
                                <a href="{{ route('setting.notice.active', $notice->id) }}" style="float: right" class="btn btn-success">Active</a>
                                @endif
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('setting.notice.update', $notice->id) }}" method="post" >
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="notice">Notice</label>
                                        <textarea class="form-control" name="notice">
                                            {{ $notice->notice }}
                                           </textarea>
                                           @if($notice->status==1)
                                           <small class="text-success">Now Notice are Active Now</small>
                                           @else
                                           <small class="text-danger">Now Notice are DeActive Now</small>
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
                @if (session('notice_update_message'))
                    toastr.success('{{ session('notice_update_message') }}');
                @endif
            });
            // this is show success active message
            $(function() {
                @if (session('notice_active_message'))
                    toastr.success('{{ session('notice_active_message') }}');
                @endif
            });
            // this is show success deactive message
            $(function() {
                @if (session('notice_deactive_message'))
                    toastr.error('{{ session('notice_deactive_message') }}');
                @endif
            });

        });

    });
    </script>
@endsection