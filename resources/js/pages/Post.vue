<template>
  <div class="container">
        <section class="mb-3 px-5 py-2">
            <div v-if="!post" class="loader-container"><Loader /></div>
            <article v-else class="mb-5">
                <h1 class="h3">{{ post.title }}</h1>
                <p class="text-small">{{ formatDate(post.created_at) }}</p>
                <p class="text-normal">{{ post.text }}</p>
            </article>
        </section>
  </div>
</template>

<script>
import Axios from 'axios';
import moment from 'moment';
import Loader from '../components/Loader.vue';
export default {
    components: { Loader },
    name: 'Post',
    data() {
        return {
            post: null,
        }
    },
    created() {
        this.getPost();
    },
    methods: {
        getPost() {
            Axios.get(`http://127.0.0.1:8000/api/posts/${this.$route.params.slug}`)
                .then(res => {
                    this.post = res.data;
            })
        },
        formatDate(date) {
            return moment(new Date(date).getTime()).fromNow();
        },
    }

}
</script>

<style>

</style>