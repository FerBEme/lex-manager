@php
    $bodies = [
        ['name' => 'Tipo de Documento','id'=>'document_type','options'=> [
                ['name' => 'DNI', 'value' => 'dni'],
                ['name' => 'CE', 'value' => 'ce'],
            ]
        ],
        ['name' => 'Número de Documento','id'=>'nro_document','type'=>'text'],
        ['name' => 'Nombres', 'id' => 'nombres', 'type' => 'text'],
        ['name' => 'Apellido Paterno', 'id' => 'apellido_paterno', 'type' => 'text'],
        ['name' => 'Apellido Materno', 'id' => 'apellido_materno', 'type' => 'text'],
        ['name' => 'Correo Electrónico', 'id' => 'correo', 'type' => 'email'],
        ['name' => 'Registro CAL', 'id' => 'register_cal', 'type' => 'text', 'hidden' => true],
        ['name' => 'Abogado Asignado', 'id' => 'lawyer_id', 'type' => 'select_dynamic', 'hidden' => true],
        ['name' => 'Rol', 'id' => 'role_id', 'type' => 'select_dynamic'],
    ];
@endphp
<x-admin-layout
title="Editar Usuarios | Estudio Jurídico"
:breadcrumbs="[
    ['name' => 'Usuarios','href' => route('admin.users.index'),],
    ['name' => 'Editar Usuario']
]">
<div class="px-6">
    <div class="max-w-2xl bg-white shadow-md rounded-lg p-6 border border-gray-200">
        <form id="editUserForm" class="space-y-4">
            <input type="hidden" id="userId" value="{{ $user }}">
            @foreach ($bodies as $body)                
            <div id="{{ $body['id'] }}Container" @isset($body['hidden']) class="hidden" @endisset>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ $body['name'] }}</label>
                @isset($body['options'])
                <select id="{{ $body['id'] }}" class="w-full border border-gray-300 px-3 py-2 rounded">                    
                    @foreach ($body['options'] as $option)
                    <option value="{{ $option['value'] }}">{{ $option['name'] }}</option>
                    @endforeach
                </select>
                @elseif (isset($body['type']) && $body['type'] === 'select_dynamic')
                <select id="{{$body['id']}}" class="w-full border border-gray-300 px-3 py-2 rounded"></select>
                @else
                <input id="{{ $body['id'] }}" type="{{ $body['type'] }}" class="w-full border border-gray-300 px-3 py-2 rounded focus:ring-blue-200 outline-none">
                @endisset
            </div>
            @endforeach
            <div class="pt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded',async function () {
       const userId = document.getElementById('userId').value; 
       const token = localStorage.getItem('token');
       const res = await fetch('/api/users/' + userId,{
        headers: {
            'Authorization': 'Bearer ' + token,
            'Accept': 'application/json'
        }
       });
       const userData = await res.json();
       const user = userData.data;
       document.getElementById('document_type').value = user.tipo_documento;
       document.getElementById('nro_document').value = user.número_documento;
       document.getElementById('nombres').value = user.nombres;
       document.getElementById('apellido_paterno').value = user.apellido_paterno;
       document.getElementById('apellido_materno').value = user.apellido_materno;
       document.getElementById('correo').value = user.correo_electrónico;
       document.getElementById('register_cal').value = user.registro_CAL ?? '';
       const rolesRes = await fetch('/api/roles',{
        headers: {
            'Authorization': 'Bearer ' + token,
            'Accept': 'application/json'
        }
       });
       const rolesData = await rolesRes.json();
       const roleSelect = document.getElementById('role_id');
        rolesData.data.forEach(role => {
            const option = document.createElement('option');
            option.value = role.id;
            option.textContent = role.name;
            roleSelect.appendChild(option);
        });
        roleSelect.value = user.rol_asignado?.id;
        const lawyersRes = await fetch('/api/users?filters[role_id][=]=2', {
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json'
            }
        });

        const lawyersData = await lawyersRes.json();
        const lawyerSelect = document.getElementById('lawyer_id');

        lawyersData.data.forEach(lawyer => {
            const option = document.createElement('option');
            option.value = lawyer.id;
            option.textContent = lawyer.nombres + ' ' + lawyer.apellido_paterno + ' ' + lawyer.apellido_materno;

            if(user.abogado_asignado?.id === lawyer.id) option.selected = true;

            lawyerSelect.appendChild(option);
        });
       alternarCampos(roleSelect.value);
        roleSelect.addEventListener('change', function(){
            alternarCampos(this.value);
        });
    });
    function alternarCampos(roleId) {
        const lawyerContainer = document.getElementById('lawyer_idContainer');
        const calContainer = document.getElementById('register_calContainer');
        if (roleId == 2) {
            calContainer.classList.remove('hidden');
            lawyerContainer.classList.add('hidden');
        } 
        else if (roleId == 3) {
            lawyerContainer.classList.remove('hidden');
            calContainer.classList.add('hidden');
        } 
        else {
            lawyerContainer.classList.add('hidden');
            calContainer.classList.add('hidden');
        }
    }
        document.getElementById('editUserForm').addEventListener('submit', async function (e) {
            e.preventDefault();
            const userId = document.getElementById('userId').value;
            const token = localStorage.getItem('token');
            const body = {
                document_type: document.getElementById('document_type').value,
                nro_document: document.getElementById('nro_document').value,
                first_name: document.getElementById('nombres').value,
                paternal_name: document.getElementById('apellido_paterno').value,
                maternal_name: document.getElementById('apellido_materno').value,
                email: document.getElementById('correo').value,
                password: '123456',
                role_id: document.getElementById('role_id').value,
                lawyer_id: document.getElementById('lawyer_id').value || null,
                register_cal: document.getElementById('register_cal').value || null,
                is_active: 1
            };
            const res = await fetch('/api/users/' + userId, {
                method: 'PUT',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(body)
            });
            if(res.ok){
                alert('Actualizado correctamente');
                window.location.href = '/admin/users';
            } else {
                const error = await res.json();
                console.log(error);
                alert('Error al actualizar');
            }
        });
</script>
</x-admin-layout>