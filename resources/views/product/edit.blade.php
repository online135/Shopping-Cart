@extends('layouts.app')

@section('content')

<form method="post" action="{{ route('products.update', ['product' => $product->id ]) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div>
        <label>
            Product name: <input type="text" name="name" value="{{ old('product_name') ?? $product->name }}"/>
        </label>
    </div>
    <br />
    <div>
        <label>
            Product price: <input type="number" min=0 name="price" value="{{ old('product_price') ?? $product->price }}"/>
        </label>
    </div>
    <br />
    <div>
        <label>
            Product image: <input type="file" name="image" accept="image/png, image/jpeg"/>
        </label>
    </div>
    <br />
    <div>
        <button type="submit">Submit</button>
    </div>
</form>
        @if($errors->products->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->products->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
@endsection

@section('inline_js')
    @parent
@endsection