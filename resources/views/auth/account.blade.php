<div>
    <div class="name">
        <div>Name: {{ auth()->user()->fullName }}</div>
    </div>
    <div class="email">
        <div>Email: {{ $user['email'] }}</div>
    </div>
    <div class="role">
        <div>Role: {{ $user['role'] }}</div>
    </div>
    <div class="image">
        <div>Image: {{ $user['image'] }}</div>
{{--        {{ dd($user['image']) }}--}}
        <img src='{{ asset("storage/{$user['image']}") }}'>
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
