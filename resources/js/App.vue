<template>
    <div>
        <Header />
        <main>
            <router-view></router-view>
        </main>
        <footer></footer>
    </div>
</template>

<script>
import Header from "./components/Header.vue";
export default {
    components: { Header },
    name: "App",
};
</script>

<style></style>
