<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import ButtonWithLoading from "@/Components/button-with-loading/Main.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="ورود"/>

        <div class="w-full h-screen bg-themePrimary py-10 flex items-center justify-center">
            <div class="bg-white mx-8 rounded-2xl relative shadow-2xl overflow-hidden">
                <div class="py-4 px-16 flex flex-col items-center justify-center">
                        <ApplicationLogo class="w-3/6 m-4"/>
                    <div class="text-themeSecondary text-xl">نرم افزار مدیریت ارتباط با مشتری</div>
                </div>
                <div class="flex items-center justify-center bg-themeGray col-span-7 px-5 py-12 text-center ">
                    <form class="w-10/12" @submit.prevent="submit">
                        <div>
                            <InputLabel for="email" value="ایمیل"/>
                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                            />

                            <InputError class="mt-2" :message="form.errors.email"/>
                        </div>

                        <div class="mt-4">
                            <InputLabel for="password" value="رمز عبور"/>

                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                            />

                            <InputError class="mt-2" :message="form.errors.password"/>
                        </div>


                        <div class="flex items-center mt-8">

                            <ButtonWithLoading class="w-full text-center" :loading="form.processing">
                                ورود
                            </ButtonWithLoading>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>


    </GuestLayout>
</template>
