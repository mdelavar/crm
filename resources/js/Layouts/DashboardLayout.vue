<script setup>
import {computed, ref} from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import NavLink from '@/Components/NavLink.vue';
import {Link} from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);

const props = defineProps({
    routeName: {
        type: String,
    },
    layoutType: {
        type: String,
        default: "normal",
    }
});

</script>

<template>
    <div
        class="parent-dashboard w-full min-h-screen bg-themeDarkPrimary py-12 md:before:content-[''] md:before:-mt-5 md:before:bg-themeLightPrimary  before:rounded-2xl before:z-10 before:w-11/12 before:right-0 before:left-0 before:mx-auto  before:block before:h-32 before:absolute">
        <div class="min-h-screen bg-themePrimary mx-8 mb-3 rounded-2xl grid grid-cols-12 z-20 relative ">
            <aside
                class="vertical-nav  min-h-screen col-span-2 hidden md:block p-5 text-center ">
                <div class="flex flex-col items-center w-full">
                    <ApplicationLogo class="w-7/12 h-auto bg-white rounded-xl p-2"></ApplicationLogo>
                    <div class="block w-full h-1 border-b my-2 border-dotted border-white"></div>
                    <div class="flex items-center justify-center flex-col">
                        <span class="text-white"> {{ $page.props.auth.user.name }}</span>
                        <Link class="text-sm text-red-400 mt-1  flex items-center" :href="route('logout')"
                              method="post" as="button">
                            خروج
                        </Link>
                    </div>
                    <div class="block w-full h-1 border-b my-2 border-dotted border-white"></div>
                </div>
                <div class="navigation-list">
                    <NavLink v-if="hasPermission('contacts_view')" :href="route('contacts')"
                             :active="routeName === 'contacts'"
                             icon="users">
                        مخاطبین
                    </NavLink>
                    <NavLink v-if="hasPermission('r_category_view')" :href="route('relation_category')"
                             :active="routeName === 'relation_category'"
                             icon="layers">
                        دسته بندی ارتباطات
                    </NavLink>
                    <NavLink v-if="hasPermission('relations_view')" :href="route('relations')"
                             :active="routeName === 'relations'"
                             icon="globe">
                        ارتباطات
                    </NavLink>
                    <NavLink v-if="hasPermission('p_category_view')" :href="route('product_category')"
                             :active="routeName === 'product_category'"
                             icon="layers">
                        دسته بندی محصولات
                    </NavLink>
                    <NavLink v-if="hasPermission('products_view')" :href="route('products')"
                             :active="routeName === 'products'"
                             icon="box">
                        محصولات
                    </NavLink>
                    <NavLink v-if="hasPermission('product_serial_view')" :href="route('product_serials')"
                             :active="routeName === 'product_serials'"
                             icon="list">
                        سریال محصولات
                    </NavLink>
                    <NavLink v-if="hasPermission('representation_view')" :href="route('representations')"
                             :active="routeName === 'representations'"
                             icon="inbox">
                        نمایندگی ها
                    </NavLink>
                    <NavLink v-if="hasPermission('box_view')" :href="route('boxes')" :active="routeName === 'boxes'"
                             icon="folder">
                        کارتن ها
                    </NavLink>
                    <NavLink v-if="hasPermission('organization_view')" :href="route('organizations')"
                             :active="routeName === 'organizations'"
                             icon="target">
                        سازمان ها
                    </NavLink>
                    <NavLink v-if="hasPermission('car_service_view')" :href="route('car_services')"
                             :active="routeName === 'car_services'"
                             icon="tool">
                        اتوسرویس ها
                    </NavLink>

                    <NavLink v-if="hasPermission('services_view')" :href="route('services')"
                             :active="routeName === 'services'"
                             icon="pocket">
                        خدمات
                    </NavLink>
                    <NavLink v-if="hasPermission('users_view')" :href="route('users')" :active="routeName === 'users'"
                             icon="lock">مدیریت
                        کاربران
                    </NavLink>

                </div>
            </aside>
            <div
                class="md:col-span-10 col-span-12 min-h-screen rounded-2xl bg-gray-100">
                <div class="flex relative px-4 py-2 md:hidden  items-center border-b border-gray-400">
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
                    <div class="font-bold mr-6">چاووش صنعت فرتاک</div>

                    <div class="hidden space-y-3 z-50  absolute top-[56px] right-0 p-5 bg-themePrimary shadow"
                         :class="{'max-sm:!block' : showingNavigationDropdown}">
                        <NavLink v-if="hasPermission('contacts_view')" :href="route('contacts')" class="text-sm my-0"
                                 :active="routeName === 'contacts'"
                                 icon="users" size="20">
                            مخاطبین
                        </NavLink>
                        <NavLink v-if="hasPermission('r_category_view')" :href="route('relation_category')" class="text-sm my-0"
                                 :active="routeName === 'relation_category'"
                                 icon="layers" size="20">
                            دسته بندی ارتباطات
                        </NavLink>
                        <NavLink v-if="hasPermission('relations_view')" :href="route('relations')"  class="text-sm my-0"
                                 :active="routeName === 'relations'"
                                 icon="globe" size="20">
                            ارتباطات
                        </NavLink>
                        <NavLink v-if="hasPermission('p_category_view')" :href="route('product_category')" class="text-sm my-0"
                                 :active="routeName === 'product_category'"
                                 icon="layers" size="20">
                            دسته بندی محصولات
                        </NavLink>
                        <NavLink v-if="hasPermission('products_view')" :href="route('products')" class="text-sm my-0"
                                 :active="routeName === 'products'"
                                 icon="box" size="20">
                            محصولات
                        </NavLink>
                        <NavLink v-if="hasPermission('product_serial_view')" :href="route('product_serials')" class="text-sm my-0"
                                 :active="routeName === 'product_serials'"
                                 icon="list" size="20">
                            سریال محصولات
                        </NavLink>
                        <NavLink v-if="hasPermission('representation_view')" :href="route('representations')" class="text-sm my-0"
                                 :active="routeName === 'representations'"
                                 icon="inbox" size="20">
                            نمایندگی ها
                        </NavLink>
                        <NavLink v-if="hasPermission('box_view')" :href="route('boxes')" :active="routeName === 'boxes'" class="text-sm my-0"
                                 icon="folder" size="20">
                            کارتن ها
                        </NavLink>
                        <NavLink v-if="hasPermission('organization_view')" :href="route('organizations')" class="text-sm my-0"
                                 :active="routeName === 'organizations'"
                                 icon="target" size="20">
                            سازمان ها
                        </NavLink>
                        <NavLink v-if="hasPermission('car_service_view')" :href="route('car_services')" class="text-sm my-0"
                                 :active="routeName === 'car_services'"
                                 icon="tool" size="20">
                            اتوسرویس ها
                        </NavLink>

                        <NavLink v-if="hasPermission('services_view')" :href="route('services')" class="text-sm my-0"
                                 :active="routeName === 'services'"
                                 icon="pocket" size="20">
                            خدمات
                        </NavLink>
                        <NavLink v-if="hasPermission('users_view')" :href="route('users')" :active="routeName === 'users'" class="text-sm my-0"
                                 icon="lock" size="20">مدیریت
                            کاربران
                        </NavLink>
                    </div>
                </div>
                <div class="p-5">
                    <slot/>
                </div>
            </div>
        </div>
    </div>
</template>
