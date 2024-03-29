<form method="POST" action="{{ route('update') }}" enctype="multipart/form-data">
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

    <div class="form-outline mb-4">
        <label class="form-label" for="form3Example1">Image</label>
        @if(!empty($user['image']))
            <img src='{{ asset("storage/{$user['image']}") }}' width="50" height="50">
            <a href="{{ url()->route('remove') }}">Remove</a>
        @else
            <input type="file" id="form3Example1" class="form-control" name="image"/>
        @endif
        @if ($errors->has('image'))
            <span class="text-danger">{{ $errors->first('image') }}</span>
        @endif
    </div>

    @include('auth.roles')

    <div class="actions">
        <a href="{{ url()->route('account') }}">Cancel</a>
        <input type="submit" value="Save" class="btn btn-primary btn-block mb-4">
    </div>

</form>
