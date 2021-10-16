<template>
  <Link :href="routeName">
    <button
      class="
        py-12
        bg-gray-800
        rounded-md
        w-64
        font-semibold
        text-md text-white
        hover:bg-gray-500
        duration-500
        transition
        cursor-pointer
      "
      type="button"
    >
      {{ title }}
    </button>
  </Link>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
  name: 'Menu',
  components: {
    Link,
  },
  props: ['title', 'routeName'],
};
</script>

<style>
</style>
