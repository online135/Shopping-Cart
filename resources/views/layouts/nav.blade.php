<header>
    <nav class="nav">
        <ul class="nav-list">
            <li class="nav-list-item"><a href="{{ url('/') }}">首頁</a>
            <li class="nav-list-item"><a href="{{ url('/shopping') }}">購物車</a>
            <li class="nav-list-item"><a href="{{ url('/test') }}">測試頁面</a>
        </ul>
        <button type="button" class="nav-button"">
            <i class="fa fa-bars" aria-hidden="true">按鈕</i>
        </button>

        <a href="{{ route('product.show') }}" class="btn btn-info" role="button">Show Page</a>

    </nav>
</header>