<template>
    <div class="my-4">
        <div
            v-if="$page.props.flash.success && show"
            class="
        mb-8
        flex
        items-center
        justify-between
        bg-green-500
        rounded
        w-full
      "
        >
            <div class="flex items-center">
                <svg
                    class="h-5 w-5 mx-2 text-white"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M5 13l4 4L19 7"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                    />
                </svg>
                <div class="py-4 text-white text-sm font-medium">
                    {{ $page.props.flash.success }}
                </div>
            </div>
            <button class="group mr-2 p-2" type="button" @click="show = false">
                <svg
                    class="h-5 w-5 mx-2 text-white"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M6 18L18 6M6 6l12 12"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                    />
                </svg>
            </button>
        </div>
        <div
            v-if="
        ($page.props.flash.error ||
          Object.keys($page.props.errors).length > 0) &&
        show
      "
            class="
        mb-8
        flex
        items-center
        justify-between
        bg-red-400
        rounded
        w-full
      "
        >
            <div class="flex items-center">
                <svg
                    class="h-5 w-5 mx-2 text-white"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M6 18L18 6M6 6l12 12"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                    />
                </svg>
                <div
                    v-if="$page.props.flash.error"
                    class="py-4 text-white text-sm font-medium"
                >
                    {{ $page.props.flash.error }}
                </div>
                <div v-else class="py-4 text-white text-sm font-medium">
          <span v-if="Object.keys($page.props.errors).length === 1"
          >There is one form error.</span
          >
                    <span v-else
                    >There are {{ Object.keys($page.props.errors).length }} form
            errors.</span
                    >
                </div>
            </div>
            <button class="group mr-2 p-2" type="button" @click="show = false">
                <svg
                    class="h-5 w-5 mx-2 text-white"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M6 18L18 6M6 6l12 12"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                    />
                </svg>
            </button>
        </div>
    </div>
</template>

<script>
import {defineComponent} from 'vue';

export default defineComponent({
    data() {
        return {
            show: true,
        };
    },
    watch: {
        '$page.props.flash': {
            handler() {
                this.show = true;
            },
            deep: true,
        },
    },
});
</script>
