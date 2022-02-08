<template>
    <div class="loader"></div>
</template>

<script>
export default {
    name: "Loader",
};
</script>

<style scoped>
.loader {
    width: 24px;
    height: 24px;
    border-radius: 999999px;
    border: 2px solid #c0defb;
    border-right-color: #3e8ae4;
    animation: spin 500ms linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(1turn);
    }
}
</style>
