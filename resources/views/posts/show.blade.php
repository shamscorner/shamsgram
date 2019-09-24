@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <img src="/storage/{{ $post->image }}" class="w-100">
            </div>
            <div class="col-md-4">
                <div>
                    <div class="d-flex align-items-center">
                        <div class="pr-3">
                            <img src="{{ $post->user->profile->profileImage() }}" 
                            alt="User Image" 
                            class="rounded-circle w-100"
                            style="max-width: 50px;">
                        </div>
                        <div>
                            <a href="/profile/{{ $post->user->id }}" class="font-weight-bold">
                                <span class="text-dark">{{ $post->user->username }}</span>
                            </a>
                            @if (Auth::User()->id != $post->user->id)
                            | <follow-button user-id={{ $post->user->id }} follows={{ $follows }}></follow-button>
                            @endif
                        </div>
                    </div>

                    <hr>
                    
                    <p>
                        <span class="font-weight-bold">
                            <a href="/profile/{{ $post->user->id }}">
                                <span class="text-dark">{{ $post->user->username }}</span>
                            </a>
                        </span>
                        {{ $post->caption }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection