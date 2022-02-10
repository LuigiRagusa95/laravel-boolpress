import Vue from "vue";
import VueRouter from "vue-router";

import Home from "./pages/Home";
import Post from "./pages/Post";
import About from "./pages/About";
import Posts from "./pages/Posts";
import Empty from "./pages/Empty";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        { path: "/", name: "home", component: Home },
        { path: "/about", name: "about", component: About },
        { path: "/posts", name: "posts", component: Posts },
        { path: "/posts/:slug", name: "post", component: Post },

        { path: "*", name: "empty", component: Empty },
    ],
    linkExactActiveClass: 'active',
});

export default router;
