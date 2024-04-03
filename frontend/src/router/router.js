import {createRouter, createWebHistory} from "vue-router";
import House from "@/components/House/House";
import Settlement from "@/components/Settlement/Settlement";

const routes = [
    {
        path: '/settlements',
        component: Settlement
    },
    {
        path: '/houses',
        component: House
    },
]

const router = createRouter({
    routes,
    history: createWebHistory()
})

export default router;
