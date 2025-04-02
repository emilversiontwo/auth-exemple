@extends('../layout')

@section('content')
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg p-6 flex flex-col items-center">
            <h1 class="text-2xl font-bold text-gray-800">Добро пожаловать в админ панель</h1>
            <div class="w-full border-b-4 border-b-black my-8"></div>
            <a href="{{route('admin.create')}}" class="bg-black rounded-xl border-2 border-b-slate-400 p-4 text-amber-50 m-8">Добавить Предмет</a>
            @foreach($items as $item)
                <div class="bg-slate-400 rounded-xl w-min mb-8 p-8 shadow-md shadow-black">

                    <label for="name{{$item['id']}}">Called</label>
                    <div id="name{{$item['id']}}" class="m-1 rounded-xl border-2 border-amber-50 p-2 w-min shadow-md shadow-black">
                        {{ $item['name'] }}
                    </div>

                    <label for="price{{$item['id']}}">Price</label>
                    <div id="price{{$item['id']}}" class="m-1 rounded-xl border-2 border-amber-50 p-2 w-min shadow-md shadow-black">
                        {{ $item['price'] }}
                    </div>

                    <label for="quantity{{$item['id']}}">Quantity</label>
                    <div id="quantity{{$item['id']}}" class="m-1 rounded-xl border-2 border-amber-50 p-2 w-min shadow-md shadow-black">
                        {{ $item['quantity'] }}
                    </div>

                    <a href="{{route('admin.show', ['admin'=>$item['id']])}}" class="bg-black rounded-xl border-2 border-b-slate-400 p-4 text-amber-50 m-4">Посмотреть</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
