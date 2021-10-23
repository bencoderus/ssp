<template>
  <base-layout :title="title">
    <form id="edit-form" class="flex-col space-y-5" @submit.prevent="save">
      <section>
        <jet-label for="name" value="Name" />
        <jet-input
          id="name"
          v-model="form.name"
          autofocus
          class="mt-1 block w-full"
          name="name"
          required
          type="text"
        />
        <jet-input-error :message="errors.name" />
      </section>

      <section class="flex flex-col md:flex-row gap-4">
        <div class="w-full">
          <jet-label for="start_date" value="Start Date" />
          <jet-input
            id="start_date"
            v-model="form.start_date"
            autofocus
            class="mt-1 block w-full"
            name="start_date"
            required
            type="date"
          />
          <jet-input-error :message="errors.start_date" />
        </div>

        <div class="w-full">
          <jet-label for="end_date" value="End Date" />
          <jet-input
            id="end_date"
            v-model="form.end_date"
            autofocus
            class="mt-1 w-full"
            name="end_date"
            required
            type="date"
          />
          <jet-input-error :message="errors.end_date" />
        </div>
      </section>

      <section class="flex flex-col md:flex-row gap-4">
        <div class="w-full">
          <jet-label for="daily_budget" value="Daily Budget" />
          <jet-input
            id="daily_budget"
            v-model="form.daily_budget"
            autofocus
            class="mt-1 w-full"
            name="daily_budget"
            required
            type="number"
          />
          <jet-input-error :message="errors.daily_budget" />
        </div>

        <div class="w-full">
          <jet-label for="total_budget" value="Total Budget" />
          <jet-input
            id="total_budget"
            v-model="form.total_budget"
            autofocus
            class="mt-1 w-full"
            name="total_budget"
            required
            type="number"
          />
          <jet-input-error :message="errors.total_budget" />
        </div>
      </section>

      <section v-show="campaign.images.length > 0">
        <jet-label for="images" value="Images" />
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-6 gap-4">
          <div v-for="(image, index) in campaign.images" :key="index">
            <img :src="image.path" alt="Preview" class="w-full" />
            <p class="text-center font-bold">
              <a href="/delete-image" @click.prevent="removeImage(image.id)"
                >Remove</a
              >
            </p>
          </div>
        </div>
      </section>

      <section>
        <jet-label for="images" value="Add new images" />
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
          <image-input attribute="images[]" />
        </div>
        <jet-input-error :message="errors.imaages" />
      </section>

      <section class="text-center">
        <input name="_method" type="hidden" value="patch" />
        <input type="hidden" name="_token" value="$page.props.csrf_token" />

        <jet-button
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          <svg
            class="h-6 w-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M12 6v6m0 0v6m0-6h6m-6 0H6"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
            />
          </svg>
          Save changes
        </jet-button>
      </section>
    </form>
  </base-layout>
</template>

<script>
import { defineComponent } from 'vue';
import BaseLayout from '@/Layouts/BaseLayout.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import ImageInput from '@/Components/ImageInput.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import { Link } from '@inertiajs/inertia-vue3';
import { formatInputDate } from '@/Utils/helpers';

export default defineComponent({
  components: {
    BaseLayout,
    ImageInput,
    JetButton,
    JetInput,
    JetLabel,
    JetInputError,
    UrlLink: Link,
    JetValidationErrors,
  },
  props: ['campaign'],
  data() {
    return {
      title: 'Edit campaign',
      form: this.$inertia.form({
        name: this.campaign.name,
        start_date: formatInputDate(this.campaign.start_date),
        end_date: formatInputDate(this.campaign.end_date),
        daily_budget: this.campaign.daily_budget,
        total_budget: this.campaign.total_budget,
        images: null,
      }),
    };
  },
  methods: {
    removeImage(id) {
      if (confirm('Are u sure you want to remove this image')) {
        this.$inertia.delete(route('campaign.image.delete', id), {
          preserveState: true,
          forceFormData: true,
        });

        alert('Image removed successfully');
      }
    },

    save() {
      const form = document.querySelector('#edit-form');

      this.$inertia.post(
        route('campaign.update', this.campaign.code),
        new FormData(form),
        {
          preserveState: true,
          forceFormData: true,
        },
      );
    },
  },
  computed: {
    errors() {
      return this.$page.props.errors;
    },

    endDate() {
      const date = formatInputDate(this.campaign.end_date);
      console.log(date);

      return date;
    },
  },
});
</script>
