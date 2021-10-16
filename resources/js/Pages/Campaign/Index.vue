<template>
    <base-layout :title="title">
        <div v-if="campaigns.data.length === 0" class="text-center">
            <p class="text-gray-700 mb-6 text-2xl">
                No campaign has been created yet.
            </p>

            <url-link :href="route('campaign.create')">
                <button class="bg-purple-700 text-white p-3" type="button">
                    Create a new campaign
                </button>
            </url-link>
        </div>
        <div v-else class="bg-white shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap text-md">
                <tr class="text-left font-bold bg-gray-700 text-white">
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
                            :href="route('campaign.edit', campaign.code)"
                            class="px-6 py-4 flex items-center focus:text-indigo-500"
                        >
                            {{ campaign.name }}
                        </url-link>
                    </td>
                    <td class="border-t">
                        <url-link
                            :href="route('campaign.edit', campaign.code)"
                            class="px-6 py-4 flex items-center"
                            tabindex="-1"
                        >
                            {{ campaign.daily_budget }}
                        </url-link>
                    </td>
                    <td class="border-t">
                        <url-link
                            :href="route('campaign.edit', campaign.code)"
                            class="px-6 py-4 flex items-center"
                            tabindex="-1"
                        >
                            {{ campaign.total_budget }}
                        </url-link>
                    </td>
                    <td class="border-t">
                        <url-link
                            :href="route('campaign.edit', campaign.code)"
                            class="px-6 py-4 flex items-center"
                            tabindex="-1"
                        >
                            {{ campaign.start_date }}
                        </url-link>
                    </td>
                    <td class="border-t">
                        <url-link
                            :href="route('campaign.edit', campaign.code)"
                            class="px-6 py-4 flex items-center"
                            tabindex="-1"
                        >
                            {{ campaign.end_date }}
                        </url-link>
                    </td>
                    <td class="border-t">
                        <url-link
                            :href="route('campaign.edit', campaign.code)"
                            class="px-6 py-4 flex items-center"
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

        <pagination :links="campaigns.links" class="mt-6"/>
    </base-layout>
</template>

<script>
import {defineComponent} from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import BaseLayout from '@/Layouts/BaseLayout.vue';
import AlertMessage from '@/Components/AlertMessage.vue';
import Pagination from '@/Components/Pagination.vue';
import {Link} from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: {
        AppLayout,
        BaseLayout,
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
