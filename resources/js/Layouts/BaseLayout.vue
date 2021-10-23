<template>
  <Head :title="title" />
  <navbar />
  <div class="w-full">
    <div
      class="
        md:w-64
        fixed
        invisible
        md:visible
        bg-gray-300
        text-sm
        shadow-md
        h-screen
        text-gray-900
        p-8
      "
    >
      <side-bar-link :path="route('dashboard')" title="Dashboard" />
      <side-bar-link :path="route('campaign.index')" title="My campaigns" />
      <side-bar-link :path="route('campaign.create')" title="Create campaign" />

      <side-bar-link path="logout" title="Logout" @click.prevent="logout" />
    </div>
    <div class="md:ml-64 p-4 mb-10">
      <alert-message />
      <h1 class="mb-5 font-bold text-3xl text-gray-700">{{ title }}</h1>
      <slot />
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue';
import { Link, Head } from '@inertiajs/inertia-vue3';
import Navbar from '@/Components/Navbar';
import AlertMessage from '@/Components/AlertMessage';
import SideBarLink from '@/Components/SideBarLink';

export default defineComponent({
  props: {
    title: String,
  },
  components: {
    UrlLink: Link,
    SideBarLink,
    Navbar,
    AlertMessage,
    Head,
  },
  methods: {
    logout() {
      this.$inertia.post(route('logout'), {
        _token: this.$page.props.csrf_token,
      });
    },
  },
});
</script>
