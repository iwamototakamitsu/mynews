@extends('layouts.front')

@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
                @foreach($profiles as $profile)
                    <div class="post">
                        <div class="row">
                            <div class="text col-md-6">
                                <div class="date">
                                    {{ $profile->updated_at->format('Y年m月d日') }}
                                </div>
                                <div class="name">
                                    {{ str_limit($profile->name, 150) }}
                                </div>
                                <div class="body mt-3">
                                    {{ str_limit($profile->gender, 1500) }}
                                </div>
                                <div class="body mt-3">
                                    {{ str_limit($profile->introduction, 1500) }}
                                </div>
                                <div class="body mt-3">
                                    {{ str_limit($profile->hobby, 1500) }}
                                </div>
                            </div>
                            <div class="image col-md-6 text-right mt-4">
                                @if ($profile->image_path)
                                    <img src="{{ asset('storage/image/' . $profile->image_path) }}">
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr color="#c0c0c0">
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection