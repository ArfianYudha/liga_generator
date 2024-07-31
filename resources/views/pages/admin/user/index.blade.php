@extends('layout.admin')

{{-- Set Title --}}
@section('title', 'Home')

@section('content')
    <header class="bg-white shadow sm:mt-11">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">
                Halaman User
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
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Gambar
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
                @foreach ($user as $user)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ ++$no }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->fullname }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->role }}
                        </td>
                        <td class="px-6 py-4">
                            <img src="{{ asset('picture/akun/' . $user->gambar) }}" width="30px" height="40px"
                                class="">
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('user.edit', $user->id) }}"
                                class="mx-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit</a>

                        </td>
                        <td>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
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
