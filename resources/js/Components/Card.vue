<script setup>
import {computed, onMounted, onUnmounted, watch} from 'vue';

const props = defineProps({
});
</script>
<template>
    <div class="rounded-2xl border border-gray-100 shadow-md p-3 bg-white">
        <slot/>
    </div>
</template>
