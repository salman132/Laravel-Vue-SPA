import Vue from 'vue';
import VueRouter from 'vue-router';
import Welcome from "../components/Welcome";
import Login from "../components/Login";
import Register from "../components/Register";
import Home from "../components/pages/Home";

Vue.use(VueRouter);
const routes = new VueRouter({
    mode: 'history',
    routes:[
        {
            path:"/",
            name: 'Welcome',
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
        },
        {
            path: '/home',
            name: 'Home',
            component: Home,
            beforeEnter:(to , from , next)=>{
                if(to.params.email){
                    next()
                }
                else{
                    next({name: 'Login'})
                }
            }
        }
    ]
});

export default routes;
