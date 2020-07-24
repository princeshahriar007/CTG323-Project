@extends('admin.partials.adminMaster')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Upload Media</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-3">
                <form class="form-group" action="" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input class="form-control-file" type="file" name="image"><br>
                    <input class="btn btn-success" type="submit" name="submit" value="Upload">
                </form>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Media</h1>
                <div class="row">
                    @foreach($images as $image)
                        <div class="col-lg-3">
                            <img src="{{ asset('image/'.$image->image) }}" alt="" width="100%"><br>
                            <input type="text" value="{{ asset('image/'.$image->image) }}">
                            <a class="btn btn-primary" href="{{ url('/admin/imageUpdate/'.$image->id) }}">Update</a>
                        </div>

                    @endforeach
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
    </div>
@endsection

