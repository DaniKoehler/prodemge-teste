import './bootstrap';
import { createApp } from 'vue';
import App from "./layouts/app.vue";
import vuetify from "./vuetify";
import router from "./routes";

createApp(App).use(vuetify).use(router).mount("#app");
