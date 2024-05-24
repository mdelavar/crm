<template>
    <div
        class="w-full col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center justify-between mx-auto p-4"
    >
        <p class="select-none text-gray-600">
            نمایش {{ paginate.meta.from }} تا {{ paginate.meta.to }} از
            {{ paginate.meta.total }} سطر | صفحه {{ paginate.meta.current_page }} از
            {{ paginate.meta.last_page }}
        </p>
        <ul class="pagination items-center">
            <li>
                <button
                    v-if="paginate.links.prev"
                    class="pagination__link hover:bg-themeLightPrimary"
                    @click="load_items(paginate.links.first, 1)"
                >
                    <vue-feather size="20" type="arrow-right" class="text-white"/>
                </button>
            </li>
            <li>
                <button
                    v-if="paginate.links.prev"
                    class="pagination__link hover:bg-themeLightPrimary"
                    @click="
            load_items(paginate.links.prev, paginate.meta.current_page - 1)
          "
                >
                    {{ paginate.meta.current_page - 1 }}
                </button>
            </li>
            <li>
        <span class="pagination__link pagination__link--active">
          {{ paginate.meta.current_page }}
        </span>
            </li>
            <li>
                <button
                    v-if="paginate.links.next"
                    class="pagination__link hover:bg-themeLightPrimary"
                    @click="
            load_items(paginate.links.next, paginate.meta.current_page + 1)
          "
                >
                    {{ paginate.meta.current_page + 1 }}
                </button>
            </li>
            <li>
                <button
                    v-if="paginate.links.next"
                    class="pagination__link hover:bg-themeLightPrimary"
                    @click="load_items(paginate.links.last, paginate.meta.last_page)"
                >
                    <vue-feather size="24" type="arrow-left" class="text-white"/>
                </button>
            </li>
        </ul>
    </div>
</template>
<script>
import {defineComponent} from "vue";

export default defineComponent({
    components: {},
    props: {
        paginate: {
            type: Object, default: () => {
            }
        },
        passPageNumber: {
            type: Boolean,
            default: false,
        },
        scrollToTop: {
            type: Boolean,
            default: true,
        },
        scrollTo: {
            type: String,
            default: "",
        },
    },
    emits: ["get_items"],
    data() {
        return {
            scrollToTopTimer: null,
        };
    },
    methods: {
        load_items(url, pageNumber) {
            this.doScrollToTop();
            if (this.passPageNumber) {
                this.$emit("get_items", pageNumber);
            } else {
                this.$emit("get_items", url);
            }
        },
        doScrollToTop() {
            if (!this.scrollToTop) return;
            this.scrollToTopTimer && clearTimeout(this.scrollToTopTimer);
            this.scrollToTopTimer = setTimeout(() => {
                const scrollToElement =
                    this.scrollTo && document.querySelector(this.scrollTo);
                const offsetTop = scrollToElement
                    ? scrollToElement.getBoundingClientRect().top + window.scrollY
                    : 0;

                window.scrollTo({
                    top: offsetTop,
                    behavior: "smooth",
                });
            }, 500);
        },
    },
});
</script>
<style>
.pagination__link {
    padding: 5px !important;
}

</style>
