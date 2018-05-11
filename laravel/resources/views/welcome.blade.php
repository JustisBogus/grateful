@extends('layouts.master')

@section('title')

@endsection

@section('content')
@include('includes.messages')
<div class="row">
<div class="column">
    <h3>Sign Up</h3>
    <form action="{{ route('signup') }}" method="post">
    <div class="form {{ $errors->has('email') ? 'haserror' : '' }}">
        <label for="email"></label>
        <input class="formcontrol" type="text" name="email" id="email" placeholder="email" value="{{ Request::old('email') }}">
        </div> <div class="form {{ $errors->has('username') ? 'haserror' : '' }}">
        <label for="username"></label>
        <input class="formcontrol" type="text" name="username" id="username" placeholder ="user name" value="{{ Request::old('username') }}">
        </div> <div class="form {{ $errors->has('password') ? 'haserror' : '' }}">
        <label for="password"></label>
        <input class="formcontrol" type="password" name="password" id="password" placeholder ="password">
        </div>
        <button type"submit" class="button">Submit</button>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
     </form>
    </div>
    <div class="column">
        <h3>Sign In</h3>
    <form action="{{ route('signin')}}" method="post">
    <div class="form {{ $errors->has('email') ? 'haserror' : '' }}">
        <label for="email"></label>
        <input class="formcontrol" type="text" name="email" id="email" placeholder ="email" value="{{ Request::old('email') }}">
        </div> <div class="form {{ $errors->has('email') ? 'haserror' : '' }}">
        <label for="password"></label>
        <input class="formcontrol" type="password" name="password" id="password" placeholder ="password">
        </div>
        <button type"submit" class="button">Submit</button>
        <input type="hidden" name="_token" value="{{ Session::token() }}">
     </form>
    </div>
</div>
@endsection