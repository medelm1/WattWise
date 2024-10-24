<script setup>
import { onMounted } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Card from 'primevue/card';
import Button from 'primevue/button';
import EditApplianceDialog from '@/dialogs/EditApplianceDialog.vue';
import CreateApplianceDialog from '@/dialogs/CreateApplianceDialog.vue';
import ConfirmationDialog from '@/dialogs/ConfirmationDialog.vue';
import SettingsDialog from '@/dialogs/SettingsDialog.vue';
import { applianceService } from '@/services';
import { 
    useApplianceStore, 
    useEditApplianceDialogStore,
    useCreateApplianceDialogStore,
    useConfirmationDialogStore,
    useSettingsDialogStore,
} from '@/stores';
import { notification } from '@/utils';

const applianceStore = useApplianceStore();
const editApplianceDialogStore = useEditApplianceDialogStore();
const createApplianceDialogStore = useCreateApplianceDialogStore();
const confirmationDialogStore = useConfirmationDialogStore();
const settingsDialogStore = useSettingsDialogStore();

onMounted(async () => {
    try {
        applianceStore.init(
            await applianceService.fetchAll()
        );

    } catch (error) {
        notification(error.message, 'error');
    }
});

function handleDeleteAppliance(applianceId)
{
    confirmationDialogStore.open(async () => {
        try {
            await applianceService.remove(applianceId);

            applianceStore.removeAppliance(applianceId);

            notification.success('Appliance deleted succesfully!');

        } catch (error) {
            notification.error(error.message);
        }
    });
}


</script>
<template>

    <ConfirmationDialog />
    <EditApplianceDialog />
    <CreateApplianceDialog />
    <SettingsDialog /> 

    <Card class="max-w-[800px] mx-auto mb-4">
        <template #content>
            <div class="flex gap-2">
                <Button label="New Appliance" size="small" icon="pi pi-plus" @click="createApplianceDialogStore.open"></Button>
                <Button label="Settings" size="small" icon="pi pi-cog" @click="settingsDialogStore.open"></Button>
            </div>
        </template>
    </Card>

    <Card class="max-w-[800px] mx-auto">
        <template #content>
            <DataTable :value="applianceStore.appliances" showGridlines>
                <Column field="name" header="Appliance Name"></Column>
                <Column field="powerRating" header="Power Rating">
                    <template #body="slotProps">
                        {{ `${slotProps.data.powerRating}W` }}
                    </template>
                </Column>
                <Column field="usageHours" header="Usage Hours">
                    <template #body="slotProps">
                        {{ `${slotProps.data.usageHours}h/day` }}
                    </template>
                </Column>
                <Column header="Actions">
                    <template #body="slotProps">
                        <div class="flex gap-2">
                            <Button 
                                size="small" 
                                icon="pi pi-pencil" 
                                aria-label="Edit" 
                                @click="() => editApplianceDialogStore.open(slotProps.data)"
                            ></Button>
                            <Button 
                                size="small" 
                                icon="pi pi-times" 
                                aria-label="Delete" 
                                @click="() => handleDeleteAppliance(slotProps.data.id)"
                            ></Button>
                        </div>
                    </template>
                </Column>
            </DataTable>
        </template>
    </Card>

</template>