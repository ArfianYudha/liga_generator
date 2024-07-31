@extends('layout.app')

{{-- Set Title --}}
@section('title', 'Home')

@section('content')
    <!-- breadcumbs -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">
                Profil
            </h1>
        </div>
    </header>
    <div class="mb-20">
        <!-- table -->
        <div class="pb-4 pt-4 lg:pb-6 lg:px-24 md:px-16 sm:px-8 px-8  lg:flex-row flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                        <div class="flex flex-col pb-3">
                            <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nama</dt>
                            <dd class="text-lg font-semibold">{{ $user->fullname }}</dd>
                        </div>
                        <div class="flex flex-col pb-3">
                            <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Email address</dt>
                            <dd class="text-lg font-semibold">{{ $user->email }}</dd>
                        </div>
                        <div class="flex flex-col py-3">
                            <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Password</dt>
                            <dd class="text-lg font-semibold">* * * * * *</dd>
                        </div>
                        <div class="flex flex-col pt-3">
                            <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Foto Profil</dt>
                            <dd class="text-lg font-semibold">
                                @if ($user->gambar)
                                    <img src="{{ asset('picture/akun/' . $user->gambar) }}" alt="Profil Gambar"
                                        class="h-auto max-w-xs">
                                @endif
                            </dd>
                        </div>
                        <div class="flex flex-col pt-3">
                            <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400"></dt>
                            <dd class="text-lg ">
                                <a href="{{ route('profil.edit') }}"
                                    class="mt-10 text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Edit
                                    Profil</a>
                            </dd>
                        </div>
                    </dl>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-style')
@endpush
