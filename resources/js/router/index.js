import { createWebHistory, createRouter } from "vue-router";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: () => import('@/views/public/Home.vue'),
            name: 'public.home',
        }
    ]
});

export default router;