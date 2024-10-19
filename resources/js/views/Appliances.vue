<script setup>
import { ref, onMounted } from 'vue';
import ApplianceCreateDialog from '@/dialogs/appliance/CreateDialog.vue';
import { applianceService } from '@/services';
import { notification } from '@/utils';

const appliances = ref([]);

onMounted(async () => {
    try {
        appliances.value = await applianceService.fetchAll();

        console.log(appliances.value);

    } catch (error) {
        notification(error.message, 'error');
    }
});

</script>
<template>
<v-card class="pa-4">
    <div class="mb-4">
        <ApplianceCreateDialog />
    </div>
    <v-table>
        <thead>
            <tr>
                <th class="text-left">Name</th>
                <th>Power Rating</th>
                <th>Usage Hours</th>
                <th>Daily Consumption</th>
                <th>Monthly Consumption</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="appliance in appliances" :key="appliance.id">
                <td>{{ appliance.deviceName }}</td>
                <td>{{ `${appliance.powerRating}W` }}</td>
                <td>{{ `${appliance.usageHours}h/day` }}</td>
                <td>{{ `${(appliance.powerRating * appliance.usageHours) / 1000}kWh` }}</td>
                <td>{{ `${(appliance.powerRating * appliance.usageHours) * 30 / 1000}kWh` }}</td>
                <td class="text-right">
                    <v-btn variant="flat" size="small" color="surface-variant" class="me-2">Edit</v-btn>
                    <v-btn variant="flat" size="small" color="surface-variant">Delete</v-btn>
                </td>
            </tr>
        </tbody>
    </v-table>
</v-card>

</template>