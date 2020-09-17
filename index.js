const object = {
    "urlApi": "./api.php",
    "listar": function(){
        fetch(object.urlApi, {
            method: 'GET'
        }).then(function (response) {
            if (response.ok) {
                return response.json();
            }
            return Promise.reject(response);
        }).then(function (data) {
            object.putHTML(data)
        }).catch(function (error) {
            console.warn('Something went wrong.', error);
        });
    },
    "putHTML": function(data){
        app.users = data
        app.load = true
    },
    "delete": function(codigo){
        fetch(`${object.urlApi}?codigo=${codigo}`, {
            method: 'DELETE'
        }).then(function (response) {
            if (response.ok) {
                return response.json();
            }
            return Promise.reject(response);
        }).then(function (data) {
            object.listar()
        }).catch(function (error) {
            console.warn('Something went wrong.', error);
        });
    },
    "update": function(data){
        fetch(`${object.urlApi}`, {
            method: 'PUT',
            body: JSON.stringify(data),
        }).then(function (response) {
            if (response.ok) {
                return response.json();
            }
            return Promise.reject(response);
        }).then(function (data) {
            object.listar()
        }).catch(function (error) {
            console.warn('Something went wrong.', error);
        });
    },
    "insertInto": function(data){
        fetch(`${object.urlApi}`, {
            method: 'POST',
            body: JSON.stringify(data),
        }).then(function (response) {
            if (response.ok) {
                return response.json();
            }
            return Promise.reject(response);
        }).then(function (data) {
            object.listar()
        }).catch(function (error) {
            console.warn('Something went wrong.', error);
        });
    }
}

const app = new Vue({
    el: "#app",
    data: {
        users: [],
        load: false,
        editUser: null,
        newUser: {}
    },
    mounted(){
        this.listar()
    },
    methods:{
        listar(){
            setTimeout(() => {
                object.listar()
            }, 1000);
        },
        editarUsuario(user){
            this.editUser = user
        },
        save(){
            object.update(this.editUser)
            this.editUser = null
        },
        cancel(){  
            this.editUser = null
        },
        newUsuario(e){
            object.insertInto(this.newUser)
            this.newUser = {}
            e.preventDefault();
        },
        clear(e){
            this.newUser = {}
            e.preventDefault();
        }
    }
})
