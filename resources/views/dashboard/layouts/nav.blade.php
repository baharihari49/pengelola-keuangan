<nav
    class="bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-50">
    <div class="flex flex-wrap justify-between items-center">
        <div class="flex justify-start items-center">

            <button id="btn-toggle-sidebar" class="p-2 rounded-lg hover:border hidden md:block">
                <svg class="w-5 h-5 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="16" height="12" fill="none" viewBox="0 0 16 12">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h14M1 6h14M1 11h7" />
                </svg>
            </button>

            <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-expanded="true"
                aria-controls="sidebar"
                class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer md:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <svg class="w-[18px] h-[18px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
                <span class="sr-only">Toggle sidebar</span>
            </button>

            <div class="flex ms-1 lg:ms-8">
                <figure class="flex items-end gap-2">
                    @if (file_exists(public_path('./image/logo/octans_logo.png')))
                        <img class="h-10 md:h-12" src="{{ asset('./image/logo/octans_logo.png') }}" alt="">
                    @else
                        <img class="h-10 md:h-12" src="{{ asset('./image/logo/octans_logo.png') }}" alt="">
                    @endif
                    <p class="font-bold text-2xl">octans</p>
                </figure>
            </div>

        </div>
        <div class="flex items-center lg:order-2">
            <button type="button"
                class="flex mx-3 text-sm rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                <span class="sr-only">Open user menu</span>
                <img id="avatarButton" type="button" style="object-fit: cover;" data-dropdown-toggle="userDropdown"
                    data-dropdown-placement="bottom-start" class="w-10 h-10 rounded-full cursor-pointer"
                    src="{{ $user->foto ?? 'https://res.cloudinary.com/du0tz73ma/image/upload/v1700278579/default-profile_y2huqf.jpg' }}"
                    alt="User dropdown">

            </button>
            <!-- Dropdown menu -->
            <div class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
                id="dropdown">
                <div class="py-3 px-4">
                    <span
                        class="block text-sm font-semibold text-gray-900 dark:text-white">{{ auth()->user()->nama }}</span>
                    <span
                        class="block text-sm text-gray-900 truncate dark:text-white">{{ auth()->user()->email }}</span>
                </div>

                <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
                    <li class="w-full flex">
                        <a class="py-2 px-4 text-base w-full hover:bg-gray-200" href="/profile">Profile</a>
                    </li>
                    <li>
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit"
                                class="block py-2 px-4 w-full text-start text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Log
                                Out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
