<template>
  <base-layout title="Dashboard">
    <div class="flex gap-5">
      <dashboard-menu
        title="Create Campaign"
        :path="route('campaign.create')"
      />
      <dashboard-menu title="Campaigns" :path="route('campaign.index')" />
      <dashboard-menu title="My profile" :path="route('campaign.index')" />
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
});
</script>
