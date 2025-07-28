<template>
    <button
        :disabled="disabled || loading"
        class="text-sm inline-flex justify-center disabled:bg-gray-400 items-center px-3 py-2 bg-themeSecondary border border-transparent rounded-md text-white hover:bg-themeLightPrimary focus:bg-themeLightPrimary active:bg-themeLightPrimary focus:outline-none focus:ring-2 focus:ring-themePrimary focus:ring-offset-2 transition ease-in-out duration-150"
    >
        <LoadingIcon
            v-if="loading"
            icon="three-dots"
            class="w-7 h-7 z-10 overlay-loading"
            :class="loading && 'anim-scale-up'"
        />
        <span v-else class="transition-all" :class="loading && 'anim-scale-down'">
          <slot/>
        </span>
    </button>

</template>

<script>
import {defineComponent} from "vue";

export default defineComponent({
    name: "ButtonWithLoading",
    props: {
        type: {
            type: String,
            default: "button",
        },
        loading: {
            type: Boolean,
            default: false,
        },
        disabled: {
            type: Boolean,
            default: false,
        },
    },
});
</script>

<style>
.overlay-loading-wrapper {
    position: relative;
}

.overlay-loading-wrapper.btn {
    min-width: 90px;
}

.overlay-loading-wrapper.overlay-layer:before,
.overlay-loading-wrapper .overlay-layer:before {
    content: " ";
    position: absolute;
    top: 0;
    left: 0;
    z-index: 3;
    width: 100%;
    height: 100%;
    background-color: rgb(28, 50, 113, 0.65);
    border-radius: inherit;
}

.overlay-loading-wrapper .overlay-loading {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
}

.overlay-loading-wrapper .overlay-loading svg.w-full.h-full {
    width: 1.7rem !important;
    height: 1.7rem !important;
    fill: currentColor !important;
    stroke: currentColor !important;
}
</style>
