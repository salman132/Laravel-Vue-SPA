


require('./bootstrap');

window.Vue = require('vue');

import vue from 'vue';

//Routes
import routes from './router/index'



import Welcome from './components/Welcome';
import Login from "./components/Login";
import Navbar from "./components/Navbar";



const app = new Vue({
    el: '#app',
    router: routes,
    components:{
        'Welcome': Welcome,
        'Login' : Login,
        'Navbar' : Navbar
    }
});
