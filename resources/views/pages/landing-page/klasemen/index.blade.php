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
                        class="px-20 inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Jadwal</a>
                </li>
                <li class="me-2">
                    <a href="{{ route('klasemen.index', ['id_turnamenFK' => $turnamen->id]) }}"
                        class="px-20 inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500"
                        aria-current="page">Klasemen</a>
                </li>
            </ul>
        </div>
    </header>

    <div class="mb-24">
        <!-- table -->
        <div class="pb-16 pt-16 lg:pb-20 lg:px-24 md:px-16 sm:px-8 px-8  lg:flex-row flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Club</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Main</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Menang</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Imbang</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kalah</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        GM</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        GK</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        SG</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Poin</th>
                                </tr>
                            </thead>
                            @php
                                $no = 0;
                            @endphp

                            @foreach ($klasemen as $klasemen)
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ ++$no }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    @if ($klasemen->tim->gambar)
                                                        <img class="h-10 w-10 rounded-full"
                                                            src="{{ asset('picture/logo/' . $klasemen->tim->gambar) }}"
                                                            alt="">
                                                    @else
                                                        <img class="h-10 w-10 rounded-full"
                                                            src="{{ asset('picture/logo/bola.jpeg') }}" alt="">
                                                    @endif
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $klasemen->tim->nama_tim }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $klasemen->main }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $klasemen->menang }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $klasemen->imbang }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $klasemen->kalah }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $klasemen->gol }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $klasemen->kebobolan }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $klasemen->selisih_gol }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $klasemen->point }}
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
    </div>
@endsection

@push('after-style')
@endpush
