<template>
    <url-link :href="path">
        <div class="px-4 mt-2 py-4 text-base">
            <span class="hover:text-purpose-700"> {{ title }} </span>
            <span class="float-right">
        <svg
            class="w-2 mt-2"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
        >
          <path
              d="M9 5l7 7-7 7"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
          />
        </svg>
      </span>
        </div>
    </url-link>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3';

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
