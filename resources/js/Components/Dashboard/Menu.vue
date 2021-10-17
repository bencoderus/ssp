<template>
    <Link :href="path">
        <button
            class="
        py-12
        bg-gray-700
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
import {Link} from '@inertiajs/inertia-vue3';
import {defineComponent} from "vue";

export default defineComponent({
    name: 'Menu',
    components: {
        Link,
    },
    props: ['title', 'path'],
});
</script>
