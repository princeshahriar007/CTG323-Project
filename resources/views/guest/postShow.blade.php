@extends('guest.partials.guestMaster')
@section('content')
    <header class="masthead">
        <div class="container d-flex h-100 align-items-center">
            <div class="mx-auto text-center">
                <h1 class="mx-auto my-0 text-uppercase">{{ $post->title }}</h1>
                <h2 style="max-width: 100%" class="text-white-50 mx-auto mt-2 mb-5">{!! $post->details !!}</h2>
                <div class="col-lg-8 col-md-10 mx-auto">
                    <hr>
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <form action="{{ url('/comment') }}" class="form-group" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <textarea class="form-control bg-gradient-dark" name="comment" id="" cols="30" rows="1"></textarea><br>
                            <input class="btn btn-light" type="submit" name="submit" value="Comment">
                        </form>
                    @endif

                    @forelse($comments as $comment)
                        <div class="col-lg-8 col-md-8 mx-auto">
                            <h3 class="text-white">{{ $comment->comment }}</h3>
                            <p class="text-light text-lg">by {{ $comment->user->name }}
                                <i class="text-white"> {{ $comment->created_at->diffForHumans() }}
                                @if(\Illuminate\Support\Facades\Auth::id() == $comment->user->id)
                                    <a onclick="return confirm('Are you really want to delete your comment')" href="{{ url('/comment/'.$comment->id.'/delete') }}">Delete</a>
                                @endif
                                </i>
                            </p>
                        </div>
                    @empty
                        <p class="text-white-50">No comments yet</p>
                    @endforelse
                </div>
            </div>
        </div>
    </header>
@endsection
