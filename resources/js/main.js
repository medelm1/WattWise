import './bootstrap';

import { createApp } from 'vue';
import { createPinia } from 'pinia';
import vuetify from './plugins/vuetify';
import App from './App.vue';

const pinia = createPinia();
const app = createApp(App);

app.use(vuetify);
app.use(pinia);

app.mount('#app');