<template>
    <div class="navbar text-right col-md-12 bg-dark">
        <div class="col-md-12">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark col-md-12">

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">


                        <div class="container">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6 text-left">
                                        <router-link :to="{ name: 'Welcome' }" class="nav-link">Logo</router-link>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6 text-right" v-if="!auth">
                                                <router-link :to="{ name: 'Login' }" class="nav-link text-right">Login</router-link>
                                            </div>

                                            <div class="col-md-6 text-left" v-if="!auth">
                                                <router-link :to="{ name: 'Register' }" class="nav-link">Register</router-link>
                                            </div>

                                            <div class="col-md-6 text-left" v-if="auth">

                                                <a href="#" @click="logout" class="nav-link">Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                </div>
            </nav>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Navbar',
        data(){
            return{
                email:null,
                auth: false
            }
        },
        created(){
            this.isTokenSet();
        },
        methods:{
            isTokenSet:function () {
                let store = localStorage.getItem('access_token');
                if(store !== 'undefined'){
                    this.authorization = 'Bearer '+store;

                }
                let url = 'api/user';
                axios.get(url,{
                    headers:{
                        'Accept': 'application/json',
                        'Authorization': this.authorization,
                    }
                }).then(response =>{

                    if(response.data.email){
                        this.auth = true;
                    }
                    else{

                        this.auth = false;

                    }
                }).catch(error =>{
                    console.log(error)
                })
            },

            logout:function () {
                let url = "api/logout";
                let store = localStorage.getItem('access_token');
                if(store !== undefined){
                    store = "Bearer "+store;
                }

                console.log(store)
                axios.post(url,{
                    'Accept' : 'application/json'

                },{
                    headers:{
                        'Accept': 'application/json',
                        'Authorization': store,
                    }
                }).then(response =>{
                    console.log(response);
                    localStorage.removeItem('access_token')
                    this.$router.push({name: 'Login'});
                }).catch(error =>{
                    console.log(error)
                })
            }
        }
    }
</script>
