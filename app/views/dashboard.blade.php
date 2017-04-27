@extends('template')
@section("menu_elements")
  @if($auth==1)
  <li id="admin" class="">
      <a href="{{URL::to('admin')}}">

          <span class="link-title">&nbsp;Admin Control</span>
      </a>
  </li>
  @endif
@endsection
@section("content")
<div class="row">
  <div class="col-lg-12">
    <h1 class="text-center">Welcome!</h1>
  </div>
</div>
<div class="row">
  <div class="col-lg-6 offset-lg-3">
    <p class="text-center">
      Welcome to <b>StatsOnStats</b>! The number one place (voted by CPSC365) for all your intro statistic needs! Choose a menu option on the left to get started!
    </p>
  </div>
</div>
@endsection
