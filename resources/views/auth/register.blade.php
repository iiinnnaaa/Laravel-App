<form method="POST" action="{{ route('registration') }}">
    @csrf
    <!-- Email input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="form1Example1">Name</label>
        <input type="text" id="form1Example1" class="form-control" name="name"/>
        @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>

    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example1">Email</label>
        <input type="select" id="form2Example1" class="form-control" name="email"/>
        @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
    </div>

    @include('auth.roles')

    <!-- Password input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example2">Password</label>
        <input type="password" id="form2Example2" class="form-control" name="password"/>
        @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif
    </div>

    <!-- Submit button -->
    <input type="submit" value="Register" class="btn btn-primary btn-block mb-4">
    <a class="nav-link" href="{{ route('login') }}">Login</a>

</form>
