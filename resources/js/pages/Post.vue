<template>
  <div class="container">
        <section class="mb-3 px-5 py-2">
            <div v-if="!post" class="loader-container"><Loader /></div>
            <article v-else class="mb-5">
                <h1 class="h3 m-0">{{ post.title }}</h1>
                <span class="text-small">{{ formatDate(post.created_at) }}</span>
                <Tags class="mb-2" :list="post.tags" />
                <p class="text-normal mt-3">{{ post.text }}</p>
            </article>
        </section>
  </div>
</template>

<script>
import Axios from 'axios';
import moment from 'moment';
import Tags from '../components/Tags.vue';
import Loader from '../components/Loader.vue';
export default {
    components: { Loader, Tags },
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
                    if (res.data.empty) {
                         this.$router.push({name: 'empty'})
                    } else {
                        this.post = res.data
                    }
                    
            }).catch(err => console.log(err));
        },
        formatDate(date) {
            return moment(new Date(date).getTime()).fromNow();
        },
    }

}
</script>

<style>

</style>