@extends('../layouts.main')
@section('content')

    @if(session()->get('success'))
        <div class="py-2 px-4 font-semibold bg-green-400 text-white mt-4 rounded-md">
            {{ session()->get('success') }}
        </div>
    @endif
    @if(session()->get('reject'))
        <div class="py-2 px-4 font-semibold bg-red-400 text-white mt-4 rounded-md">
            {{ session()->get('reject') }}
        </div>
    @endif
    <div class="flex justify-between">
        <h2
            class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
        >
            Заказы
        </h2>
    </div>
    <div class="w-full overflow-hidden rounded-lg shadow-lg border-t">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                >
                    <th class="px-4 py-3">Товар</th>
                    <th class="px-4 py-3">Фото</th>
                    <th class="px-4 py-3">Цена</th>
                    <th class="px-4 py-3">Дата</th>
                    <th class="px-4 py-3">Статус</th>
                </tr>
                </thead>
                <tbody
                    class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                >
                @foreach($orders as $order)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">
                            {{$order->product->name}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <div
                                class="w-16 h-16 rounded overflow-hidden"
                            >
                                <img
                                    class="object-cover w-full h-full"
                                    src="{{$order->product->image ? asset('/storage/'.$order->product->image) : '/img/no-photo.png'}}"
                                    alt=""
                                    loading="lazy"
                                />
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$order->product->price}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $order->created_at }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $order->getStatus() }}
                        </td>
                        @if($order->status===\App\Models\Order::STATUS_CREATED)
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <form action="{{ route('orders.confirm',$order) }}" method="post">
                                        @csrf
                                        @method('post')
                                        <button
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Подтвердить"
                                        >
                                            <svg fill="currentColor" class="w-5 h-5" viewBox="0 0 20 20">
                                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/> <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                                            </svg>
                                        </button>
                                    </form>
                                    <form action="{{ route('orders.reject',$order) }}" method="post">
                                        @csrf
                                        @method('post')
                                        <button
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Отклонит"
                                        >
                                            <svg fill="currentColor" class="w-5 h-5" viewBox="0 0 20 20">
                                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/> <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div
            class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
        >
            {{$orders->links()}}

        </div>
    </div>
@endsection

