<script setup>
import SidebarLayout from '@/Layouts/SidebarLayout.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />

    <SidebarLayout>
        <template #header>
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white p-6 rounded-lg shadow-md">
                <h2 class="text-3xl font-semibold leading-tight">
                    Profile
                </h2>
                <p class="mt-2 text-lg font-light">
                    Update your personal information and manage your account.
                </p>
            </div>
        </template>

        <div class="py-12 bg-gray-100">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="space-y-8">
                    <!-- Profile Update Form -->
                    <div class="bg-white p-8 shadow-lg rounded-lg border border-gray-200">
                        <UpdateProfileInformationForm
                            :must-verify-email="mustVerifyEmail"
                            :status="status"
                            class="max-w-2xl mx-auto"
                        />
                    </div>

                    <!-- Delete User Form -->
                    <div class="bg-white p-8 shadow-lg rounded-lg border border-gray-200">
                        <DeleteUserForm class="max-w-2xl mx-auto" />
                    </div>
                </div>
            </div>
        </div>
    </SidebarLayout>
</template>
