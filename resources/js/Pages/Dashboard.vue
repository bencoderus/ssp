<template>
    <base-layout title="Dashboard">
        <div class="flex gap-5">
            <dashboard-menu
                :path="route('campaign.create')"
                title="Create Campaign"
            />
            <dashboard-menu :path="route('campaign.index')" title="Campaigns"/>
            <dashboard-menu path="logout" title="Logout" @click.prevent="logout"/>
        </div>
    </base-layout>
</template>

<script>
import {defineComponent} from 'vue';
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
