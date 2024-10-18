import './bootstrap';

import { createApp } from 'vue';
import { createPinia } from 'pinia';
import vuetify from './plugins/vuetify';
import toast from './plugins/toast';
import App from './App.vue';

const pinia = createPinia();
const app = createApp(App);

app.use(vuetify);
app.use(pinia);
app.use(toast);

app.mount('#app');