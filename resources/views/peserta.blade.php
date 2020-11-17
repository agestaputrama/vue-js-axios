<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
</head>
<body>
    <div id="app"> 

        <form>
            <input type="text" v-model="form.name">
            <button v-show="!updateSubmit" v-on:click.prevent="add">add</button>
            <button v-show="updateSubmit" @click.prevent="update">update</button>
        </form>

        <ul v-for="(user, index) in users">
            <li>
                <span>@{{ user.name }}</span>
                <button @click="edit(user, index)">Edit</button> || <button @click="del(user, index)">Delete</button>
            </li>
        </ul>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        var app = new Vue({
            el:'#app',
            data(){
                return {
                    users : [],
                    updateSubmit : false,
                    form : {
                        'name' : ''
                    },
                    selectedUser : null,
                    user_id : null,
                }
            },
            methods:{
                add(){
                    axios.post('/api/peserta', this.form).then(res => {
                        this.users.push(
                        this.form
                    )
                    this.form = {}
                    })
                   
                },
                edit(user, index){ 
                    this.user_id = user.id
                    this.selectedUser = index
                    this.updateSubmit = true
                    this.form.name = user.name

                },
                update(){
                    axios.post('/api/peserta/update/' + this.user_id, this.form).then(res =>{
                        this.users[this.selectedUser].name = this.form.name
                        this.form = {}
                        this.updateSubmit = false
                        this.selectedUser = null
                        }).catch ((err) => {
                                console.log(err);
                            })
                },
                del(user, index){
                    var r = confirm('Anda yakin?')
                    if (r){
                        axios.post('/api/peserta/delete/' + user.id).then(res =>{
                            this.users.splice(index, 1)
                        }).catch ((err) => {
                                console.log(err);
                            })
                    }
                }
            },
            mounted() {
             axios.get('/api/peserta').then(response => {
                let result = response.data.data;
                this.users = result;
             }).catch ((err) => {
                    console.log(err);
                })
         }  
        });
     
    </script>
</body>
</html>