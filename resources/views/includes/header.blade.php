        <!-- navbar -->
        <section class="h-full w-full border-box transition-all duration-500 linear lg:px-24 md:px-20 px-8 py-8 border-b"
            style="background-color: #141432">
            <div style="font-family: 'Poppins', sans-serif">
                <div class="mx-auto flex flex-wrap flex-row items-center justify-between">
                    <a class="flex font-medium items-center" href="{{ route('index') }}">
                        <svg width="42" height="42" viewBox="0 0 42 42" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M3.5 15.75C3.5 8.98451 8.98451 3.5 15.75 3.5H29.75C30.7165 3.5 31.5 4.2835 31.5 5.25C31.5 6.21649 30.7165 7 29.75 7H15.75C10.9175 7 7 10.9175 7 15.75V29.75C7 30.7165 6.2165 31.5 5.25 31.5C4.2835 31.5 3.5 30.7165 3.5 29.75V15.75Z"
                                fill="white" />
                            <path
                                d="M10.5 17.5C10.5 13.634 13.634 10.5 17.5 10.5H31.5C35.366 10.5 38.5 13.634 38.5 17.5V31.5C38.5 35.366 35.366 38.5 31.5 38.5H17.5C13.634 38.5 10.5 35.366 10.5 31.5V17.5Z"
                                fill="white" />
                        </svg>
                    </a>

                    <label for="menu-toggle-1-2" class="cursor-pointer lg:hidden block">
                        <svg class="w-6 h-6" fill="none" stroke="#FFFFFF" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>

                    <input class="hidden" type="checkbox" id="menu-toggle-1-2" />

                    <div class="hidden lg:flex lg:items-center lg:w-auto w-full lg:ml-auto lg:mr-auto flex-wrap items-center text-base justify-center"
                        id="menu-1-2">
                        <nav
                            class="lg:space-x-12 space-x-0 lg:flex items-center justify-between text-base pt-8 lg:pt-0 lg:space-y-0 space-y-6">
                            <a class="block cursor-pointer nav-1-2" href="{{ route('index') }}">Home</a>
                            <a class="block cursor-pointer nav-1-2" href="{{ route('turnamen.index') }}">Turnamen</a>
                            @if (Auth::check())
                                <a class="block cursor-pointer nav-1-2" href="{{ route('myturnamen.index') }}">My
                                    Turnamen</a>
                            @else
                                <a class="block cursor-pointer nav-1-2" href="{{ route('auth') }}">My Turnamen</a>
                            @endif
                            <a class="block cursor-pointer nav-1-2" href="{{ route('guide.index') }}">Panduan</a>
                        </nav>
                    </div>

                    <!-- Tampilkan jika user sudah login -->
                    @if (Auth::check())
                        <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu-1-2">
                            <div class="text-white">
                                {{ Auth::user()->fullname }}
                            </div>

                            <!-- Profile dropdown -->
                            <div class="relative ml-3" x-data="{ open: false }">
                                <div>
                                    <button @click="open = !open" type="button"
                                        class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                        id="user-menu-button" aria-expanded="false"
                                        :aria-expanded="open ? 'true' : 'false'" aria-haspopup="true">
                                        <span class="absolute -inset-1.5"></span>
                                        <span class="sr-only">Open user menu</span>
                                        <img class="h-8 w-8 rounded-full"
                                            src="{{ asset('picture/akun/' . Auth::user()->gambar) }}" alt="">
                                    </button>
                                </div>

                                <!-- Dropdown menu -->
                                <div x-show="open" @click.away="open = false"
                                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                    tabindex="-1">
                                    <a href="{{ route('profil.index') }}"
                                        class="text-center block px-4 py-2 w-full text-sm text-gray-700 hover:bg-gray-300"
                                        role="menuitem" tabindex="-1" id="user-menu-item-0">Profil</a>
                                    <hr>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button class="block px-4 py-2 w-full text-sm text-gray-700 hover:bg-gray-300"
                                            role="menuitem" tabindex="-1" id="user-menu-item-2" type="submit">Sign
                                            out</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Tampilkan jika user belum login -->
                    @else
                    @endif
                </div>
            </div>
        </section>
