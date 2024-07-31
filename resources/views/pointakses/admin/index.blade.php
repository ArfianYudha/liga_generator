@extends('layout.admin')

{{-- Set Title --}}
@section('title', 'Home')

@section('content')
    <header class="bg-white shadow sm:mt-11">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">
                Dashboard
            </h1>
        </div>
    </header>
    <div class="mx-auto flex pt-12 pb-16 lg:pb-20 lg:px-24 md:px-16 sm:px-8 px-8 lg:flex-row flex-col">
        <div
            class="lg:flex-grow lg:w-1/2 flex flex-col lg:items-start lg:text-left mb-3 md:mb-12 lg:mb-0 items-center text-center">

            <div class="pr-2">
                <a href="{{ route('user.index') }}"
                    class="flex flex-col items-center bg-green-500 hover:bg-green-400 border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">User</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Disini tersimpan data-data dari
                            database Users.</p>
                    </div>
                </a>
            </div>
        </div>
        <div
            class="lg:flex-grow lg:w-1/2 flex flex-col lg:items-start lg:text-left mb-3 md:mb-12 lg:mb-0 items-center text-center">

            <div class="pl-2">
                <a href="{{ route('turnamen.view') }}"
                    class="flex flex-col items-center bg-blue-500 hover:bg-blue-400 border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Turnamen</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Disini tersimpan data-data dari
                            database Turnamen.</p>
                    </div>
                </a>
            </div>
        </div>
    @endsection

    @push('after-style')
        {{-- <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

        .btn-outline-header-2-3 {
            border: 1px solid #707092;
            color: #707092;
        }

        .btn-outline-header-2-3:hover {
            border: 1px solid #ffffff;
            color: #ffffff;
        }

        .btn-outline-header-2-3:hover div path {
            fill: #ffffff;
        }

        .box-shadow-header-2-3:hover {
            --tw-shadow: inset 0 0px 25px 0 rgba(20, 20, 50, 0.7);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),
                var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
        }

        .navigation-header-2-3 a:hover,

        .active::after {
            font-weight: 600;
        }

        .navigation-header-2-3 a:hover {
            color: #e7e7e8;
        }

        .navigation-header-2-3 {
            color: #707092;
        }

        .bg-screen-header-2-3 {
            background-color: #707092;
        }

        .bg-popup-header-2-3 {
            background-color: #141432;
        }
    </style> --}}
    @endpush
