<script setup>
import { ref, onMounted } from 'vue';
import DeviceCreateDialog from '@/dialogs/device/CreateDialog.vue';
import { deviceService } from '@/services';
import { notification } from '@/utils';

const devices = ref([]);

onMounted(async () => {
    try {
        devices.value = await deviceService.fetchAll();
    } catch (error) {
        notification(error.message, 'error');
    }
});

</script>
<template>
<v-card class="pa-4">
    <div class="mb-4">
        <DeviceCreateDialog />
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
            <tr v-for="device in devices" :key="device.id">
                <td>{{ device.deviceName }}</td>
                <td>{{ `${device.powerRating}W` }}</td>
                <td>{{ `${device.usageHours}h/day` }}</td>
                <td>{{ `${(device.powerRating * device.usageHours) / 1000}kWh` }}</td>
                <td>{{ `${(device.powerRating * device.usageHours) * 30 / 1000}kWh` }}</td>
                <td class="text-right">
                    <v-btn variant="flat" size="small" color="surface-variant" class="me-2">Edit</v-btn>
                    <v-btn variant="flat" size="small" color="surface-variant">Delete</v-btn>
                </td>
            </tr>
        </tbody>
    </v-table>
</v-card>

</template>