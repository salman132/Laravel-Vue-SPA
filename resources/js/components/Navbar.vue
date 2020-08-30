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
                                        <router-link :to="{ name: 'Home' }" class="nav-link">Logo</router-link>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6 text-right">
                                                <router-link :to="{ name: 'Login' }" class="nav-link text-right">Login</router-link>
                                            </div>

                                            <div class="col-md-6 text-left">
                                                <router-link :to="{ name: 'Register' }" class="nav-link">Register</router-link>
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

            }
        }
    }
</script>
