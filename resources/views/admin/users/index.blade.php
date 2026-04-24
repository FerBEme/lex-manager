<x-admin-layout
title="Usuarios|Estudio Jurídico"
:breadcrumbs="[
    [
        'name' => 'Usuarios',
        'href' => route('admin.users.index'),
    ]
]">
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Usuarios</h1>
        <div class="flex gap-2 mb-4 justify-between">
            <div>
                <input id="search" type="text" placeholder="Buscar nombre..." class="border px-3 py-2 rounded">
                <button onclick="loadUsers()" class="bg-blue-500 text-white px-4 py-2 rounded"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div class="flex items-center">
                <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 bg-blue-900 text-white px-4 py-2 rounded-lg shadow-sm hover:bg-green-600 transition">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Nuevo Usuario</span>
                </a>
            </div>
        </div>
        <table class="w-full border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2">Id</th>
                    <th class="p-2">Tipo</th>
                    <th class="p-2">Nro. Documento</th>
                    <th class="p-2">Nombres</th>
                    <th class="p-2">Apellido Paterno</th>
                    <th class="p-2">Apellido Materno</th>
                    <th class="p-2">Correo Electrónico</th>
                    <th class="p-2">Nro. Celular</th>
                    <th class="p-2">Foto</th>
                    <th class="p-2">Estado</th>
                    <th class="p-2">Rol</th>
                    <th class="p-2">Acciones</th>
                </tr>
            </thead>
            <tbody id="usersTable"></tbody>
        </table>
    </div>
    <script>
        async function loadUsers(){
            const search = document.getElementById('search').value;
            let url = '/api/users?include=role&sort=-id&perPage=10';
            if(search) url += '&filters[first_name][like]=' + encodeURIComponent(search);
            const token = localStorage.getItem('token');
            const response = await fetch(url,{
                headers:{
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();
            const table = document.getElementById('usersTable');
            table.innerHTML = '';
            data.data.forEach(function (user) {
                table.innerHTML +=
                '<tr class="border-b border-gray-300 hover:bg-gray-50 transition-colors duration-150">' +
                    '<td class="px-4 py-3 text-center text-sm text-gray-500 font-medium">' + user.id + '</td>' +
                    '<td class="px-4 py-3 text-center text-gray-800 font-semibold">' + user.tipo_documento + '</td>' +
                    '<td class="px-4 py-3 text-center text-gray-800 font-semibold">' + user.número_documento + '</td>' +
                    '<td class="px-4 py-3 text-sm text-gray-800 font-semibold">' + user.nombres + '</td>' +
                    '<td class="px-4 py-3 text-sm text-gray-800 font-semibold">' + user.apellido_paterno + '</td>' +
                    '<td class="px-4 py-3 text-sm text-gray-800 font-semibold">' + user.apellido_materno + '</td>' +
                    '<td class="px-4 py-3 text-sm text-gray-600">' + user.correo_electrónico + '</td>' +
                    '<td class="px-4 py-3 text-sm text-center text-gray-600">' + (user.celular ?? '-') + '</td>' +
                    '<td class="px-4 py-3 text-sm text-center text-gray-600">' + 
                        '<img class="w-8 h-8 rounded-full" src="' + user.foto_perfil + '" alt="user photo">' +
                    '</td>' +
                    '<td class="px-4 py-3 text-sm text-center">' +
                        '<span class="inline-block px-3 py-1 text-xs font-medium rounded-full ' +
                        (user.estado === 1 
                            ? 'bg-green-100 text-green-700' 
                            : 'bg-red-100 text-red-700') +
                        '">' +
                        (user.estado === 1 ? 'Activo' : 'Inactivo') +
                        '</span>' +
                    '</td>' +
                    '<td class="px-4 py-3 text-sm text-center">' + 
                        '<span class="inline-block px-3 py-1 text-xs font-medium rounded-full ' +
                        (
                            user.rol_asignado?.nombre === 'admin'
                                ? 'bg-red-100 text-red-700'
                                : user.rol_asignado?.nombre === 'lawyer'
                                    ? 'bg-blue-100 text-blue-700'
                                    : 'bg-green-100 text-green-700'
                        ) +
                        '">' +
                        (
                            user.rol_asignado?.nombre === 'admin'
                                ? 'Administrador'
                                : user.rol_asignado?.nombre === 'lawyer'
                                    ? 'Abogado'
                                    : 'Secretario (a)'
                        ) +
                        '</span>' +
                    '</td>' +
                    '<td class="px-4 py-3 text-sm text-center">' +
                        '<a href="/admin/users/' + user.id + '/edit" ' +
                            'class="inline-flex items-center gap-1 px-2 py-2 mr-2 text-xs font-medium text-blue-700 bg-blue-100 rounded-full hover:bg-blue-200">' +
                            '<i class="fa-solid fa-pen-to-square"></i>' +
                        '</a>' +
                        '<button onclick="deleteUser(' + user.id + ')" ' +
                            'class="inline-flex items-center gap-1 px-2 py-2 text-xs font-medium text-red-700 bg-red-100 rounded-full hover:bg-red-200">' +
                            '<i class="fa-solid fa-trash"></i>' +
                        '</button>' +
                    '</td>' +
                '</tr>';
            });
        }
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('search').addEventListener('keyup', function(e){
                if(e.key === 'Enter'){
                    loadUsers();
                }
            });
            loadUsers();
        });
        async function deleteUser(id){
            if(!confirm('¿Eliminar este usuario?')) return;
            const token = localStorage.getItem('token');
            const res = await fetch('/api/users/' + id, {
                method: 'DELETE',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json'
                }
            });
            if(res.ok) loadUsers();
            else alert('No se pudo eliminar');
        }
    </script>
</x-admin-layout>