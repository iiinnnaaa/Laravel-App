<div>
    <div class="name">
        {{--<div>Name: {{ auth()->user()->fullName }}</div>--}}
        <div>Name: {{ $user['name'] }}</div>
    </div>
    <div class="email">
        <div>Email: {{ $user['email'] }}</div>
    </div>
    <div class="role">
        <div>Role: {{ $user['role'] }}</div>
    </div>
    <div class="image">
{{--        <div>Image: {{ $user['image'] }}</div>--}}
        <img src='{{ asset("storage/{$user['image']}") }}' width="100" height="100">
        <div></div>
    </div>
</div>
<div>
    <div class="edit">
        <a class="nav-link" href="{{ route('update') }}">Update</a>
    </div>
    <div class="logout">
        <a class="nav-link" href="{{ route('signout') }}">Logout</a>
    </div>
</div>
