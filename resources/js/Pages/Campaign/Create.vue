<template>
  <app-layout :title="title">
    <h3 class="my-4 mx-2">
      <url-link
        class="text-indigo-400 hover:text-indigo-600 font-bold"
        :href="route('dashboard')"
        >Home</url-link
      >
      <span class="text-indigo-400 font-medium"> / </span>
      <url-link
        class="text-indigo-400 hover:text-indigo-600 font-bold"
        :href="route('campaign.index')"
        >Campaigns</url-link
      >
      <span class="text-indigo-400 font-medium"> / </span>New Campaign
    </h3>
    <div class="my-10 w-8/12 mx-auto bg-white rounded-xl p-10">
      <h2 class="font-semibold text-xl mb-6 text-gray-800 leading-tight">
        {{ title }}
      </h2>

      <form @submit.prevent="save" class="flex-col space-y-2" id="create-form">
        <section class="my-5">
          <jet-label for="name" value="Name" />
          <jet-input
            id="name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.name"
            name="name"
            required
            autofocus
          />
          <jet-input-error :message="errors.name" />
        </section>

        <section class="my-5 flex flex-col md:flex-row gap-4">
          <div class="w-full">
            <jet-label for="start_date" value="Start Date" />
            <jet-input
              id="start_date"
              type="date"
              class="mt-1 block w-full"
              v-model="form.start_date"
              name="start_date"
              required
              autofocus
            />
            <jet-input-error :message="errors.start_date" />
          </div>

          <div class="w-full">
            <jet-label for="end_date" value="End Date" />
            <jet-input
              id="end_date"
              type="date"
              class="mt-1 w-full"
              v-model="form.end_date"
              name="end_date"
              required
              autofocus
            />
            <jet-input-error :message="errors.end_date" />
          </div>
        </section>

        <section class="my-5 flex flex-col md:flex-row gap-4">
          <div class="w-full">
            <jet-label for="daily_budget" value="Daily Budget" />
            <jet-input
              id="daily_budget"
              name="daily_budget"
              type="number"
              class="mt-1 w-full"
              v-model="form.daily_budget"
              required
              autofocus
            />
            <jet-input-error :message="errors.daily_budget" />
          </div>

          <div class="w-full">
            <jet-label for="total_budget" value="Total Budget" />
            <jet-input
              id="total_budget"
              name="total_budget"
              type="number"
              class="mt-1 w-full"
              v-model="form.total_budget"
              required
              autofocus
            />
            <jet-input-error :message="errors.total_budget" />
          </div>
        </section>

        <section class="my-5">
          <jet-label for="images" value="Images" />
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <image-input attribute="images[]" />
          </div>
          <jet-input-error :message="errors.imaages" />
        </section>

        <section class="my-5 text-center mb-4">
          <jet-button
            class="mt-4"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-6 w-6"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 6v6m0 0v6m0-6h6m-6 0H6"
              />
            </svg>
            Create campaign
          </jet-button>
        </section>
      </form>
    </div>
  </app-layout>
</template>

<script>
import { defineComponent } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import ImageInput from '@/Components/ImageInput.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import { Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
  components: {
    AppLayout,
    ImageInput,
    JetButton,
    JetInput,
    JetLabel,
    JetInputError,
    UrlLink: Link,
    JetValidationErrors,
  },
  data() {
    return {
      title: 'Create a campaign',
      images: [1],
      form: this.$inertia.form({
        name: '',
        start_date: '',
        end_date: '',
        daily_budget: '',
        total_budget: '',
        images: null,
      }),
    };
  },
  methods: {
    save() {
      const form = document.querySelector('#create-form');

      this.$inertia.post(route('campaign.store'), new FormData(form), {
        preserveState: true,
        forceFormData: true,
      });
    },
  },
  computed: {
    errors() {
      return this.$page.props.errors;
    },
  },
});
</script>
