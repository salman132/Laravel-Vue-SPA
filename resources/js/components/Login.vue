<template>
    <div class="login">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Login</div>

                        <div class="card-body">
                            <form @submit.prevent="doLogin">


                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control " name="email" v-model="email"  required autocomplete="email" autofocus>


                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" v-model="password" required autocomplete="current-password">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" v-model="rememberMe" name="remember" id="remember">

                                            <label class="form-check-label" for="remember">
                                              Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Login
                                        </button>


                                        <a class="btn btn-link" href="">
                                           Forgot Your Password
                                        </a>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Navbar from "./Navbar";

    export default {
        name: 'Login',
        data(){
            return{
                email: null,
                password: null,
                rememberMe:false,
                token: null,
                accept: 'application/json',
                authorization:null,
                auth: false,

            }
        },
        components:{
            Navbar: Navbar
        },

        created(){
         this.isTokenSet();
        },
        methods:{
            doLogin:function () {
                if(this.email && this.password && this.rememberMe){
                    let url = '/api/sign_in';
                    axios.post(url,{
                        email: this.email,
                        password: this.password,
                        remember_me: this.remember_me,
                    }).then(response =>{

                        const token = response.data.token;
                        localStorage.setItem('access_token',token);
                        this.isTokenSet();
                    }).catch(error =>{
                        console.log(error)
                    })
                }
            },
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
                        this.email = response.data.email;
                        this.redirectIfAuth();

                    }
                    else{

                        this.auth = false;
                        this.email = null;
                    }
                }).catch(error =>{
                    console.log(error)
                })
            },
            redirectIfAuth:function () {

             if(this.auth && this.email){

                 this.$router.push({name: "Home",params: {email:this.email}})
             }
            }
        }
    }
</script>
