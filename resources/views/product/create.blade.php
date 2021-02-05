@extends('layouts.app')

@section('content')

<form method="post" action="{{ route('products.store') }}">
    @csrf
    <div>
        <label>
            Product name: <input type="text" name="product_name" value="{{ old('product_name') }}"/>
        </label>
    </div>
    <div>
        <label>
            Product price: <input type="number" min=0 name="product_price" value="{{ old('product_price') }}"/>
        </label>
    </div>
    <div>
        <label>
            Product image: <input type="text" name="product_image" value="{{ old('product_image') }}"/>
        </label>
    </div>
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