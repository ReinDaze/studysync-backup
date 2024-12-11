<script setup lang="js">
import MainLayout from '@/Layouts/MainLayout.vue';
import HomeHeroSection from '@/Components/Home/HomeHeroSection.vue';
import HomeFeature from '@/Components/Home/HomeFeature.vue';
import HomeCarousel from '@/Components/Home/HomeCarousel.vue';
</script>

<template>
    <MainLayout>
        <HomeHeroSection />
        <HomeFeature />
        <HomeCarousel />
    </MainLayout>
</template>