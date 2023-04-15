import { createApp } from "vue/dist/vue.esm-bundler.js";
import AppIndex from "./components/AppIndex.vue";
import { Alert } from "~bootstrap";
const app = createApp({});

app.component("app-index", AppIndex);
app.mount("#app");
