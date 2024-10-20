<script setup>
import { onMounted } from 'vue';
import EditApplianceDialog from '@/dialogs/EditApplianceDialog.vue';
import CreateApplianceDialog from '@/dialogs/CreateApplianceDialog.vue';
import { applianceService } from '@/services';
import { 
    useApplianceStore, 
    useEditApplianceDialogStore,
    useCreateApplianceDialogStore,
} from '@/stores';
import { notification } from '@/utils';

const applianceStore = useApplianceStore();
const editApplianceDialogStore = useEditApplianceDialogStore();
const createApplianceDialogStore = useCreateApplianceDialogStore();

onMounted(async () => {
    try {
        applianceStore.init(
            await applianceService.fetchAll()
        );

    } catch (error) {
        notification(error.message, 'error');
    }
});

async function handleDeleteAppliance(applianceId)
{
    try {
        await applianceService.remove(applianceId);

        applianceStore.removeAppliance(applianceId);

        notification('Appliance deleted succesfully!', 'success');

    } catch (error) {
        notification(error.message, 'error');
    }
}

</script>
<template>

    <EditApplianceDialog />
    <CreateApplianceDialog />

    <v-card class="pa-4">
        <div class="mb-4">
            <v-btn
                color="surface-variant"
                text="New Appliance"
                variant="flat"
                @click="createApplianceDialogStore.open"
            ></v-btn>
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
                <tr v-for="appliance in applianceStore.appliances" :key="appliance.id">
                    <td>{{ `${appliance.name} (${appliance.units})` }}</td>
                    <td>{{ `${appliance.powerRating}W` }}</td>
                    <td>{{ `${appliance.usageHours}h/day` }}</td>
                    <td>{{ `${(appliance.powerRating * appliance.usageHours) / 1000}kWh` }}</td>
                    <td>{{ `${(appliance.powerRating * appliance.usageHours) * 30 / 1000}kWh` }}</td>
                    <td class="text-right">
                        <v-btn 
                            variant="flat" size="small" color="surface-variant" class="ml-1"
                            @click="() => editApplianceDialogStore.open(appliance)"
                        >Edit</v-btn>
                        <v-btn 
                            variant="flat" size="small" color="surface-variant" class="ml-1"
                            @click="() => handleDeleteAppliance(appliance.id)"
                        >Delete</v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>
    </v-card>

</template>