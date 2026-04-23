<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="top-bar-sidebar" data-drawer-toggle="top-bar-sidebar" aria-controls="top-bar-sidebar" type="button" class="sm:hidden text-gray-600 bg-transparent border border-transparent hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm p-2 focus:outline-none">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10"/>
            </svg>
         </button>
        <a href="#" class="flex ms-2 md:me-24">
          <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 me-3" alt="Logo" />
          <span class="self-center text-lg font-semibold whitespace-nowrap text-gray-800">Panel</span>
        </a>
      </div>

      <div class="flex items-center">
          <div class="flex items-center ms-3">
            <div>
              <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300" aria-expanded="false">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
              </button>
            </div>

            <div class="z-50 hidden bg-white border border-gray-200 rounded-lg shadow-lg w-44" id="dropdown-user">
              <div class="px-4 py-3 border-b border-gray-200" role="none">
                <p class="text-sm font-medium text-gray-900" role="none">
                  Neil Sims
                </p>
                <p class="text-sm text-gray-500 truncate" role="none">
                  neil.sims@flowbite.com
                </p>
              </div>

              <ul class="p-2 text-sm text-gray-700 font-medium" role="none">
                <li>
                  <a href="#" class="inline-flex items-center w-full p-2 hover:bg-gray-100 hover:text-gray-900 rounded" role="menuitem">Dashboard</a>
                </li>
                <li>
                  <a href="#" class="inline-flex items-center w-full p-2 hover:bg-gray-100 hover:text-gray-900 rounded" role="menuitem">Settings</a>
                </li>
                <li>
                  <a href="#" class="inline-flex items-center w-full p-2 hover:bg-gray-100 hover:text-gray-900 rounded" role="menuitem">Earnings</a>
                </li>
                <li>
                  <a href="#" class="inline-flex items-center w-full p-2 hover:bg-gray-100 hover:text-gray-900 rounded" role="menuitem">Sign out</a>
                </li>
              </ul>
            </div>

          </div>
      </div>
    </div>
  </div>
</nav>