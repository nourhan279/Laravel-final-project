@extends('layouts.master')

@section('title', 'Registration Form')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    main {
        background-color: #F1FEFC;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 500px;
        position: relative;
        display: flex;
        justify-content: center;
    }
    .form-container {
        margin: 30px auto;
        background-color: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 23px 33px hsla(348, 29%, 93%, 1), 0 -10px 20px hsla(348, 29%, 93%, 1);
        max-width: 500px;
    }
    h2 { text-align: center; color: #444; }
    label { margin-top: 10px; display: block; font-weight: bold; }
    input, textarea, select {
        width: 100%;
        padding: 10px;
        margin: 4px 0 8px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }
    input:focus { border: 3px solid #555; }
    button {
        background-color:hsla(347, 64%, 20%, 1);
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 13px;
        width: 100%;
        padding: 10px 20px;
    }
    button:hover { background-color: rgb(107, 103, 104); }
    .input-button-group {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }
    #wpbutton {
        padding: 13px 12px;
        width: 30%;
        white-space: nowrap;
    }
    .text-danger { color: red; font-size: 0.85em; margin-top: 2px; margin-bottom: 5px; }
    .is-invalid { border-color: red !important; }
</style>
@endsection

@section('content')
<div class="form-container">
    <div id="alertBox" style="display: none;" class="alert"></div>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if($errors->any())

<div class="alert alert-danger">
	<ul>
	@foreach($errors->all() as $error)

		<li>{{ $error }}</li>

	@endforeach
	</ul>
</div>

@endif
    <h2>Registration Form</h2>

    <form id="myForm" method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data" onsubmit="return validateForm()">
        @csrf
        <input type="hidden" name="register" value="1">

        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" class="@error('full_name') is-invalid @enderror">
        <div class="text-danger" id="full_name_error">@error('full_name'){{ $message }}@enderror</div>

        <label for="user_name">Username:</label>
        <input type="text" id="user_name" name="user_name" value="{{ old('user_name') }}" class="@error('user_name') is-invalid @enderror">
        <div class="text-danger" id="user_name_error">@error('user_name'){{ $message }}@enderror</div>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror">
        <div class="text-danger" id="email_error">@error('email'){{ $message }}@enderror</div>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="@error('phone') is-invalid @enderror">
        <div class="text-danger" id="phone_error">@error('phone'){{ $message }}@enderror</div>

        <label for="whatsapp">WhatsApp Number:</label>
        <div class="input-button-group">
            <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" class="@error('whatsapp') is-invalid @enderror">
            <button type="button" onclick="checkWhatsAppNumber()" id="wpbutton">Check Validity</button>
        </div>
        <div class="text-danger" id="whatsapp_error">@error('whatsapp'){{ $message }}@enderror</div>

        <label for="country">Address:</label>
        <div style="display: flex; gap: 10px;">
            <input type="text" id="country" name="country" placeholder="Country" style="flex: 1;" value="{{ old('country') }}" class="@error('country') is-invalid @enderror">
            <input type="text" id="city" name="city" placeholder="City" style="flex: 1;" value="{{ old('city') }}" class="@error('city') is-invalid @enderror">
        </div>
        <div class="text-danger" id="country_error">@error('country'){{ $message }}@enderror</div>
        <div class="text-danger" id="city_error">@error('city'){{ $message }}@enderror</div>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" class="@error('password') is-invalid @enderror">
        <div class="text-danger" id="password_error">@error('password'){{ $message }}@enderror</div>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="password_confirmation" class="@error('password_confirmation') is-invalid @enderror">
        <div class="text-danger" id="confirm_password_error">@error('password_confirmation'){{ $message }}@enderror</div>

        <label for="file">User Image:</label>
        <input type="file" id="file" name="file" accept="image/*" class="@error('file') is-invalid @enderror">
        <div class="text-danger" id="file_error">@error('file'){{ $message }}@enderror</div>

        <p style="color: gray; font-size: 0.85em;">* All fields are required</p>
        <button type="submit" name="register">Register</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const lang = '{{ str_contains(request()->path(), "Arabic") ? "ar" : "en" }}';
</script>
<script src="{{ asset('js/Validations.js') }}"></script>
<script src="{{ asset('js/whatsapp-checker.js') }}"></script>
@endsection
