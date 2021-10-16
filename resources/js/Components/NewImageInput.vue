<template>
  <div class="mb-3">
    <div class="flex w-full items-center justify-center">
      <label
        class="
          w-64
          flex flex-col
          items-center
          px-4
          py-5
          bg-gray-800
          text-white
          rounded-lg
          shadow-lg
          tracking-wide
          border border-blue
          cursor-pointer
          hover:bg-gray-600
          hover:text-white
        "
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 20 20"
          fill="currentColor"
          class="w-5"
        >
          <path
            fill-rule="evenodd"
            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
            clip-rule="evenodd"
          />
        </svg>
        <span class="mt-2 text-base leading-normal">New image</span>
      </label>
    </div>
  </div>
</template>

<script>
export default {
  name: 'NewImageInput',
};
</script>

<style>
</style>
