<template>
  <div class="mb-4" v-for="(image, index) in images" :key="index">
    <div class="flex w-full items-center justify-center bg-grey-lighter">
      <label
        class="
          w-64
          flex flex-col
          items-center
          px-4
          py-4
          bg-white
          text-blue
          rounded-lg
          shadow-lg
          tracking-wide
          border border-blue
          cursor-pointer
          hover:bg-gray-800
          hover:text-white
        "
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 20 20"
          fill="currentColor"
          class="w-6"
        >
          <path
            fill-rule="evenodd"
            d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
            clip-rule="evenodd"
          />
        </svg>
        <span class="mt-2 text-base leading-normal">Choose Image</span>
        <input type="file" class="hidden" :name="attribute" />
      </label>
    </div>
    <div class="flex justify-center">
      <button
        class="bg-red-700 my-4 text-white p-3 text-xs"
        type="button"
        @click="removeFileField(index)"
      >
        Remove
      </button>
    </div>
  </div>

  <new-image-input @click="addFileField()" />
</template>

<script>
import NewImageInput from './NewImageInput.vue';

export default {
  props: ['attribute'],
  components: {
    NewImageInput,
  },
  data() {
    return {
      images: [1],
      count: 0,
    };
  },
  methods: {
    addFileField() {
      let last = this.images[0];
      this.images.push(++last);
    },

    removeFileField(index) {
      if (index === 0) {
        return alert('You need atleast one image field');
        // return this.$toast.warning('You need atleast one image field');
      }

      this.images.splice(index, 1);
    },
  },
};
</script>

<style>
</style>
