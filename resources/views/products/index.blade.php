<x-app-layout title="Products">

    <section class="section">
        <h1 class="title">
            Products
        </h1>
        @foreach ($products as $product)
            <p>{{ $product->status }}</p>
        @endforeach
    </section>

</x-app-layout>