<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <script>
    const role = localStorage.getItem('role');

    if (role) {
        if (role === 'admin') {
            window.location.href = '/admin/dashboard';
        } else if (role === 'lawyer') {
            window.location.href = '/lawyer/home';
        } else if (role === 'secretary') {
            window.location.href = '/secretary/home';
        }
    }
    </script>

    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">

        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Bienvenido</h1>
            <p class="text-sm text-gray-500">Inicia sesión en tu cuenta</p>
        </div>
        

        <!-- Formulario -->
        <form id="loginForm">
            @csrf

            <!-- Email -->
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">Correo electrónico</label>
                <input 
                    type="email" 
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full px-4 py-2.5 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                    placeholder="correo@ejemplo.com"
                >
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Contraseña
                </label>
                <input 
                    type="password" 
                    name="password"
                    required
                    class="w-full px-4 py-2.5 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                    placeholder="••••••••"
                >
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember + Forgot -->
            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center text-sm text-gray-600">
                    <input 
                        type="checkbox" 
                        name="remember"
                        class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                    >
                    Recordarme
                </label>

                <a href="#" class="text-sm text-blue-600 hover:underline">
                    ¿Olvidaste tu contraseña?
                </a>
            </div>

            <div id="errorBox" class="hidden mb-4 text-sm text-red-600 bg-red-100 border border-red-300 rounded-lg p-3"></div>

            <!-- Button -->
            <button 
                type="submit"
                class="w-full bg-blue-600 text-white py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 transition shadow"
            >
                Iniciar sesión
            </button>

        </form>

        <!-- Footer -->
        <p class="text-center text-sm text-gray-500 mt-6">
            © {{ date('Y') }} Tu Sistema Legal
        </p>
    </div>
    <script>
        const form = document.getElementById('loginForm');
        form.addEventListener('submit',async (e) => {
            e.preventDefault();
            document.getElementById('errorBox').classList.add('hidden');
            document.getElementById('errorBox').innerText = '';
            const data = {
                email: form.email.value,
                password: form.password.value
            };
            try{
                const res = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });
                const response = await res.json();
                if (!res.ok) {
                    document.getElementById('errorBox').innerText = response.message;
                    document.getElementById('errorBox').classList.remove('hidden');
                    return;
                }
                localStorage.setItem('token',response.access_token);
                localStorage.setItem('user',JSON.stringify(response.userAuth));
                localStorage.setItem('role',response.role);
                const role = response.role;
                if (role === 'admin') {
                    window.location.href = '/admin';
                } else if (role === 'lawyer') {
                    window.location.href = '/lawyer/home';
                } else if (role === 'secretary') {
                    window.location.href = '/secretary/home';
                }
            } catch(error){
                document.getElementById('errorBox').innerText = 'Error de Conexión';
                document.getElementById('errorBox').classList.remove('hidden');
            };
        });
    </script>
</body>
</html>