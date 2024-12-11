<script setup>
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const form = useForm({
    soal: "",
    jawaban_1: "",
    jawaban_2: "",
    jawaban_3: "",
    gaya_belajar_1: "",
    gaya_belajar_2: "",
    gaya_belajar_3: "",
    nilai_jawaban_1: "1",
    nilai_jawaban_2: "1",
    nilai_jawaban_3: "1",
});

const submit = () => {
    form.post(route("soal.store"), {
        onFinish: () => form.reset(), // Reset form after submission
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                Tambah Soal
            </h2>

            <!-- Form untuk menambah soal -->
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="soal" value="Soal" />
                    <TextInput
                        id="soal"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.soal"
                        required
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.soal" />
                </div>

                <div class="mt-4">
                    <InputLabel for="jawaban_1" value="Jawaban 1" />
                    <TextInput
                        id="jawaban_1"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.jawaban_1"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.jawaban_1" />
                </div>

                <div class="mt-4">
                    <InputLabel
                        for="gaya_belajar_1"
                        value="Gaya Belajar Jawaban 1"
                    />
                    <select
                        id="gaya_belajar_1"
                        class="mt-1 block w-full"
                        v-model="form.gaya_belajar_1"
                        required
                    >
                        <option value="">Pilih Gaya Belajar</option>
                        <option value="Kinestetik">Kinestetik</option>
                        <option value="Visual">Visual</option>
                        <option value="Auditori">Auditori</option>
                    </select>
                    <InputError
                        class="mt-2"
                        :message="form.errors.gaya_belajar_1"
                    />
                </div>

                <div class="mt-4">
                    <InputLabel for="nilai_jawaban_1" value="Nilai Jawaban 1" />
                    <TextInput
                        id="nilai_jawaban_1"
                        type="number"
                        class="mt-1 block w-full bg-gray-200"
                        v-model="form.nilai_jawaban_1"
                        required
                        disabled
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.nilai_jawaban_1"
                    />
                </div>

                <div class="mt-4">
                    <InputLabel for="jawaban_2" value="Jawaban 2" />
                    <TextInput
                        id="jawaban_2"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.jawaban_2"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.jawaban_2" />
                </div>

                <div class="mt-4">
                    <InputLabel
                        for="gaya_belajar_2"
                        value="Gaya Belajar Jawaban 2"
                    />
                    <select
                        id="gaya_belajar_2"
                        class="mt-1 block w-full"
                        v-model="form.gaya_belajar_2"
                        required
                    >
                        <option value="">Pilih Gaya Belajar</option>
                        <option value="Kinestetik">Kinestetik</option>
                        <option value="Visual">Visual</option>
                        <option value="Auditori">Auditori</option>
                    </select>
                    <InputError
                        class="mt-2"
                        :message="form.errors.gaya_belajar_2"
                    />
                </div>

                <div class="mt-4">
                    <InputLabel for="nilai_jawaban_2" value="Nilai Jawaban 2" />
                    <TextInput
                        id="nilai_jawaban_2"
                        type="number"
                        class="mt-1 block w-full bg-gray-200"
                        v-model="form.nilai_jawaban_2"
                        required
                        disabled
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.nilai_jawaban_2"
                    />
                </div>

                <div class="mt-4">
                    <InputLabel for="jawaban_3" value="Jawaban 3" />
                    <TextInput
                        id="jawaban_3"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.jawaban_3"
                        required
                    />
                    <InputError class="mt-2" :message="form.errors.jawaban_3" />
                </div>

                <div class="mt-4">
                    <InputLabel
                        for="gaya_belajar_3"
                        value="Gaya Belajar Jawaban 3"
                    />
                    <select
                        id="gaya_belajar_3"
                        class="mt-1 block w-full"
                        v-model="form.gaya_belajar_3"
                        required
                    >
                        <option value="">Pilih Gaya Belajar</option>
                        <option value="Kinestetik">Kinestetik</option>
                        <option value="Visual">Visual</option>
                        <option value="Auditori">Auditori</option>
                    </select>
                    <InputError
                        class="mt-2"
                        :message="form.errors.gaya_belajar_3"
                    />
                </div>

                <div class="mt-4">
                    <InputLabel for="nilai_jawaban_3" value="Nilai Jawaban 3" />
                    <TextInput
                        id="nilai_jawaban_3"
                        type="number"
                        class="mt-1 block w-full bg-gray-200"
                        v-model="form.nilai_jawaban_3"
                        required
                        disabled
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.nilai_jawaban_3"
                    />
                </div>

                <div class="mt-4 flex items-center justify-end">
                    <PrimaryButton
                        class="ms-4"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Tambah Soal
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
