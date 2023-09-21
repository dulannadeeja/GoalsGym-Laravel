<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Schedule a Class') }}
        </h2>
    </x-slot>

    @if(session()->has('success') || session()->has('error'))
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if(session()->has('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                         role="alert">
                        <strong class="font-bold">{{ session()->get('success') }}</strong>
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">{{ session()->get('error') }}</strong>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if(isset($types))
                    <form class="p-6 text-gray-900 dark:text-gray-100" action="{{ route('schedule.store') }}"
                          method="post">
                        @csrf
                        <div class="md:w-1/2 mb-6">
                            <x-input-label for="class_type" value="Select type of class" class="mb-2"/>
                            <x-select-input label="class type" name="class_type" :options="$types" class="w-full"
                                            autofocus selected="{{ old('class_type') }}"/>
                            <x-input-error :messages="$errors->get('class_type')" class="mt-2"/>
                        </div>
                        <div class="flex md:w-1/2 gap-5">
                            <div class="w-full">
                                <x-input-label for="start_date" value="Select date"/>
                                <x-date-input name="start_date" class="w-full" value="{{old('start_date')}}"/>
                            </div>
                            <div class="w-full">
                                <x-input-label for="start_time" value="Select time"/>
                                <x-time-input name="start_time" class="w-full" value="{{old('start_time')}}"/>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('starting_time')" class="mt-2"/>
                        <x-primary-button class="my-6">Schedule</x-primary-button>
                    </form>
                @else
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("You don't have any class types yet!") }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
