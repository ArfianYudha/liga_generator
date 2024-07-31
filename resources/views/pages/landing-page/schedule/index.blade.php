@extends('layout.app')

{{-- Set Title --}}
@section('title', 'Home')

@section('content')
    <!-- breadcumbs -->
    <header class="py-6 text-center">
        <h1 class="text-3xl font-bold text-gray-800">{{ $turnamen->nama_turnamen }}</h1>
        <div
            class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
            <ul class="flex flex-wrap justify-center -mb-px">
                <li class="me-2">
                    <a href="{{ route('tim.index', ['id_turnamenFK' => $turnamen->id]) }}"
                        class="px-20 inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Tim</a>
                </li>
                <li class="me-2">
                    <a href="{{ route('schedule.index', ['id_turnamenFK' => $turnamen->id]) }}"
                        class="px-20 inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500"
                        aria-current="page">Jadwal</a>
                </li>
                <li class="me-2">
                    <a href="{{ route('klasemen.index', ['id_turnamenFK' => $turnamen->id]) }}"
                        class="px-20 inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Klasemen</a>
                </li>
            </ul>
        </div>
    </header>
    <header class="bg-white shadow">
        <div class="flex max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="w-1/2">
                <h1 class="text-3xl font-bold text-gray-900">
                    Jadwal Pertandingan
                </h1>
            </div>
            <div class="w-1/2 text-right pt-2">
                <a href="{{ route('schedule.create', ['id_turnamenFK' => $turnamen->id]) }}"
                    class="text-center border border-blue-500 rounded py-1 px-2 bg-blue-500 hover:bg-blue-700 text-white">Buat
                    Jadwal</a>
            </div>
        </div>
    </header>

    <!-- table -->
    <div class="pb-16 pt-16 lg:pb-20 lg:px-24 md:px-16 sm:px-8 px-8  lg:flex-row flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed">
                        @foreach ($schedule as $schedule)
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ $schedule->match_date }}</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <button
                                            class="btn-fill-1-2 items-center border-0 py-1 px-5 focus:outline-none rounded-2xl font-medium text-base mt-6 lg:mt-0"
                                            onclick="location.href='{{ route('schedule.edit', $schedule->id) }}'"
                                            data-toggle="tooltip" data-original-title="Edit Schedule">
                                            Edit
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $schedule->homeTeam->stadion }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center flex-row-reverse">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if ($schedule->homeTeam->gambar)
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="{{ asset('picture/logo/' . $schedule->homeTeam->gambar) }}"
                                                        alt="">
                                                @else
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="{{ asset('picture/logo/bola.jpeg') }}" alt="">
                                                @endif
                                            </div>
                                            <div class="mr-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <b>(H)</b> {{ $schedule->homeTeam->nama_tim }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            {{ $schedule->gol_home ?? '-' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            VS
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            {{ $schedule->gol_away ?? '-' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center ">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if ($schedule->awayTeam->gambar)
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="{{ asset('picture/logo/' . $schedule->awayTeam->gambar) }}"
                                                        alt="">
                                                @else
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="{{ asset('picture/logo/bola.jpeg') }}" alt="">
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $schedule->awayTeam->nama_tim }} <b>(A)</b>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- More items... -->
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-style')
@endpush
