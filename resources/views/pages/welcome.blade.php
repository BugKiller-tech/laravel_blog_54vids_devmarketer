@extends('main')


@section('title','Welcome to my site')

@section('content')
   
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                  <h1>Welcome to My Blog!</h1>
                  <p class="lead">Thank you so much for visiting. This is my test website built with Laravel. Please read my popular post!</p>
                  <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a></p>
                </div>
            </div>
        </div> <!-- end of header .row -->

        
        <!-- Content area-->
        <div class="row">
            <div class="col-md-8" >
                
                <div class="highlight">
                    <div class="clearfix">
                        <h1>Do you need more helps?</h1>
                        <p>
                            Please contact with me in upwork!
                            My name is Akira Kurosawa.
                        </p>
                        <p>Enjoy your learning</p>
                    </div>
                </div>


                @forelse($posts as $post)
                    <div class="post">
                        <h3>{{ $post->title }}</h3>
                        <p>{{ substr(strip_tags($post->body), 0, 300)}}{{ strlen(strip_tags($post->body))>300? '...' :''}}</p>
                        <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary">Read More</a>
                        <span>
                            <strong>Category: </strong>
                            <a href="{{ route('blog.category_posts', $post->category->id) }}">{{ $post->category->name }}</a>
                        </span>
                    </div>
                    <hr>
                @empty
                <div class="post">
                    <h3>Nothing posts!</h3>
                </div>
                @endforelse

            

            </div>
            {{-- sidebar --}}
            <div class="col-md-3 col-md-offset-1">
                <a href="" class="list-group-item active"><strong>Categories</strong></a>
                <div class="list-group">
                    @foreach($categories as $category)
                        <a href="{{ route('blog.category_posts', $category->id) }}" class="list-group-item list-group-item-danger">{{ $category->name }}
                        <span class="badge">{{ $category->posts->count()}}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>




        


    
@endsection