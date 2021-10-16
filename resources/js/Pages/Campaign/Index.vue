<template>
  <app-layout :title="title">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ title }}
      </h2>
    </template>
    <alert-message />
    <h3 class="my-4 mx-2">
      <url-link
        class="text-indigo-400 hover:text-indigo-600 font-bold"
        :href="route('dashboard')"
        >Home</url-link
      >
      <span class="text-indigo-400 font-medium"> / </span>Campaigns
    </h3>

    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="px-6 pt-6 pb-4">Name</th>
          <th class="px-6 pt-6 pb-4">Daily budget</th>
          <th class="px-6 pt-6 pb-4">Total budget</th>
          <th class="px-6 pt-6 pb-4">Start Date</th>
          <th class="px-6 pt-6 pb-4">End Date</th>
          <th class="px-6 pt-6 pb-4">Created At</th>
        </tr>
        <tr
          v-for="campaign in campaigns.data"
          :key="campaign.id"
          class="hover:bg-gray-100 focus-within:bg-gray-100"
        >
          <td class="border-t">
            <url-link
              class="px-6 py-4 flex items-center focus:text-indigo-500"
              :href="route('campaign.edit', campaign.code)"
            >
              {{ campaign.name }}
            </url-link>
          </td>
          <td class="border-t">
            <url-link
              class="px-6 py-4 flex items-center"
              :href="route('campaign.edit', campaign.code)"
              tabindex="-1"
            >
              {{ campaign.daily_budget }}
            </url-link>
          </td>
          <td class="border-t">
            <url-link
              class="px-6 py-4 flex items-center"
              :href="route('campaign.edit', campaign.code)"
              tabindex="-1"
            >
              {{ campaign.total_budget }}
            </url-link>
          </td>
          <td class="border-t">
            <url-link
              class="px-6 py-4 flex items-center"
              :href="route('campaign.edit', campaign.code)"
              tabindex="-1"
            >
              {{ campaign.start_date }}
            </url-link>
          </td>
          <td class="border-t">
            <url-link
              class="px-6 py-4 flex items-center"
              :href="route('campaign.edit', campaign.code)"
              tabindex="-1"
            >
              {{ campaign.end_date }}
            </url-link>
          </td>
          <td class="border-t">
            <url-link
              class="px-6 py-4 flex items-center"
              :href="route('campaign.edit', campaign.code)"
              tabindex="-1"
            >
              {{ campaign.created_at }}
            </url-link>
          </td>
        </tr>
        <tr v-if="campaigns.length === 0">
          <td class="border-t px-6 py-4" colspan="4">No Campaign found.</td>
        </tr>
      </table>
    </div>

    <pagination class="mt-6" :links="campaigns.links" />
  </app-layout>
</template>

<script>
import { defineComponent } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import AlertMessage from '@/Components/AlertMessage.vue';
import Pagination from '@/Components/Pagination.vue';
import { Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
  components: {
    AppLayout,
    Pagination,
    AlertMessage,
    UrlLink: Link,
  },
  props: ['campaigns'],
  data() {
    return {
      title: 'Campaigns',
    };
  },
});
</script>
