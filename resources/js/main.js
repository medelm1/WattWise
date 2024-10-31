import './bootstrap';

import { createApp } from 'vue';
import { createPinia } from 'pinia';
import toast from './plugins/toast';
import PrimeVue from './plugins/primevue';

import App from './App.vue';

const pinia = createPinia();
const app = createApp(App);

app.use(
    PrimeVue, 
    { 
        theme: 'none',
    }
);
app.use(pinia);
app.use(toast);

app.mount('#app');