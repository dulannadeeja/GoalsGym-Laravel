@php
    use \Illuminate\Support\Str;
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upcoming Classes') }}
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
            <ul class="space-y-6 mb-8">
                @forelse($allScheduledClasses as $class)
                    <li class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                        @if(in_array($class->id,$bookedClasses))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                                <p>You have been attendee for this
                                    class</p>
                            </div>
                        @endif
                        <div class="flex justify-between gap-10 sm:gap-20">
                            <div class="flex gap-5 sm:gap-10 flex-shrink flex-grow-0">
                                <div
                                    class="border border-gray-500 rounded-lg p-5 flex justify-center items-center basis-1/3">
                                    <p class="text-lg text-center font-semibold">{{ ($class->started_at)->diffForHumans() }}</p>
                                </div>
                                <div class="basis-2/3">
                                    <h2 class="text-2xl font-semibold mb-4">{{ $class->classType->name }}</h2>
                                    <p class="text-lg text-gray-400 mb-4">{{ Str::of($class->classType->description)->limit(150,'...') }}</p>
                                    <div class="flex gap-5 items-center">
                                        <p class="text-2xl font-semibold text-amber-600">{{ $class->started_at->format('dS M') }}</p>
                                        <p class="text-lg">{{ $class->started_at->format('h:i a') }}</p>
                                    </div>
                                    <div class="flex gap-5 items-center">
                                        <p class="text-lg"><span class="text-2xl font-semibold text-amber-600">Conducted by:</span> {{$class->instructor->name}}
                                        </p>
                                        <p class="text-lg"><span
                                                class="text-2xl font-semibold text-amber-600">Duration:</span> {{ $class->classType->duration}}
                                            miniutes</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-shrink-0 basis-1/8">
                                @if(in_array($class->id,$bookedClasses))
                                    <form action="{{ route('member.bookings.destroy',$class->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <x-secondary-button type="submit">Cancel</x-secondary-button>
                                    </form>
                                @else
                                    <form action="{{ route('member.bookings.store',$class->id) }}" method="post">
                                        @csrf
                                        <x-primary-button type="submit">Take a Seat</x-primary-button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </li>
                @empty
                    <div
                        class="text-lg max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                        {{ __("We don't have any upcoming classes that you can book.") }}
                    </div>
                @endforelse
            </ul>
            {{ $allScheduledClasses->links() }}
        </div>
    </div>
</x-app-layout>
