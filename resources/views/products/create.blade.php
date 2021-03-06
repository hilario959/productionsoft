@extends('layouts.app')@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add a Product') }}
                    <a class="float-right" href="{{ route('product.index') }}">{{ __('Back') }}</a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                    @endif
                    <form method="post" action="{{ route('product.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}"/>
                        </div>
                        <div class="form-group">
                            <label for="code">{{ __('SKU') }}</label>
                            <input type="text" class="form-control" name="code" value="{{ old('code') }}"/>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <input type="text" class="form-control" name="description" value="{{ old('description') }}"/>
                        </div>
                        <div class="form-group">
                            <label for="price">{{ __('Price') }}</label>
                            <input type="number" class="form-control" name="price" value="{{ old('price') }}"/>
                        </div>

                        @include('products.partials.materials', ['materials' => $materials])

                        <button class="btn btn-link" type="submit">{{ __('Add Product') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
