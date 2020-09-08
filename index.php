<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APIRESTFUL</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<div id="app">
    <form @submit="newUsuario">
    <h1>Criar um novo usuário</h1>
    <input v-model="newUser.nome" placeholder="Nome"/>
    <input v-model="newUser.email" placeholder="E-mail"/>
    <input v-model="newUser.login" placeholder="Usuário"/>
    <input type="password" v-model="newUser.senha" placeholder="Senha"/>
    <br>
    <button style="position: relative; margin: 20px; background: #000; color: #fff;">Criar</button>
    <button @click="clear" style="position: relative; margin: 20px; background: #000; color: #fff;">Apagar tudo</button>
    </form>
    <br>
    <div class="table-responsive-vertical shadow-z-1">
    <h2 style="padding: 10px;" v-if="users.length == 0 && load == true">Nenhum usuário encontrado!!</h2>
        <table v-if="users !== null" id="table" class="table table-hover table-mc-light-blue">
            <thead>
                <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Login</th>
                <th>Opções</th>
                </tr>
            </thead>
            <tbody v-for="user in users">
                <tr>
                <td>{{ user.codigo }}</td>
                <td v-if="editUser == null || editUser !== user">{{ user.nome }}</td>
                <td v-if="editUser == user"><input placeholder="Nome" v-model="editUser.nome" :value="editUser.nome"/></td>
                <td v-if="editUser == null || editUser !== user">
                    {{ user.email }}
                </td>
                <td v-else="editUser == user"><input v-model="editUser.email" placeholder="E-mail" :value="editUser.email"/></td>
                <td v-if="editUser == null || editUser !== user">{{ user.login }}</td>
                <td v-if="editUser == user"><input v-model="editUser.login" placeholder="Login" :value="editUser.login"/></td>
                <td>
                    <button 
                    :data-id="user.codigo"
                    @click="object.delete(user.codigo)"><i class="fas fa-user-minus"></i></button>
                    <button v-if="editUser !== user" @click="editarUsuario(user)"><i class="fas fa-user-edit"></i></button>
                    <button v-if="editUser == user"
                    @click="save"><i class="fas fa-save"></i></button>
                    <button v-if="editUser == user"
                    @click="cancel"><i class="fas fa-power-off"></i></button>
                </td>
                </tr>
                <tr>
            </tbody>
        </table>
    </div>

    <div class="wait" v-if="!load">
        <h1>Aguarde estamos carregando a lista de usuários!</h1>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <script src="./index.js"></script>
</body>
</html>