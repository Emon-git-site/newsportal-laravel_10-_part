@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">SEO Setting</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">SEO Setting</li>
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
                                <h3 class="card-title">SEO Insert Panel</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('setting.seo.update', $seo->id) }}" method="post" >
                                @csrf
                                <div class="card-body">
                                        <div class="form-group">
                                            <label for="meta_author">Author</label>
                                            <input type="text" class="form-control" id="meta_author" name="meta_author" value="{{ $seo->meta_author }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_title">Meta Title</label>
                                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $seo->meta_title }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_keyword">Meta Keyword</label>
                                            <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{ $seo->meta_keyword }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description</label>
                                            <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{ $seo->meta_description }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="google_analytics">Google Analytics</label>
                                            <input type="text" class="form-control" id="google_analytics" name="google_analytics" value="{{ $seo->google_analytics }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alexa_analytics">Alexa Analytics</label>
                                            <input type="text" class="form-control" id="alexa_analytics" name="alexa_analytics" value="{{ $seo->alexa_analytics }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="google_varification	">Google Verification</label>
                                            <input type="text" class="form-control" id="google_varification	" name="google_varification	" value="{{ $seo->google_varification	 }}" required>
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
                @if (session('seo_update_message'))
                    toastr.success('{{ session('seo_update_message') }}');
                @endif
            });

        });

    });
    </script>
@endsection