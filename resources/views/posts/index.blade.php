@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="mb-4">
            <a href="{{ route('posts.create') }}" class="btn btn-primary">
                投稿を新規作成する
            </a>
        </div>
        @foreach ($posts as $post)
            <div class="card mb-4">
                <div class="card-header">
                    {{ $post->title }}
                </div>
                <div class="card-body">
                    <p class="card-text">
                        <!-- このプログラムを別のところに書いて関数にする、ここでは呼び出すだけにする -->
                        <!-- どこに書けばいいかは調べよう -->
                        {!! nl2br(e(str_limit($post->body, 200))) !!}
                    </p>
                    <a href="{{ action('PostController@show', ['post' => $post]) }}" class="card-link">続きを読む</a>
                </div>
                <div class="card-fooer">
                    <span class="mr-2">
                        投稿日時 {{ $post->created_at->format('Y.m.d') }}
                    </span>

                    @if ($post->comments->count())
                        <span class="badge badge-primary">
                            コメント {{ $post->comments->count() }}件
                        </span>
                    @endif
                </div>
            </div>
        @endforeach
        <div class="d-flex justify-conetent-center mb-5">
            {{ $posts->links() }}
        </div>
    </div>
@endsection