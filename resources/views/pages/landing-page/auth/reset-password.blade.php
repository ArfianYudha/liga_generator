@extends('layout.app')

{{-- Set Title --}}
@section('title', 'Home')

@section('content')
    <section class="h-full w-full border-box transition-all duration-500 linear"
        style="background: linear-gradient(to right, #141432 50%, #ffffff 50%)">
        <div style="font-family: 'Poppins', sans-serif">
            <!-- Hero-header-2-3 -->
            <div>
                <div class="mx-auto flex pt-12 pb-16 lg:pb-20 lg:px-24 md:px-16 sm:px-8 px-8 lg:flex-row flex-col">
                    <!-- Left Column -->
                    <div
                        class="lg:flex-grow lg:w-1/2 flex flex-col lg:items-start lg:text-left mb-3 md:mb-12 lg:mb-0 items-center text-center">

                        <p class="mb-8 leading-relaxed font-semibold text-sm" style="color: #fb6262">
                            Liga Generator untuk membuat turnamen otomatis.
                        </p>

                        <h1 class="lg:block hidden title-font sm:text-5xl lg:text-6xl text-4xl mb-8 font-semibold sm:leading-tight"
                            style="color: #cbcbd2; line-height: 1.2">
                            Buat turnamenmu sendiri <br />
                            dengan mudah
                        </h1>

                        <h1 class="lg:hidden block title-font sm:text-5xl lg:text-6xl text-4xl mb-8 lg::px-10 md:px-10 sm:px-6 px-0 font-semibold sm:leading-tight"
                            style="color: #cbcbd2; line-height: 1.2">
                            Buat turnamenmu sendiri <br />
                            dengan mudah
                        </h1>
                    </div>

                    <!-- Right Column -->
                    <div class="w-full lg:w-1/2 text-center justify-center flex pr-0 pl-40">
                        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                                <img class="mx-auto h-20 w-auto rounded-full"
                                    src="{{ asset('picture/logo/bolalogin.jpeg') }}" alt="Liga Generator">
                                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                                    Reset Password</h2>
                            </div>

                            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                                <form class="space-y-6 validate-form" action="{{ route('password.update') }}"
                                    method="POST">
                                    @csrf
                                    @if (Session::get('success'))
                                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                                            role="alert">
                                            <span class="block sm:inline">{{ Session::get('success') }}</span>
                                            <span
                                                class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer close-alert">
                                                <svg class="fill-current h-6 w-6 text-green-500" role="button"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <title>Close</title>
                                                    <path
                                                        d="M14.348 5.652a1 1 0 10-1.414-1.414L10 7.586 7.066 4.652a1 1 0 00-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 001.414 1.414L10 12.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934z" />
                                                </svg>
                                            </span>
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                                            role="alert">
                                            <strong class="font-bold">Error!</strong>
                                            <ul class="list-none mt-2">
                                                @foreach ($errors->all() as $item)
                                                    <li>{{ $item }}</li>
                                                @endforeach
                                            </ul>
                                            <span
                                                class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer close-alert">
                                                <svg class="fill-current h-6 w-6 text-red-500" role="button"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <title>Close</title>
                                                    <path
                                                        d="M14.348 5.652a1 1 0 10-1.414-1.414L10 7.586 7.066 4.652a1 1 0 00-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 001.414 1.414L10 12.414l2.934 2.934a1 1 0 001.414-1.414L11.414 10l2.934-2.934z" />
                                                </svg>
                                            </span>
                                        </div>
                                    @endif

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            const closeButtons = document.querySelectorAll('.close-alert');

                                            closeButtons.forEach(button => {
                                                button.addEventListener('click', function() {
                                                    this.parentElement.classList.add('hidden');
                                                });
                                            });
                                        });
                                    </script>

                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div data-validate="Valid email is required: ex@abc.xyz">
                                        <label for="email"
                                            class="text-left block text-sm font-medium leading-6 text-gray-900">Email
                                            address</label>
                                        <div class="mt-2">
                                            <input id="email" name="email" type="email" autocomplete="email"
                                                required
                                                class="pl-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>

                                    <div data-validate="Password is required">
                                        <div class="flex items-center justify-between">
                                            <label for="password"
                                                class="block text-sm font-medium leading-6 text-gray-900">New
                                                Password</label>
                                        </div>
                                        <div class="mt-2">
                                            <input id="password" name="password" type="password"
                                                autocomplete="current-password" required
                                                class="pl-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>

                                    <div data-validate="Password is required">
                                        <div class="flex items-center justify-between">
                                            <label for="password_confirmation"
                                                class="block text-sm font-medium leading-6 text-gray-900">Confirm
                                                Password</label>
                                        </div>
                                        <div class="mt-2">
                                            <input id="password" name="password_confirmation" type="password"
                                                autocomplete="current-password" required
                                                class="pl-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit"
                                            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
                                            in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('after-style')
    <style>
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
    </style>
@endpush
@push('after-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const closeButtons = document.querySelectorAll('.close-alert');

            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    this.parentElement.classList.add('hidden');
                });
            });
        });
    </script>
@endpush
