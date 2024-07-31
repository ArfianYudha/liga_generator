<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.meta')

    <title>@yield('title') | Landing Page</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" href="">
    <link rel="shortcut icon" type="image/x-icon" href="">

    @stack('before-style')
    <!-- style -->
    @include('includes.styleAdmin')
    @stack('after-style')

</head>

<body>
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3" style="background-color: #141432">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <a href="#" class="flex ms-2 md:me-24">
                        <img src="{{ asset('picture/logo/bolalogin.jpeg') }}" class="h-8 me-3 mx-3 w-auto rounded-full"
                            alt="Liga Generator" />
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-white">Liga
                            Generator Admin Page</span>
                    </a>
                </div>
                <!-- Bagian yang ingin diletakkan di sebelah kanan -->
                <div class="flex items-center justify-end">
                    <div class="relative ml-3" x-data="{ open: false }">
                        <div>
                            <button @click="open = !open" type="button"
                                class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                id="user-menu-button" aria-expanded="false" :aria-expanded="open ? 'true' : 'false'"
                                aria-haspopup="true">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full"
                                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt="">
                            </button>
                        </div>

                        <!-- Dropdown menu -->
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                                    id="user-menu-item-2" type="submit">Sign out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen  transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white" style="background-color: #141432">
            <ul class="space-y-2 font-medium pt-20">
                <li>
                    <a href="{{ route('admin') }}"
                        class="flex items-center p-2 text-gray-100 rounded-lg dark:text-gray-700 hover:text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 group">

                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.index') }}"
                        class="flex items-center p-2 text-gray-100 rounded-lg dark:text-gray-700 hover:text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 group">

                        <span class="ms-3">User</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('turnamen.view') }}"
                        class="flex items-center p-2 text-gray-100 rounded-lg dark:text-gray-700 hover:text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 group">

                        <span class="ms-3">Turnamen</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        @yield('content')
    </div>
    </div>
    @stack('before-script')
    <!-- script -->
    @include('includes.scriptAdmin')

    @stack('after-script')
</body>

</html>
