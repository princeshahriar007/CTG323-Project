@extends('admin.partials.adminMaster')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Create A Post</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 center-block">
                <form class="form-group" action="" method="POST">
                    {{ csrf_field() }}
                    <input type="text" value="{{ $post->title }}" name="title" placeholder="Post Title" class="form-control"><br>
                    <textarea id="image-tools" name="details" cols="100" rows="10">{{ $post->details }}</textarea><br>
                    <input class="btn btn-dark" type="submit" name="submit" value="Update">
                </form>
            </div>
        </div>
    </div>
@endsection

