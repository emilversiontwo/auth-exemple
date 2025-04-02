@extends('../layout')

@section('content')
    <div class="container mx-auto p-6">
        <form enctype="multipart/form-data" method="POST" action="{{ route('admin.store') }}">
            @csrf
            <label for="name" class="text-cyan-100 text-2xl">Called</label>
            <input id="name" name="name" value="{{ old('name') }}" type="text" class="border-2 bg-amber-100 border-b-zinc-500 rounded-xl size-15 w-full text-2xl">

            <label for="price" class="text-cyan-100 text-2xl">price</label>
            <input id="price" name="price" value="{{ old('price') }}" type="text" class="border-2 bg-amber-100 border-b-zinc-500 rounded-xl size-15 w-full text-2xl">

            <label for="quantity" class="text-cyan-100 text-2xl">quantity</label>
            <input id="quantity" name="quantity" value="{{ old('quantity') }}" type="text" class="border-2 bg-amber-100 border-b-zinc-500 rounded-xl size-15 w-full text-2xl">

            <input value="OK" type="submit" class="rounded-xl bg-white border-amber-300 m-4 p-4 border-2">
        </form>
    </div>
@endsection
