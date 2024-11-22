<x-layout>
    <div class="container py-md-5 container--narrow">
        <form action="/post/{{$post->id}}" method="POST">
            @csrf
            @method('PUT') {{-- bypass the POST method above--}}
          <div class="form-group">
            <label for="post-title" class="text-muted mb-1"><small>Title</small></label>
            <input value="{{old('title',$post->title)}}" name="title" id="post-title" class="form-control form-control-lg form-control-title" type="text" placeholder="" autocomplete="off" /> {{-- if there is no old value,get the title of the post --}}
            @error('title')
            <p>{{$message}}</p>
            @enderror
          </div>
  
          <div class="form-group">
            <label for="post-body" class="text-muted mb-1"><small>Body Content</small></label>
            <textarea name="body" id="post-body" class="body-content tall-textarea form-control" type="text">{{old('body',$post->body)}}</textarea> {{-- if there is no old value,get the body of the post --}}
            @error('body')
            <p>{{$message}}</p>
            @enderror
          </div>
  
          <button class="btn btn-primary">Save Changes</button>
        </form>
      </div>
</x-layout>