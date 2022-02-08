<template>
    <div>
        <div class="container">
            <h1 class="mt-2">Posts</h1>
            <section class="mb-3 px-5 py-2">
                <div v-if="!posts" class="loader-container"><Loader /></div>
                <article
                    v-else
                    class="mb-5"
                    v-for="post in posts"
                    :key="`post-${post.id}`"
                >
                    <h1 class="h3">{{ post.title }}</h1>
                    <p class="text-small">{{ formatDate(post.created_at) }}</p>
                    <p class="text-normal">{{ post.text }}</p>
                </article>
            </section>
            <section class="mb-3">
                <button
                    class="btn btn-primary"
                    :disabled="pagination.current === 1"
                    @click="getPosts(pagination.current - 1)"
                >
                    Prev
                </button>
                <button
                    class="btn btn-primary"
                    :disabled="pagination.current === pagination.last"
                    @click="getPosts(pagination.current + 1)"
                >
                    Next
                </button>
            </section>
            <!-- <a href="/admin">Vai alla pagina admin</a> -->
        </div>
    </div>
</template>

<script>
import axios from "axios";
import moment from "moment";
import Loader from "../components/Loader.vue";

export default {
    components: { Loader },
    name: "App",
    data() {
        return {
            posts: null,
            pagination: {},
        };
    },
    created() {
        this.getPosts();
    },
    methods: {
        getPosts(page = 1) {
            axios
                .get(`http://127.0.0.1:8000/api/posts?page=${page}`)
                .then((res) => {
                    this.posts = res.data.data;
                    this.pagination = {
                        current: res.data.current_page,
                        last: res.data.last_page,
                    };
                });
        },
        formatDate(date) {
            return moment(new Date(date).getTime()).fromNow();
        },
    },
};
</script>

<style>
.text-small {
    font-size: 12px;
    line-height: 16px;
}
.text-normal {
    font-size: 16px;
    line-height: 24px;
}
.loader-container {
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    display: flex;
    position: absolute;
    align-items: center;
    justify-content: center;
}
</style>
