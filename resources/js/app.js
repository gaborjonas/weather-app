import { createApp } from "vue/dist/vue.esm-bundler.js";
import AppIndex from "./components/AppIndex.vue";
const app = createApp({});

app.component("app-index", AppIndex);
app.mount("#app");
