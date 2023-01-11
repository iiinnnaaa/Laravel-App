{{--@extends('layouts.app')--}}
<form method="POST" action="{{ route('update') }}">
    @csrf

    <!-- Email input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="form1Example1">Name</label>
        <input type="text" id="form1Example1" class="form-control" name="name"/>
    </div>

    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example1">Email address</label>
        <input type="email" id="form2Example1" class="form-control" name="email"/>
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example2">Old Password</label>
        <input type="password" id="form2Example2" class="form-control" name="password" />
    </div>
    <div class="form-outline mb-4">
        <label class="form-label" for="form3Example2">New Password</label>
        <input type="password" id="form3Example2" class="form-control" name="password" />
    </div>

    <!-- Submit button -->
    <input type="submit" value="Save" class="btn btn-primary btn-block mb-4">

</form>
