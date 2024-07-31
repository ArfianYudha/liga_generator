@extends('layout.app')

{{-- Set Title --}}
@section('title', 'Home')

@section('content')
    <header class="py-6 text-center">
        <h1 class="text-3xl font-bold text-gray-800">{{ $turnamen->nama_turnamen }}</h1>
        <div
            class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
            <ul class="flex flex-wrap justify-center -mb-px">
                <li class="me-2">
                    <a href="{{ route('tim.view', ['id_turnamenFK' => $turnamen->id]) }}"
                        class="px-20 inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Tim</a>
                </li>
                <li class="me-2">
                    <a href="{{ route('schedule.view', ['id_turnamenFK' => $turnamen->id]) }}"
                        class="px-20 inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Jadwal</a>
                </li>
                <li class="me-2">
                    <a href="{{ route('klasemen.view', ['id_turnamenFK' => $turnamen->id]) }}"
                        class="px-20 inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Klasemen</a>
                </li>
            </ul>
        </div>
    </header>

    <div class="pb-16 pt-16 lg:pb-20 lg:px-24 md:px-16 sm:px-8 px-8  lg:flex-row flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-style')
@endpush
