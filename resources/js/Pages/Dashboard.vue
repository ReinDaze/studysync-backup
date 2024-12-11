<template>
    <AuthenticatedLayout>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-8">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6">Daftar Soal</h2>

            <!-- Tombol untuk menambah soal -->
            <div class="mb-6">
                <Link
                    href="/soal/add"
                    class="inline-block bg-green-600 text-white py-2 px-6 rounded-md shadow-md hover:bg-green-700 transition"
                >
                    Tambah Soal
                </Link>
            </div>

            <!-- Daftar soal -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    v-for="soal in $page.props.soals"
                    :key="soal.id"
                    class="bg-white p-5 border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition"
                >
                    <p class="font-semibold text-lg text-gray-900 mb-2">{{ soal.soal }}</p>

                    <ul class="list-disc ml-6 text-gray-700">
                        <li>
                            <span class="font-medium">Jawaban 1:</span> {{ soal.jawaban_1 }}
                            - <span class="font-medium">Gaya Belajar:</span> {{ soal.gaya_belajar_1 }}
                            - <span class="font-medium">Nilai:</span> {{ soal.nilai_jawaban_1 }}
                        </li>
                        <li>
                            <span class="font-medium">Jawaban 2:</span> {{ soal.jawaban_2 }}
                            - <span class="font-medium">Gaya Belajar:</span> {{ soal.gaya_belajar_2 }}
                            - <span class="font-medium">Nilai:</span> {{ soal.nilai_jawaban_2 }}
                        </li>
                        <li>
                            <span class="font-medium">Jawaban 3:</span> {{ soal.jawaban_3 }}
                            - <span class="font-medium">Gaya Belajar:</span> {{ soal.gaya_belajar_3 }}
                            - <span class="font-medium">Nilai:</span> {{ soal.nilai_jawaban_3 }}
                        </li>
                    </ul>

                    <!-- Tombol aksi -->
                    <div class="mt-4 flex gap-3">
                        <button
                            @click="handleDelete(soal.id)"
                            class="bg-red-600 text-white py-1 px-4 rounded-md shadow-md hover:bg-red-700 transition"
                        >
                            Hapus
                        </button>
                        <Link
                            :href="`/soal/${soal.id}/edit`"
                            class="bg-blue-600 text-white py-1 px-4 rounded-md shadow-md hover:bg-blue-700 transition"
                        >
                            Edit
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const handleDelete = (id) => {
    if (confirm('Apakah Anda yakin ingin menghapus soal ini?')) {
        Inertia.delete(`/soal/${id}`, {
            onSuccess: () => {
                // Menampilkan notifikasi atau melakukan tindakan lain setelah berhasil dihapus
                alert('Soal berhasil dihapus');
            },
        });
    }
};
</script>
