@extends('layouts.backend.app')

@section('title','Post')

@push('css')
   <!-- Bootstrap Select Css -->
    <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css ') }}" rel="stylesheet" />
<!-- Multi Select Css -->
    <link href="{{ asset('assets/backend/plugins/multi-select/css/multi-select.css') }}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

     <link href="{{ asset('assets/backend/css/themes/all-themes.css') }}" rel="stylesheet" />
    @endpush

@section('content')
 <div class="container-fluid">

<a href="{{ route('admin.post.index') }}" class="btn btn-danger">BACK</a>
@if($post->is_approved==false)
<button type="button" class="btn btn-success pull-right" onclick="approvePost({{ $post->id }})">
     <span>APPROVE ?</span>
</button>
<form action="{{ route('admin.post.approve',$post->id) }}" method="POST" id="approve-form" style="display: none">
@csrf
@method('PUT')
</form>
<br>

@else
<button type="button" class="btn btn-success pull-right" disabled >
     <i class=" material-icons">done</i>
     <span>APPROVED</span>
</button>

@endif
<br>


            <div class="row clearfix">
                <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                            {{$post->title}}
                            <small>Posted By <strong><a href="">{{ $post->user->name }}</a></strong> On {{ $post->created_at->toFormattedDateString()  }}</small>
                            </h2>

                        </div>
                        <div class="body">
                            {!! $post->body !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="header bg-cyan">
                                Categories
                            </h2>
                        </div>
                        <div class="body">
                            @foreach ($post->categories as $category)
                            <span class="label bg-cyan">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2 class="header bg-cyan">
                                Tags
                            </h2>
                        </div>
                        <div class="body">
                            @foreach ($post->tags as $tag)
                            <span class="label bg-cyan">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2 class="header bg-cyan">
                                Image
                            </h2>
                        </div>
                        <div class="body">
                           {{-- <img class="img-responsive" src="{{ Storage::disk('public')->url('post/'.$post->image) }}" alt="Image"> --}}
                           <img class="img-responsive" src="{{ url('storage/post/'.$post->image) }}" alt="{{ $post->name }}">
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Vertical Layout -->

        </div>
@endsection

@push('js')
  <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
<!-- Multi Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
<!-- TinyMCE -->


     <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

     <script type="text/javascript">
       function approvePost(id){
          swal({
                title: 'Are you sure?',
                text: "You want to appreve this post?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approvee it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
  if (result.value) {
    event.preventDefault();
    document.getElementById('approve-form').submit();

  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'The post is remain pending:)',
      'info'
    )
  }
})
       }
     </script>

