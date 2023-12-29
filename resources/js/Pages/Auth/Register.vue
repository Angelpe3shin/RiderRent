<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Dropdown from '@/Components/Dropdown.vue';
import { ref } from 'vue';

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    password: '',
    street: '',
    house_number: '',
    zip_code: '',
    city: '',
    country_id: null,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password'),
    });
};

const selectedCountry = ref(null);

const selectCountry = (country) => {
  selectedCountry.value = country;
  form.country_id = country.id
};
</script>

<template>
    <GuestLayout>
        <Head title="Register"/>

        <form @submit.prevent="submit">
            <div class="container">
                <div class="flex items-center justify-center mt-4">
                    <div class="form-group mr-3">
                        <InputLabel for="first_name" value="First Name" />

                        <TextInput
                            id="first_name"
                            type="text"
                            class="mt-1 block w-full"   
                            v-model="form.first_name"
                            required
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.first_name" />
                    </div>
                    <div class="form-group">
                        <InputLabel for="last_name" value="Last Name" />

                        <TextInput
                            id="last_name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.last_name"
                            required
                            autofocus
                            autocomplete="last-name"
                        />

                        <InputError class="mt-2" :message="form.errors.last_name" />
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="email"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="phone" value="Phone" />

                <TextInput
                    id="phone"
                    type="tel"
                    class="mt-1 block w-full"
                    v-model="form.phone"
                    required
                    autocomplete="tel"
                />

                <InputError class="mt-2" :message="form.errors.phone" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="country" value="Country" />

                <Dropdown align="right" width="48">
                    <template #trigger>
                        <span class="inline-flex rounded-md">
                            <button
                                type="button"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                            >
                            <p v-if="selectedCountry">{{ selectedCountry.name }}</p>
                            <p v-else>No country selected</p>

                                <svg
                                    class="ms-2 -me-0.5 h-4 w-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </button>
                        </span>
                    </template>
                    <template #content>
                        <ul class="max-h-40 overflow-y-auto">
                            <li v-for="country in $page.props.info.countries" :key="country.id" @click="selectCountry(country)">
                                {{ country.name }}
                            </li>
                        </ul>
                    </template>
                </Dropdown>

                <InputError class="mt-2" :message="form.errors.country_id" />
            </div>

            <div class="container">
                <div class="flex items-center justify-center mt-4">
                    <div class="form-group w-1/4 mr-3">
                        <div class="mt-4">
                            <InputLabel for="zip_code" value="Zip" />

                            <TextInput
                                id="zip_code"
                                type="text"
                                class="mt-1 inline-block w-full"
                                v-model="form.zip_code"
                                required
                                autocomplete="zip-code"
                            />

                            <InputError class="mt-2" :message="form.errors.zip_code" />
                        </div>
                    </div>
                    <div class="form-group flex-1">
                        <div class="mt-4">
                            <InputLabel for="city" value="City" />

                            <TextInput
                                id="city"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.city"
                                required
                                autocomplete="city"
                            />

                            <InputError class="mt-2" :message="form.errors.city" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="flex items-center justify-center mt-4">
                    <div class="form-group flex-1 mr-3">
                        <div class="mt-4">
                            <InputLabel for="street" value="Street" />

                            <TextInput
                                id="street"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.street"
                                required
                                autocomplete="street"
                            />

                            <InputError class="mt-2" :message="form.errors.street" />
                        </div>
                    </div>
                    <div class="form-group w-1/4">
                        <div class="mt-4">
                            <InputLabel for="house_number" value="House №" />

                            <TextInput
                                id="zip_code"
                                type="text"
                                class="mt-1 inline-block w-full"
                                v-model="form.house_number"
                                required
                                autocomplete="number"
                            />

                            <InputError class="mt-2" :message="form.errors.house_number" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Already registered?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
