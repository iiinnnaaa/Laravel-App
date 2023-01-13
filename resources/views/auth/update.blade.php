<form method="POST" action="{{ route('update') }}">
    @csrf

    <!-- Email input -->
    <div class="form-outline mb-4">
        <label class="form-label" for="form1Example1">Name</label>
        <input type="text" id="form1Example1" class="form-control" name="name" value="{{ $user['name'] }}"/>
        @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>

    <div class="form-outline mb-4">
        <label class="form-label" for="form2Example1">Email address</label>
        <input type="email" id="form2Example1" class="form-control" name="email" value="{{ $user['email'] }}"/>
        @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
    </div>

    @include('auth.roles')

    <!-- Submit button -->
    <input type="submit" value="Save" class="btn btn-primary btn-block mb-4">

</form>
