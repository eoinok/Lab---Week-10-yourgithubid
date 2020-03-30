@extends('layouts.app')
@section('content')
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> 
<div style="padding-top:7%" class="container-fluid"> 
    <nav class="navbar navbar-default navbar-fixed-top"> 
        <ul class="list-inline nav navbar-nav navbar-right">
            <li><button id="checkOut" onclick="window.location.href=''" type="button" class="btn btn-primary navbar-btn center-block">Check Out</button></a></li> 
            <li><button id="emptycart" type="button" class="btn btn-primary navbar-btn center-block">Empty Cart</button></li> 
            <li><span style="font-size:40px;margin-right:0px;" class="glyphicon glyphicon-shopping-cart navbar-btn"></span></li> 
            <li><div class="navbar-text" id="shoppingcart" style="font-size:12pt;margin-left:0px;margin-right:0px;"></div></li> 
            <li><div class="navbar-text" style="font-size:14pt;margin-left:0px;">Item(s)</div></li> 
        <ul> 
    </nav> 
</div>
@include('flash::message') 
@php $j=0 @endphp 
@foreach($products as $product) 
    @if ($j==0) <div class='row'> @endif 
        <div class="col-sm-4"> 
            <div class="panel panel-primary"> 
            <div class="panel-heading">{{ $product->name }} {{ $product->description }}</div> 
            <div class="panel-body"><img style="width:80%;height:200px;" class="img-responsive center-block" src="{{ asset('/img/' . $product->image)}}"/></div> 
            <div class="panel-footer"><button id="addItem" type="button" class="btn btn-default center-block addItem" value="{{$product->id}}">Add To Cart</button></div> 
        </div> 
    </div> 
    @php $j++ @endphp 
    @if ($j==3) @php $j=0 @endphp </div> @endif 
@endforeach
<script>
$(".bth,.addItem").click(function() {
    var total = parseInt($('#shoppingcart').text());
    var i=$(this).val();
    $('#shoppingcart').text(total);    
    $.ajax({
      type: "get",
      url: "{{url('products/additem/')}}" + "/" + i,
      type: "GET",
      success: function(response) {
          total=total+1;
          $('#shoppingcart').text(total);
      },
      error: function() {
          alert("problem communicating with the server");
      }
    });
});
</script>
@endsection('content')