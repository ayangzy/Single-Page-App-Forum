require("./bootstrap");

window.Vue = require("vue");
import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import VueRouter from "vue-router";

Vue.use(Vuetify);
Vue.use(VueRouter);

import AppHome from "./components/AppHome.vue";
import router from "./Router/Router.js";

const app = new Vue({
    el: "#app",
    components: {
        AppHome
    },
    router
});
