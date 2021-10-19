<template>
  <url-link :href="path">
    <div class="px-4 mt-2 py-4 text-base">
      <span class="hover:text-gray-900"> {{ title }} </span>
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

