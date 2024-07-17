import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/persons',
        name: 'PersonList',
        component: () => import('./layouts/persons/PersonList.vue'),
    },
    {
        path: '/persons/create',
        name: 'PersonCreate',
        component: () => import('./layouts/persons/PersonCreate.vue'),
    },
    {
        path: '/persons/:id',
        name: 'PersonDetail',
        component: () => import('./layouts/persons/PersonDetail.vue'),
    },
    {
        path: '/persons/:id/edit',
        name: 'PersonEdit',
        component: () => import('./layouts/persons/PersonEdit.vue'),
    },
    {
        path: '/address/create/:personId?',
        name: 'AddressCreate',
        component: () => import('./layouts/addresses/AddressCreate.vue'),
        props: true
    },
    {
        path: '/address/:id/edit',
        name: 'AddressEdit',
        component: () => import('./layouts/addresses/AddressEdit.vue'),
    },
    {
        path: '/address/:id/history',
        name: 'AddressHistory',
        component: () => import('./layouts/addresses/AddressHistory.vue'),
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
