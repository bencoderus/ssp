<template>
  <base-layout title="Dashboard">
    <div
      class="
        grid grid-cols-1
        md:grid-cols-3
        lg:grid-cols-4
        sm:grid-cols-2
        gap-4
      "
    >
      <dashboard-menu
        :path="route('campaign.create')"
        title="Create Campaign"
      />
      <dashboard-menu :path="route('campaign.index')" title="Campaigns" />
      <dashboard-menu path="logout" title="Logout" @click.prevent="logout" />
    </div>
  </base-layout>
</template>

<script>
import { defineComponent } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import BaseLayout from '@/Layouts/BaseLayout.vue';
import DashboardMenu from '@/Components/Dashboard/Menu';

export default defineComponent({
  components: {
    AppLayout,
    BaseLayout,
    DashboardMenu,
  },
  methods: {
    logout() {
      this.$inertia.post(route('logout'));
    },
  },
});
</script>
