<template>
    <header class="bg-gray-700 sticky top-0 pl-8 py-6 text-white w-screen">
        <url-link :href="route('dashboard')">
            <span class="font-bold">SSP</span>
        </url-link>
        <span class="float-right mr-8 text-white">
      <div v-show="$page.props.user.name" class="pb-2">
        <div class="dropdown inline-block relative">
          <span
              class="text-white font-semibold pb-4 px-4 inline-flex items-center"
          >
            <span class="mr-1">{{ $page.props.user.name }}</span>
            <svg
                class="fill-current h-4 w-4"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
            >
              <path
                  d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
              />
            </svg>
          </span>
          <ul
              class="
              dropdown-menu
              w-32
              shadow-md
              absolute
              hidden
              text-gray-700
              pt-1
            "
          >
            <li>
              <url-link :href="route('dashboard')">
                <span
                    class="
                    text-sm
                    bg-white
                    hover:bg-gray-400
                    py-2
                    px-8
                    block
                    whitespace-no-wrap
                  "
                >Home</span
                >
              </url-link>
            </li>
            <li>
              <url-link :href="route('campaign.index')">
                <span
                    class="
                    bg-white
                    text-sm
                    hover:bg-gray-400
                    py-2
                    px-8
                    block
                    whitespace-no-wrap
                  "
                >Campaigns</span
                >
              </url-link>
            </li>
            <li>
              <url-link href="logout" @click="logout">
                <span
                    class="
                    text-sm
                    bg-white
                    hover:bg-gray-400
                    py-2
                    px-8
                    block
                    whitespace-no-wrap
                  "
                >Logout</span
                >
              </url-link>
            </li>
          </ul>
        </div>
      </div>
    </span>
    </header>
</template>

<script>
import {defineComponent} from 'vue';
import {Link} from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: {
        UrlLink: Link,
    },
    methods: {
        logout() {
            this.$inertia.post(route('logout'));
        },
    }
});
</script>

<style>
.dropdown:hover .dropdown-menu {
    display: block;
}
</style>
