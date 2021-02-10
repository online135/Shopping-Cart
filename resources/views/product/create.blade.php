@extends('layouts.app')

@section('content')

<form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
    @csrf
    <div>
        <label>
            Product name: <input type="text" name="product_name" value="{{ old('product_name') }}"/>
        </label>
    </div>
    <br />
    <div>
        <label>
            Product price: <input type="number" min=0 name="product_price" value="{{ old('product_price') }}"/>
        </label>
    </div>
    <br />
    <div>
        <label>
            Product image:
                <input
                    type="file"
                    name="product_image"
                    data-target="preview_product_image"
                />
        </label>
        <br/>
        <div>
            <img
                style="max-width: 400px"
                id="preview_product_image"
                src="https://via.placeholder.com/400x300"
                />
        </div>
        <script>

        var input = document.querySelector('input[name=product_image]')
        input.addEventListener('change', function(e) {
            readURL(e.target)
        })
        function readURL(input) {
            var imgId = input.getAttribute('data-target')
            var img = document.querySelector('#' + imgId)
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    img.setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        </script>
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