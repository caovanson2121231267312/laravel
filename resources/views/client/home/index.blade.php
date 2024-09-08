@extends('extends.client')

@section('head')
    <title>Home page</title>
@endsection

@section('content')
    @include('client.home.top_products')

    @include('client.home.new_product')

    @include('client.home.hot_deal')

    @include('client.home.top_selling')

    @include('client.home.last_product')

@endsection


@section('script')
    <script></script>
@endsection
