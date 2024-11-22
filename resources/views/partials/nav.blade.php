<div class="navbar bg-base-100">
    <div class="flex-1">
        <a href="{{ route('home') }}" class="btn btn-ghost text-xl">{{ config('app.name') }}</a>
    </div>
    <div class="flex-none">
        <ul class="menu menu-horizontal px-1">
            <li><a href="{{ route('page1') }}">Page 1</a></li>
            <li><a href="{{ route('page2') }}">Page 2</a></li>
            <li>
                <details>
                    <summary>Parent</summary>
                    <ul class="bg-base-100 rounded-t-none p-2">
                        <li><a>Link 1</a></li>
                        <li><a>Link 2</a></li>
                    </ul>
                </details>
            </li>
        </ul>
    </div>
</div>
