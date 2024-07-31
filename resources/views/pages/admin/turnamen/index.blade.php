@extends('layout.admin')

{{-- Set Title --}}
@section('title', 'Home')

@section('content')
    <header class="bg-white shadow sm:mt-11">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">
                Halaman Turnamen
            </h1>
        </div>
    </header>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Turnamen
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 0;
                @endphp
                @foreach ($turnamen as $turnamen)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ ++$no }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $turnamen->nama_turnamen }}
                        </td>
                        <td class="text-center">
                            <form action="{{ route('turnamen.destroy', $turnamen->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="submit" value="Hapus"
                                    class=" focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" />
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('after-style')
@endpush
