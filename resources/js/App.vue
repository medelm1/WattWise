<script setup>
import { ref, onMounted } from "vue";
import Estimator from "@/views/Estimator.vue";
import { useSettingsStore, useApplianceStore } from "./stores";
import { settingsService, applianceService } from '@/services';

const settingsStore = useSettingsStore();
const applianceStore = useApplianceStore();

onMounted(async () => {

    try {

        // Load settings
        settingsStore.init(
            await settingsService.fetchAll()
        );

        // Load appliances
        applianceStore.init(
            await applianceService.fetchAll()
        );

    } catch (error) {
        console.error(error);
    }

});

</script>

<template>
    <div class="p-4 dark:bg-[#000] h-screen" >
        <Estimator />
    </div>
</template>
