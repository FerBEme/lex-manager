<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form id="loginForm">
        <input type="email" id="email" placeholder="Correo electrónico"><br><br>
        <input type="password" id="password" placeholder="Contraseña"><br><br>
        <label><input type="checkbox" id="remember">Recordar</label><br><br>
        <button type="submit">Iniciar Sesión</button>
    </form>
    <script>
        document.getElementById('loginForm').addEventListener('submit',async function (e) {
            e.preventDefault();
            let response = await fetch('/api/login',{
                method:'POST',
                headers:{
                    'Content-Type':'application/json'
                },
                body:JSON.stringify({
                    email:document.getElementById('email').value,
                    password:document.getElementById('password').value,
                })
            });

            let data = await response.json();

            if (data.access_token) {
                localStorage.setItem('token',data.access_token);
                localStorage.setItem('role',data.role);
                if(data.role === 'admin') window.location.href = '/admin/dashboard';
            } else {
                alert(data.message);
            }
        });
    </script>
</body>
</html>