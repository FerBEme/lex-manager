<nav class="fixed top-0 z-50 w-full bg-gray-400 border-b border-gray-200">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">

      <div class="flex items-center">
        <a href="/" class="flex ms-2 md:me-24 w-64">
          <img src="{{ asset('storage/images/logo_abogado.jpg') }}" class="h-10 me-3" alt="Logo" />
          <h1 class="font-bold text-sm leading-tight">Estudio Jurídico e Inmobiliario Caritas Ramos E.I.R.L</h1>
        </a>
      </div>

      <div class="relative">
        <button type="button" id="userDropdownButton" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300">
          <span class="sr-only">Open user menu</span>
          <img id="userPhoto" class="w-8 h-8 rounded-full" src="" alt="user photo">
        </button>

        <div id="userDropdown" class="hidden absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-lg shadow-lg z-50">
          <div class="px-4 py-3 border-b border-gray-200">
            <p id="userName" class="text-sm font-medium text-gray-900"></p>
            <p id="userEmail" class="text-sm text-gray-500 truncate"></p>
          </div>

          <ul class="p-2 text-sm text-gray-700 font-medium">
            <li><a href="/" class="block p-2 hover:bg-gray-100 rounded">Dashboard</a></li>
            <li><a href="#" class="block p-2 hover:bg-gray-100 rounded">Configuración</a></li>
            <li><a id="logoutBtn" href="#" class="block p-2 bg-red-600 text-amber-50 hover:bg-gray-300 hover:text-black rounded">Cerrar Sesión</a></li>
          </ul>
        </div>

      </div>

    </div>
  </div>
</nav>
<script>
  const button = document.getElementById('userDropdownButton');
  const menu = document.getElementById('userDropdown');
  button.addEventListener('click', () => {
    menu.classList.toggle('hidden');
  });
  document.addEventListener('click', (e) => {
    if (!button.contains(e.target) && !menu.contains(e.target)) {
      menu.classList.add('hidden');
    }
  });
  document.addEventListener('DOMContentLoaded', async () => {
    const token = localStorage.getItem('token');
    try{
      const res = await fetch('/api/me', {
        method: 'GET',
        headers: {
          'Authorization': 'Bearer ' + token,
          'Accept': 'application/json'
        }
      });
      const response = await res.json();
      const user = response.data;
      document.getElementById('userPhoto').src = user.foto_perfil;
      document.getElementById('userName').innerText = user.nombres.split(' ')[0] + ' ' + user.apellido_paterno;
      document.getElementById('userEmail').innerText = user.correo_electrónico;
    } catch(error){
      console.log('Error cargando usuario',error);      
    }
  });
  document.getElementById('logoutBtn').addEventListener('click', async() => {
    const token = localStorage.getItem('token');
    await fetch('api/logout',{
      method: 'POST',
      headers: {
        'Authorization': 'Bearer ' + token,
        'Accept': 'application/json'
      }
    });
    localStorage.clear();
    window.location.href = '/'
  });
</script>