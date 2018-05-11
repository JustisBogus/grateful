@extends('layouts.master')

@section('content')
@include('includes.messages')
<section class="newpost">
    <div class="column">
    <header><h3>What are you grateful for today?<h3></header>
        <form action="{{ route('post.create') }}" method="post">
        <div class="formgroup">
            <textarea class="formcontrol" name="body" id="newpost" rows="5" placeholder="Your Post"></textarea>
            </div>
            <button type="submit" class="button">Create Post</button>
            <input type="hidden" value="{{ Session::token() }}" name="_token">
        </form>
    </div>
</section>
        <section class="rowposts">
        <div class="column">
            <header><h3>Shared by others</h3></header>
            @foreach($posts as $post)
            <article class="post" data-postid="{{ $post->id }}">
            <p>{{ $post->body }}</p>
                <div class="info">Posted By {{ $post->user->username }} on {{ $post->created_at }}</div>
                <div class="interaction">
                    <a onclick="actOnChirp(event);" data-post-id="{{ $post->id }}" href="#" class="like" id="countlike">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a>
                    <a onclick="actOnChirp(event);" data-post-id="{{ $post->id }}"  href="#" class="like" id="countdislike">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'  }}</a>
                    @if(Auth::user() == $post->user)
                    <a href="#" class="edit">Edit</a>
                    <a href="{{ route('post.delete', ['post_id' => $post->id]) }}" class="delete">Delete</a>
                     @endif
                     <span href="#" class="likecount" id="likes-count-{{ $post->id }}">{{ $post->likes_count }} </span>
                    <span href="#" class="dislikecount" id="dislikes-count-{{ $post->id }}">{{ $post->likes_count }} </span>
                     
                   
                    <div>
                        <a>-</a>
                    </div>
                </div>
            </article>
            @endforeach
            </div>
        
        </section>
        
        <div class="modal fade" tabindex="-1" role="dialog" id="editmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Post</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="post-body">Edit The Post</label>
              <textarea class="form-control" name="post-body" id="post-body" rows="5"></textarea>
        </div>
           </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="button" data-dismiss="modal">Close</button>
        <button type="button" class="button" id="modal-save">Save</button>
      </div>
    </div>
  </div>
</div>
        <script>
    var token = '{{ Session::token() }}';
    var urlEdit = '{{ route('edit') }}';
    var urlLike = '{{ route('like') }}';
  
    </script>
@endsection
        
   