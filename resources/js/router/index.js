import {createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/", component: () => import ("../pages/Home.vue"),
        name: "home",  
    },
    {
        path: "/manytomany", component: () => import ("../pages/ManyToMany.vue"),
        name: "ManyToMany",  
    },
];

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes,
});

export default router;