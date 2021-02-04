<form method="post" action="{{ route('products.store') }}">
    @csrf
    <div>
        <label>
            Product name: <input type="text" name="product_name" value="{{ old('product_name') }}"/>
        </label>
    </div>
    <div>
        <button type="submit">Submit</button>
    </div>
</form>


@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif