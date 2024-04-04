import { createApp } from 'vue'
import components from '@/components/UI';
import App from './App.vue';
import router from "@/router/router";
import store from '@/store';

const app = createApp(App);

components.forEach(component => app.component(component.name, component))

app
    .use(store)
    .use(router)
    .mount('#app');
