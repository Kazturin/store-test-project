@extends('../layouts.main')
@section('content')
<x-breadcrumbs class="mt-2" :links="[['url'=>route('products.index'),'label'=>'Товары'],['label'=>'Добавить товар']]"></x-breadcrumbs>
    <div
        class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
    >

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="bg-red-500 text-white my-2 p-2 rounded">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('post')

            <div class="rounded border-0">

                <div class="my-2">
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Название</span>
                        <input
                            class="block w-full rounded border-gray-300 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Название"
                            name="name"
                        />
                    </label>
                </div>

                <div class="my-2">
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Описание</span>
                        <textarea
                            class="block w-full rounded border-gray-300 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Описание"
                            name="description"
                        ></textarea>
                    </label>
                </div>
            </div>

            <div class="my-2">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Цена</span>
                    <input
                        class="block w-24 rounded border-gray-300 mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        type="number"
                        min="1"
                        step="any"
                        name="price"
                    />
                </label>
            </div>

            <div class="flex items-center justify-center w-64 mt-4 text-gray-500 bg-purple-600 rounded-md">
                <div class="w-full p-4">
                    <h3 class="mb-8 text-xl text-center text-white">Загрузить фото</h3>
                    <div class="w-full max-w-2xl p-2 mx-auto bg-white rounded-lg">
                        <div class="" x-data="imageData()">
                            <div x-show="previewUrl == ''">
                                <p class="text-center uppercase text-bold">
                                    <label for="thumbnail" class="cursor-pointer">
                                        Загрузить
                                    </label>
                                    <input type="file" name="image" id="thumbnail" class="hidden" @change="updatePreview()">
                                </p>
                            </div>
                            <div x-show="previewUrl !== ''">
                                <img :src="previewUrl" alt="" class="rounded">
                                <div class="mt-2 text-center">
                                    <button type="button" class="text-red-500 rounded border border-red-500 p-2" @click="clearPreview()">Удалить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-4 py-3 text-right sm:px-6">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Добавить
                </button>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        function imageData() {
            return {
                previewUrl: "",
                updatePreview() {
                    var reader,
                        files = document.getElementById("thumbnail").files;

                    reader = new FileReader();

                    reader.onload = e => {
                        this.previewUrl = e.target.result;
                    };

                    reader.readAsDataURL(files[0]);
                },
                clearPreview() {
                    document.getElementById("thumbnail").value = null;
                    this.previewUrl = "";
                }
            };
        }
    </script>
@endpush
