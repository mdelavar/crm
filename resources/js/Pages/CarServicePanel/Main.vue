<style>
.c-pattern {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 56 28' width='56' height='28'%3E%3Cpath fill='%23000000' fill-opacity='0.06' d='M56 26v2h-7.75c2.3-1.27 4.94-2 7.75-2zm-26 2a2 2 0 1 0-4 0h-4.09A25.98 25.98 0 0 0 0 16v-2c.67 0 1.34.02 2 .07V14a2 2 0 0 0-2-2v-2a4 4 0 0 1 3.98 3.6 28.09 28.09 0 0 1 2.8-3.86A8 8 0 0 0 0 6V4a9.99 9.99 0 0 1 8.17 4.23c.94-.95 1.96-1.83 3.03-2.63A13.98 13.98 0 0 0 0 0h7.75c2 1.1 3.73 2.63 5.1 4.45 1.12-.72 2.3-1.37 3.53-1.93A20.1 20.1 0 0 0 14.28 0h2.7c.45.56.88 1.14 1.29 1.74 1.3-.48 2.63-.87 4-1.15-.11-.2-.23-.4-.36-.59H26v.07a28.4 28.4 0 0 1 4 0V0h4.09l-.37.59c1.38.28 2.72.67 4.01 1.15.4-.6.84-1.18 1.3-1.74h2.69a20.1 20.1 0 0 0-2.1 2.52c1.23.56 2.41 1.2 3.54 1.93A16.08 16.08 0 0 1 48.25 0H56c-4.58 0-8.65 2.2-11.2 5.6 1.07.8 2.09 1.68 3.03 2.63A9.99 9.99 0 0 1 56 4v2a8 8 0 0 0-6.77 3.74c1.03 1.2 1.97 2.5 2.79 3.86A4 4 0 0 1 56 10v2a2 2 0 0 0-2 2.07 28.4 28.4 0 0 1 2-.07v2c-9.2 0-17.3 4.78-21.91 12H30zM7.75 28H0v-2c2.81 0 5.46.73 7.75 2zM56 20v2c-5.6 0-10.65 2.3-14.28 6h-2.7c4.04-4.89 10.15-8 16.98-8zm-39.03 8h-2.69C10.65 24.3 5.6 22 0 22v-2c6.83 0 12.94 3.11 16.97 8zm15.01-.4a28.09 28.09 0 0 1 2.8-3.86 8 8 0 0 0-13.55 0c1.03 1.2 1.97 2.5 2.79 3.86a4 4 0 0 1 7.96 0zm14.29-11.86c1.3-.48 2.63-.87 4-1.15a25.99 25.99 0 0 0-44.55 0c1.38.28 2.72.67 4.01 1.15a21.98 21.98 0 0 1 36.54 0zm-5.43 2.71c1.13-.72 2.3-1.37 3.54-1.93a19.98 19.98 0 0 0-32.76 0c1.23.56 2.41 1.2 3.54 1.93a15.98 15.98 0 0 1 25.68 0zm-4.67 3.78c.94-.95 1.96-1.83 3.03-2.63a13.98 13.98 0 0 0-22.4 0c1.07.8 2.09 1.68 3.03 2.63a9.99 9.99 0 0 1 16.34 0z'%3E%3C/path%3E%3C/svg%3E");
}
</style>
<template>
    <div>
        <div class="min-h-screen bg-gray-100 pb-6">
            <Head title="ثبت خدمات"></Head>
            <AuthenticatedLayout>
                <template #header>
                    <div class="font-bold text-2xl">
                        پنل اتوسرویس
                    </div>
                </template>
                <div class="md:mx-auto mx-5 max-w-screen-2xl sm:px-6 lg:px-8 pt-12 ">
                    <div
                        class="bg-white rounded-lg shadow grid grid-cols-5 min-h-[45rem] mb-8  md:auto-rows-auto auto-rows-max">
                        <div
                            class="md:col-span-1 relative col-span-5  md:border-l md:border-b-0 border-b border-l-0 md:block flex items-center justify-between border-gray-300 px-6 py-4 text-center">
                            <vue-feather size="54" type="target" class="my-3 mx-auto !hidden"/>
                            <div class="text-center font-bold text-2xl md:my-8">
                                {{ getData('name') }}
                            </div>

                            <div class="-me-2 flex items-center md:hidden">
                                <button
                                    @click="showingNavigationDropdown = !showingNavigationDropdown"
                                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
                                >
                                    <svg
                                        class="h-6 w-6"
                                        stroke="currentColor"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            :class="{hidden: showingNavigationDropdown,'inline-flex':!showingNavigationDropdown,}"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16"
                                        />
                                        <path
                                            :class="{hidden: !showingNavigationDropdown,'inline-flex':showingNavigationDropdown,}"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </div>

                            <div class="hidden md:block">
                                <div v-for="(item , i ) in pages"
                                     class="my-3 bg-indigo-100 text-sm px-3 py-2 items-center rounded cursor-pointer text-right flex"
                                     @click="currentPage=item.link"
                                     :class="{'!bg-indigo-400 text-white' : currentPage === item.link}">
                <span
                    class="ml-2 rounded bg-white text-sm w-[1.5rem] border border-indigo-400 h-[1.5rem] flex justify-center items-center text-black">{{
                        i + 1
                    }}</span>
                                    {{ item.name }}
                                </div>
                            </div>

                            <div class="hidden space-y-3  absolute top-[73px] left-0 p-5 bg-white shadow"
                                 :class="{'max-sm:!block' : showingNavigationDropdown}">
                                <div v-for="(item , i ) in pages"
                                     class=" border border-themeDarkPrimary bg-white text-sm px-3 py-2 items-center rounded cursor-pointer text-right flex"
                                     @click="currentPage=item.link; showingNavigationDropdown = false"
                                     :class="{'!bg-themePrimary text-white' : currentPage === item.link}">
                                    {{ item.name }}
                                </div>
                            </div>

                        </div>
                        <div class="col-span-5 md:col-span-4 p-2">
                            <UseService v-if="currentPage === 'useService'"></UseService>
                        </div>
                    </div>
                </div>
            </AuthenticatedLayout>
        </div>
    </div>
</template>
<script>
import {Head, Link} from "@inertiajs/vue3";
import {defineComponent} from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import UseService from "./UseService/Main.vue"
import auth from "@/auth.js";

export default defineComponent({
    components: {AuthenticatedLayout, PrimaryButton, Head, Link, UseService},
    data() {
        return {
            currentPage: "useService",
            showingNavigationDropdown: false,
            pages: [
                {link: 'useService', name: 'ثبت خدمات'},
            ]
        }
    },
    created() {
        this.checkLogin();
    },
    methods: {
        checkLogin() {
            this.axios
                .post('/auth/check', {}, {})
                .then(({data}) => {
                })
                .catch(function (error) {
                    auth.methods.logout();
                    window.location.reload()
                })
                .finally(() => {
                    this.isSubmitProfile = false;
                });
        },
    }
});
</script>
