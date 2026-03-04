<nav x-data="{ open: false }"
     class="bg-red-600 border-b border-red-700 shadow-md">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Left Side -->
            <div class="flex items-center">
                <div class="text-white font-bold text-lg tracking-wide">
                    <img src="/images/BSIT.png"
                         alt="BSIT Logo"
                         class="w-10 inline-block logo-glow">
                    Mr. & Ms. IT 2026
                </div>
            </div>

            <!-- Right Side -->
            <div class="hidden sm:flex sm:items-center">

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2
                                       text-sm font-medium rounded-md
                                       text-white
                                       hover:bg-red-700
                                       focus:outline-none
                                       transition duration-150">

                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-white rounded-md shadow-lg border border-gray-200">

                            <x-dropdown-link :href="route('profile.edit')"
                                             class="hover:bg-red-50">
                                Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                             this.closest('form').submit();"
                                    class="hover:bg-red-50">
                                    Log Out
                                </x-dropdown-link>
                            </form>

                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Hamburger -->
            <div class="sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md
                               text-white hover:bg-red-700
                               focus:outline-none transition">

                    <svg class="h-6 w-6"
                         stroke="currentColor"
                         fill="none"
                         viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    <!-- Mobile Dropdown -->
    <div :class="{'block': open, 'hidden': ! open}"
         class="hidden sm:hidden bg-white border-t border-gray-200">

        <div class="px-4 py-3 border-b border-gray-200">
            <div class="font-medium text-gray-800">
                {{ Auth::user()->name }}
            </div>
            <div class="text-sm text-gray-500">
                {{ Auth::user()->email }}
            </div>
        </div>

        <div class="py-2">
            <x-responsive-nav-link :href="route('profile.edit')"
                                   class="hover:bg-red-50">
                Profile
            </x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault();
                             this.closest('form').submit();"
                    class="hover:bg-red-50">
                    Log Out
                </x-responsive-nav-link>
            </form>
        </div>
    </div>

</nav>