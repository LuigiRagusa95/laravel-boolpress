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

<style>
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
