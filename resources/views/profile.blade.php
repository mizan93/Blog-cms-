@extends('layouts.frontend.app')

@section('title')
{{ $author->name }}
@endsection
@push('css')
<link rel="stylesheet" href="{{ asset('assets/frontend/css/profile/styles.css') }}">
<link rel="stylesheet" href="{{ asset('assets/frontend/css/profile/responsive.css') }}">
<style>
   
    
</style>
@endpush
@section('content')
	<div class="slider display-table center-text">
		<h1 class="title display-table-cell"><b>BEAUTY</b></h1>
	</div><!-- slider -->

	<section class="blog-area section">
		<div class="container">

			<div class="row">

				@foreach ($posts as $post)
                <div class="col-lg-4 col-md-9">
					<div class="card h-100">
						<div class="single-post post-style-1">

							<div class="blog-image"><img src="{{ Storage::disk('public')->url('post/'.$post->image) }}" alt="{{ $post->name }}"></div>

							<a class="avatar" href="{{ route('author.profile',$post->user->username)}}"><img src="{{ Storage::disk('public')->url('profile/'.$post->user->image) }}"></a>

							<div class="blog-info">

								<h4 class="title"><a href="{{ route('post.details',$post->slug) }}"><b>{{ $post->title }}</b></a></h4>

								<ul class="post-footer">

									<li>
                                     @guest
                                    <a href="javascript:void(0);" onclick="toastr.info('To add favorite list. You need to login first.','Info',{
                                                closeButton: true,
                                                progressBar: true,
                                     })"><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>

                                  @else
                                    <a href="javascript:void(0);" onclick="document.getElementById('favorite-post{{ $post->id }}').submit();"
                                        class="{{ !Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count()  == 0 ? 'favorite_posts' : ''}}"
                                        ><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>
                                    <form id="favorite-post{{ $post->id }}" method="POST" action="{{ route('post.favorite',$post->id) }}" style="display:none">
                                    @csrf
                                    </form>
                                  @endguest

                                    </li>
									<li><a href="#"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                    {{-- <li><a href="#"><i class="ion-share"></i>57</a></li> --}}
								</ul>

							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
				</div><!-- col-lg-4 col-md-6 -->
                @endforeach
         <div class="col-lg-4 col-md-3 ">

					<div class="single-post info-area ">

						<div class="about-area">
							<h4 class="title"><b>ABOUT AUTHOR</b></h4>
							<p>{{ $author->name}}</p><br>
							<p>{{ $author->about}}</p><br>
							<strong>Author Since: {{ $author->created_at->toDateString()}}</strong><br>
							<strong>Total Post: {{ $author->posts->count()}}</strong><br>
                          
                            
						</div>

						


					</div><!-- info-area -->

				</div><!-- col-lg-4 col-md-12 -->
				

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- section -->



	
@endsection
@push('js')

@endpush
