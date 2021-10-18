<template>
    <base-layout :title="title">
        <div v-if="campaigns.data.length === 0" class="text-center">
            <p class="text-gray-700 mb-6 text-2xl">
                No campaign has been created yet.
            </p>

            <url-link :href="route('campaign.create')">
                <button class="bg-gray-700 text-white p-3" type="button">
                    Create a new campaign
                </button>
            </url-link>
        </div>

        <div v-else class="bg-white shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold bg-gray-700 text-white">
                    <th class="px-6 pt-6 pb-4">Name</th>
                    <th class="px-6 pt-6 pb-4">Daily budget</th>
                    <th class="px-6 pt-6 pb-4">Total budget</th>
                    <th class="px-6 pt-6 pb-4">Created At</th>
                    <th class="px-6 pt-6 pb-4">Actions</th>
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
                            {{ formatMoney(campaign.daily_budget) }}
                        </url-link>
                    </td>
                    <td class="border-t">
                        <url-link
                            :href="route('campaign.edit', campaign.code)"
                            class="px-6 py-4 flex items-center"
                            tabindex="-1"
                        >
                            {{ formatMoney(campaign.total_budget) }}
                        </url-link>
                    </td>
                    <td class="border-t">
                        <url-link
                            :href="route('campaign.edit', campaign.code)"
                            class="px-6 py-4 flex items-center"
                            tabindex="-1"
                        >
                            {{ formatDateString(campaign.created_at) }}
                        </url-link>
                    </td>
                    <td class="border-t">
                        <jet-button class="mx-1" @click="showPreview(campaign.id)"
                        >View
                        </jet-button
                        >
                        <url-link
                            :href="route('campaign.edit', campaign.code)"
                            class="mx-1"
                        >
                            <jet-button type="button">Edit</jet-button>
                        </url-link>
                    </td>
                </tr>
                <tr v-if="campaigns.length === 0">
                    <td class="border-t px-6 py-4" colspan="4">No Campaign found.</td>
                </tr>
            </table>
        </div>

        <paginator :links="campaigns.links" class="mt-6"/>
    </base-layout>

    <image-modal :show="modalIsOpen" @close="closeModal">
        <template #title>
            {{ campaign.name || '' }}
        </template>

        <template #content>
            <div v-if="campaign.images.length === 0">
                <p>Sorry there are no images to render at the moment.</p>
            </div>
            <carousel v-else :autoplay="4000" :wrap-around="true">
                <slide v-for="(image, index) in campaign.images" :key="index">
                    <div class="carousel__item text-center w-64">
                        <img :alt="image.title" :src="image.path"/>
                    </div>
                </slide>
                <template #addons>
                    <navigation/>
                    <pagination/>
                </template>
            </carousel>
        </template>
        <template #footer>
            <div>
                <jet-button @click="closeModal">Close</jet-button>
            </div>
        </template>
    </image-modal>
</template>

<script>
import {defineComponent} from 'vue';
import {Link} from '@inertiajs/inertia-vue3';
import 'vue3-carousel/dist/carousel.css';
import {Carousel, Navigation, Pagination, Slide} from 'vue3-carousel';
import AppLayout from '@/Layouts/AppLayout.vue';
import BaseLayout from '@/Layouts/BaseLayout.vue';
import AlertMessage from '@/Components/AlertMessage.vue';
import Paginator from '@/Components/Pagination.vue';
import JetButton from '@/Jetstream/Button.vue';
import {formatDate} from '../../Utils/helpers';
import ImageModal from '../../Components/ImageModal';

export default defineComponent({
    components: {
        AppLayout,
        ImageModal,
        BaseLayout,
        Paginator,
        AlertMessage,
        UrlLink: Link,
        Carousel,
        Navigation,
        Pagination,
        Slide,
        JetButton,
    },
    props: ['campaigns'],
    data() {
        return {
            title: 'Campaigns',
            modalIsOpen: false,
            campaign: null,
        };
    },

    methods: {
        showPreview(id) {
            this.modalIsOpen = true;
            this.campaign = this.campaigns.data.find(
                (campaign) => campaign.id === id,
            );
        },
        formatDateString(val) {
            return formatDate(val);
        },
        formatMoney(val) {
            return '$' + parseFloat(val).toLocaleString();
        },
        closeModal() {
            this.modalIsOpen = false;
        },
    },
});
</script>

<style>
.carousel__icon {
    fill: #000 !important;
}
</style>
