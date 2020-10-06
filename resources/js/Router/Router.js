import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Login from "../components/Auth/Login";

const routes = [{ path: "/sign-in", component: Login }];

const router = new VueRouter({
    mode: "history",
    routes
});

export default router;
