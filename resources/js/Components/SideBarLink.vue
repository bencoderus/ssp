<template>
  <url-link :href="path">
    <div class="px-8 mt-2 py-4 text-md">
      <span class="hover:text-purpose-700"> {{ title }} </span>
      <span class="float-right">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          class="w-2 mt-2"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M9 5l7 7-7 7"
          />
        </svg>
      </span>
    </div>
  </url-link>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
  name: 'SideBarLink',
  components: {
    UrlLink: Link,
  },
  props: ['title', 'path'],
};
</script>

<style>
</style>
