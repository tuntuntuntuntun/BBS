@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="border p-4">
            <div class="mb-4" style="display:inline-block;">
                <!-- <a href="{{ route('posts.edit', ['post' => $post]) }}" class="btn btn-primary">編集する</a> -->
                <a href="{{ action('PostController@edit', ['post' => $post]) }}" class="btn btn-primary">編集する</a>
            </div>
            <form action="{{ route('posts.destroy', ['post' => $post]) }}" method="post" style="display:inline-block;">
                @csrf
                @method('delete')
                <button class="btn btn-danger">削除する</button>
            </form>
            <h1 class="h5 mb-4">{{ $post->title }}</h1>

            <!-- index.blade.phpと同じ、関数化する -->
            <p class="mb-5">{!! nl2br(e($post->body)) !!}</p>

            <section>
                <h2 class="h5 mb-4">コメント</h2>
            </section>

            <form action="{{ route('comments.store') }}" method="post" class="mb-4">
            @csrf

            <input type="hidden" name="post_id" value="{{ $post->id }}">

            <div class="form-group">
                <label for="body">本文</label>
                <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body" id="body" rows="4">
                    {{ old('body') }}
                </textarea>

                @if ($errors->has('body'))
                    <div class="invalid-feedback">
                        {{ $errors->first('body') }}
                    </div>
                @endif
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">コメントする</button>
            </div>
        </form>

            @forelse($post->comments as $comment)
                <div class="border-top p-4">
                    <p class="text-secondary">
                        {{ $comment->created_at->format('Y.m.d H:i') }}
                    </p>
                    <p class="mt-2">
                        {!! nl2br(e($comment->body)) !!}
                    </p>
                </div>
            @empty
                <p>コメントはありません</p>
            @endforelse
        </div>
    </div>
@endsection