<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>

    <div class="m-12 flex gap-5">
      <dashboard-menu
        title="Create Campaign"
        :routeName="route('campaign.create')"
      />
      <dashboard-menu title="Campaigns" :routeName="route('campaign.index')" />
      <dashboard-menu title="My profile" :routeName="route('campaign.index')" />
    </div>
  </app-layout>
</template>

<script>
import { defineComponent } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import DashboardMenu from '@/Components/Dashboard/Menu';

export default defineComponent({
  components: {
    AppLayout,
    DashboardMenu,
  },
});
</script>
