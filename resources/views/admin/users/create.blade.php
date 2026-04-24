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
title="Crear Usuarios|Estudio Jurídico"
:breadcrumbs="[
    [
        'name' => 'Usuarios',
        'href' => route('admin.users.index'),
    ],
    [
        'name' => 'Crear Usuario',
        'href' => route('admin.users.create'),
    ]
]">
<div class="px-6 flex justify-center">
    <div class="w-full max-w-5xl bg-white shadow-md rounded-lg p-6 border border-gray-200">
        <form id="editUserForm" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($bodies as $body)                
            <div id="{{ $body['id'] }}Container" @isset($body['hidden']) class="hidden" @endisset>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    {{ $body['name'] }}
                </label>

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

            <div class="md:col-span-2 pt-4 flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    
</script>
</x-admin-layout>