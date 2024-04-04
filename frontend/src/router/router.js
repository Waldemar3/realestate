import {createRouter, createWebHistory} from "vue-router";
import House from "@/components/House/House";
import Settlement from "@/components/Settlement/Settlement";
import Login from "@/components/Auth/Login";

const guest = (to, from, next) => {
    if (!localStorage.getItem("authToken")) {
        return next();
    } else {
        return next("/");
    }
};
const auth = (to, from, next) => {
    if (localStorage.getItem("authToken")) {
        return next();
    } else {
        return next("/login");
    }
};

const routes = [
    {
        path: '/settlements',
        name: 'Settlements',
        beforeEnter: auth,
        component: Settlement
    },
    {
        path: '/houses',
        name: 'Houses',
        beforeEnter: auth,
        component: House
    },
    {
        path: '/login',
        name: 'Login',
        beforeEnter: guest,
        component: Login
    },
]

const router = createRouter({
    routes,
    history: createWebHistory()
})

export default router;
