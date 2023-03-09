<x-app-layout>
    @if ($errors->any())
       {{-- <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>--}}
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#AppModal').modal('show');
            });
        </script>


    @endif

        @if (session('status') === 'stored')
            <div style="position:absolute;top:20%;left:40%;min-width: 300px"
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 3000)"
                class="mx-5 rounded  text-sm bg-success text-white  p-3  dark:text-gray-400 text-center"
            >{{ __('Stored') }}</div>

        @endif

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Bikes') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 direction-rtl" style="direction: rtl">

                <div class="    dark:bg-info-800   mb-2   text-white">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary bg-primary " data-toggle="modal" data-target="#AppModal">
                        New Bike
                    </button>

                </div>
                <div class="row   dark:bg-info-800 overflow-hidden shadow-sm sm:rounded-lg mb-2 bg-info text-white">
                    <div class="col-2 p-6  dark:text-gray-100">{{ __('main.bike.name',[],'fa') }}</div>
                    <div class="col-2 p-6  dark:text-gray-100">{{ __('main.bike.model',[],'fa') }}</div>
                    <div class="col-2 p-6  dark:text-gray-100">{{ __('main.bike.color',[],'fa') }}</div>
                    <div class="col-2 p-6  dark:text-gray-100">{{ __('main.bike.weight',[],'fa') }}</div>
                    <div class="col-2 p-6  dark:text-gray-100">{{ __('main.bike.price',[],'fa') }}</div>
                </div>
            @foreach ($bikes as $bike)
                <div class="row bg-white dark:bg-gray-80 0 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="col-2 p-6 text-gray-900 dark:text-gray-100">
                        {{ $bike->name }}
                    </div>
                    <div class="col-2 p-6 text-gray-900 dark:text-gray-100">
                        {{ $bike->bike_model->name ?? ''}}
                    </div>
                    <div class="col-2 p-6 text-gray-900 dark:text-gray-100">
                        {{ $bike->color->name }}
                    </div>
                    <div class="col-2 p-6 text-gray-900 dark:text-gray-100">
                        {{ $bike->weight }}  {{ __('کیلوگرم') }}
                    </div>
                    <div class="col-2 p-6 text-gray-900 dark:text-gray-100">
                        {{ $bike->price }}   {{ __('تومان') }}
                    </div>
                </div>
            @endforeach

        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="AppModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"   >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('dashboard.bikes.new') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                    @csrf
                    @method('post')
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Bike</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>
                        <div>
                            <x-input-label for="weight" :value="__('Weight')" />
                            <x-text-input id="weight" name="weight" type="text" class="mt-1 block w-full" :value="old('weight')" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('weight')" />
                        </div>
                        <div>
                            <x-input-label for="Price" :value="__('Price')" />
                            <x-text-input id="Price" name="price" max-length="8"  type="text" class="mt-1 block w-full" :value="old('price')" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('price')" />
                        </div>
                        <div>
                            <x-input-label for="color_id" :value="__('Color')" />
                            <select name="color_id" id="color_id" class="dropdown">
                                <option value=""/>select one</option>
                                @foreach($colors as $color)
                                    <option value="{{$color->id}}" @if($color->id==old('color_id')) selected @endif />{{$color->name}}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('color_id')" />
                        </div>
                        <div>
                            <x-input-label for="model_id" :value="__('Model')" />
                            <select name="model_id" id="model_id" class="dropdown">
                                <option value=""/>select one</option>
                                @foreach($models as $model)
                                    <option value="{{$model->id}}" @if($model->id==old('model_id')) selected @endif   />{{$model->name}}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('model_id')" />
                        </div>
                        <div>
                            <x-input-label for="bike_img" :value="__('Bike_image')" />
                            <input type="file" class="form-control" name="bike_img"/>
                            <x-input-error class="mt-2" :messages="$errors->get('bike_image')" />
                        </div>
{{--

                        <div class="flex items-center gap-4">

                        </div>
                    --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <x-primary-button>{{ __('Save') }}</x-primary-button>


                </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#AppModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    </script>
</x-app-layout>
