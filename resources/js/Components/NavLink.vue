<script setup>
import {computed} from 'vue';
import {Link} from '@inertiajs/vue3';
const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
    icon: {
        type: String,
    }

});

const classes = computed(() =>
    props.active
        ? 'bg-white text-blue-950 active' : 'hover:bg-themeLightPrimary text-white'
);
</script>

<template>
    <Link :href="href" :class="classes"
          class="rounded-md text-md flex justify-start items-center relative my-2 p-3">
        <vue-feather class="ml-3" size="25" :type="icon"/>
        <slot/>
    </Link>
</template>
