import Vue from "vue";
import VueRouter from "vue-router";

import Home from "./pages/Home";
import About from "./pages/About";
import Posts from "./pages/Posts";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        { path: "/", name: "home", component: Home },
        { path: "/about", name: "about", component: About },
        { path: "/posts", name: "posts", component: Posts },
    ],
    linkExactActiveClass: 'active',
});

export default router;
