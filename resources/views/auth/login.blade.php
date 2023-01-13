<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example1">Email address</label>
        <input type="email" id="form2Example1" class="form-control" name="email"/>
        @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example2">Password</label>
        <input type="password" id="form2Example2" class="form-control" name="password" />
        @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif
    </div>

    <!-- Submit button -->
    <input type="submit" value="Sign in" class="btn btn-primary btn-block mb-4">
    <a class="nav-link" href="{{ route('registration') }}">Register</a>

</form>
