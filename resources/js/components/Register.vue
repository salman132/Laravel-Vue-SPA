<template>
    <div class="register">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Register</div>

                        <div class="card-body">
                            <form @submit.prevent="doRegister">


                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" required autocomplete="name" v-model="name" autofocus>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" v-model="email"  required autocomplete="email">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password" v-model="password">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" v-model="confirmPassword">
                                    </div>
                                </div>
                                <div class="text-danger" v-if="feedback">
                                    {{ feedback}}
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                          Register
                                        </button>
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
    export default {
        name: 'Register',
        data(){
            return{
                name:null,
                email:null,
                password:null,
                confirmPassword:null,
                feedback:null

            }
        },
        methods:{
            doRegister:function () {
                if(this.password !== this.confirmPassword){
                    this.feedback = "Password not matched";
                }
                if(this.password === this.confirmPassword){
                    this.feedback = null
                }
                if(this.name && this.email && this.password && this.feedback == null){
                    let url = 'api/sign_up';
                    axios.post(url,{
                        name: this.name,
                        email: this.email,
                        password: this.password,
                    }).then(response =>{
                        console.log(response)
                    }).catch(error =>{
                        console.log(error);
                    })
                }
            }
        }
    }
</script>
