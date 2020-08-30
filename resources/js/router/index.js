import Vue from 'vue';
import VueRouter from 'vue-router';
import Welcome from "../components/Welcome";
import Login from "../components/Login";
import Register from "../components/Register";

Vue.use(VueRouter);
const routes = new VueRouter({
    mode: 'history',
    routes:[
        {
            path:"/",
            name: 'Home',
            component: Welcome
        },
        {
            path: '/signIn',
            name: 'Login',
            component: Login,
        },
        {
            path: 'register',
            name: 'Register',
            component: Register,
        }
    ]
});

export default routes;
