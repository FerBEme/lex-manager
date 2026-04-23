@php
   $listas = [
      [
         'name' => 'Dashboard',
         'href' => route('admin.dashboard'),
         'icon' => 'fa-solid fa-gauge',
         'active' => request()->routeIs('admin.dashboard')
      ],
      [
         'name' => 'Usuarios',
         'href' => route('admin.users.index'),
         'icon' => 'fa-solid fa-user',
         'active' => request()->routeIs('admin.users.*')
      ],
      [
         'name' => 'Calendario',
         'href' => '#',
         'icon' => 'fa-solid fa-calendar',
         'active' => request()->routeIs('admin.calendar.*')
      ]
   ]
@endphp
<aside class=" fixed top-0 left-0 z-40 w-64 h-full transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-gray-300 border-r border-gray-200">
      <ul class="space-y-2 font-medium mt-16">
         @foreach ($listas as $lista)        
         <li>
            <a href="{{ $lista['href'] }}" class="flex items-center px-4 py-3 mb-3 text-black rounded-lg  {{ $lista['active'] ? 'bg-gray-100 text-gray-900' : 'hover:bg-gray-100 hover:text-gray-900 group' }}">
               <i class="{{ $lista['icon'] }}"></i>
               <h1 class="ms-3">{{ $lista['name'] }}</h1>
            </a>
         </li>            
         @endforeach 
      </ul>
   </div>
</aside>