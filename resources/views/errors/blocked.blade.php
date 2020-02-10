@section('title')
  {!! $data['pageInfo']->title !!}
@endsection
@section('meta')
<body style="margin: 0; background-color: white;">
  @include('public.layouts.partials.head')
<div class="container">

<div class="bc-home-btn" style="text-align: center;
    position: absolute;
    left: 50%;
    bottom:  100px;
    transform: translateX(-50%);">
		<h1>{{$data['pageInfo']->heading}}</h1>
		<img src="{{url('/uploads/images/'.$data['pageInfo']->image)}}" />
		<p> {!! $data['pageInfo']->note!!} </p>
	</div>
</div>
</body>
