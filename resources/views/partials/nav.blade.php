<div class="navbar bg-base-100">
    <div>
        <a href="{{ route('home') }}" class="text-xl btn btn-ghost">{{ config('app.name') }}</a>
    </div>
    <div class="flex-1">
        <ul class="px-1 menu menu-horizontal">
            <li><a href="{{ route('page1') }}">Page 1</a></li>
            <li><a href="{{ route('page2') }}">Page 2</a></li>
            @auth
                <li class="z-10">
                    <details>
                        <summary>Admin</summary>
                        <ul class="p-2 rounded-t-none bg-base-100">
                            <li><a href="{{ route('posts.index') }}">Posts</a></li>
                            <li><a>Link 2</a></li>
                        </ul>
                    </details>
                </li>
            @endauth
        </ul>
    </div>
    <div class="gap-2">
        @guest
            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
            <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
        @else
            <ul class="px-1 menu menu-horizontal">
                <li class="z-10">
                    <details>
                        <summary>{{ auth()->user()->name }}</summary>
                        <ul class="p-2 rounded-t-none bg-base-100">
                            <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                            <li><button form="logout">Logout</button></li>
                        </ul>
                    </details>
                </li>
            <ul>
            <form id="logout" action="{{route('logout')}}" method="POST">
                @csrf
            </form>
        @endguest
    </div>
</div>
