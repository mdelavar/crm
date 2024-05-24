<script setup>
import {computed, ref} from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import NavLink from '@/Components/NavLink.vue';
import {Link} from '@inertiajs/vue3';
import Card from "@/Components/Card.vue";

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
        class="parent-dashboard w-full min-h-screen bg-themeDarkPrimary py-12 before:content-[''] before:-mt-5 before:bg-themeLightPrimary  before:rounded-2xl before:z-10 before:w-11/12 before:right-0 before:left-0 before:mx-auto  before:block before:h-32 before:absolute">
        <div class="min-h-screen bg-themePrimary mx-8 mb-3 rounded-2xl grid grid-cols-12 z-20 relative ">
            <aside :class="{'hidden' : layoutType === 'fullscreen'}"
                   class="vertical-nav  min-h-screen col-span-2 p-5 text-center ">
                <div class="flex flex-col items-center w-full">
                    <ApplicationLogo class="w-5/12 h-auto"></ApplicationLogo>
                    <div class="block w-full h-1 border-b my-2 border-dotted border-green-600"></div>
                    <div class="flex items-center justify-center flex-col">
                        <span class="text-yellow-400"> {{ $page.props.auth.user.name }}</span>
                        <Link class="text-sm text-red-500 flex items-center" :href="route('logout')"
                              method="post" as="button">
                            خروج
                        </Link>
                    </div>
                    <div class="block w-full h-1 border-b my-2 border-dotted border-green-600"></div>
                </div>
                <div class="navigation-list">
                    <NavLink v-if="hasPermission('contacts_view')" :href="route('contacts')" :active="routeName === 'contacts'"
                             icon="users">
                        مخاطبین
                    </NavLink>
                    <NavLink v-if="hasPermission('r_category_view')" :href="route('relation_category')" :active="routeName === 'relation_category'"
                             icon="layers">
                        دسته بندی ارتباطات
                    </NavLink>
                    <NavLink v-if="hasPermission('relations_view')" :href="route('relations')" :active="routeName === 'relations'"
                             icon="globe">
                        ارتباطات
                    </NavLink>
                    <NavLink v-if="hasPermission('p_category_view')" :href="route('product_category')" :active="routeName === 'product_category'"
                             icon="layers">
                        دسته بندی محصولات
                    </NavLink>
                    <NavLink v-if="hasPermission('products_view')" :href="route('products')" :active="routeName === 'products'"
                             icon="box">
                        محصولات
                    </NavLink>
                    <NavLink v-if="hasPermission('product_serial_view')" :href="route('product_serials')" :active="routeName === 'product_serials'"
                             icon="list">
                        سریال محصولات
                    </NavLink>
                    <NavLink v-if="hasPermission('users_view')" :href="route('users')" :active="routeName === 'users'"
                             icon="lock">مدیریت
                        کاربران
                    </NavLink>

                </div>
            </aside>
            <div :class="[layoutType === 'fullscreen' ? 'col-span-12' : 'col-span-10']"
                 class="min-h-screen rounded-2xl bg-gray-100">
                <div class="p-5">
                    <slot/>
                </div>
            </div>
        </div>
    </div>
</template>
