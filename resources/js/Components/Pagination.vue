<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap -mb-1">
      <template v-for="(link, key) in links" :key="key">
        <div
          v-if="link.url === null"
          class="
            mr-1
            mb-1
            px-4
            py-3
            text-sm
            leading-4
            text-gray-400
            border
            rounded
          "
          v-html="link.label"
        />
        <url-link
          v-else
          :class="{ 'bg-white': link.active }"
          :href="link.url"
          class="
            mr-1
            mb-1
            px-4
            py-3
            text-sm
            leading-4
            border
            rounded
            hover:bg-white
            focus:border-indigo-500 focus:text-indigo-500
          "
          v-html="link.label"
        />
      </template>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
  props: ['links'],
  components: {
    UrlLink: Link,
  },
});
</script>
