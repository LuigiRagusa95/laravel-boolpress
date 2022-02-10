<template>
  <div class="d-flex">
      <span class="badge bg-primary text-white mr-1" v-for="element in list" :key="`tag-${element.id}`">{{element.name}}</span>
  </div>
</template>

<script>
export default {
    name: 'Tags',
    props: {
        list: Array
    }
}
</script>

<style></style>