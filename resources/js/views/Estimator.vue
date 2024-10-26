<script setup>
import { ref } from 'vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Card from 'primevue/card';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import Slider from 'primevue/slider';
import Fieldset from 'primevue/fieldset';
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
    useSettingsStore,
} from '@/stores';
import { notification } from '@/utils';

const applianceStore = useApplianceStore();
const editApplianceDialogStore = useEditApplianceDialogStore();
const createApplianceDialogStore = useCreateApplianceDialogStore();
const confirmationDialogStore = useConfirmationDialogStore();
const settingsDialogStore = useSettingsDialogStore();
const settingsStore = useSettingsStore();

const expandedRows = ref({});

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

async function handleApplianceSaveChanges(appliance) {
    try {
        applianceStore.updateAppliance(
            await applianceService.edit(
                appliance,
                appliance.id,
            )
        );

        notification.success('Appliance saved successfully!');
    
    } catch (error) {
        notification.error(error.message);
    }
}

async function handleApplianceReset(applianceId) {
    try {
        applianceStore.updateAppliance(
            await applianceService.fetch(applianceId)
        );

    } catch (error) {
        notification.error(error.message);
    }
}


</script>
<template>

    <ConfirmationDialog />
    <EditApplianceDialog />
    <CreateApplianceDialog />
    <SettingsDialog />

    <div class="max-w-[1100px] mx-auto">

        <div class="mb-4 flex gap-4">
            <Card class="w-[50%]">
                <template #content>
                    <span class="">Monthly Energy Cost</span>
                    <h3 class="text-[32px] font-medium text-[#E87D1C]">{{ applianceStore.totalMonthlyEnergyCost }} <span class="text-gray-500 font-light">{{ settingsStore.currency?.code }}</span></h3>
                </template>
            </Card>
            <Card class="w-[50%]">
                <template #content>
                    <span>Yearly Energy Cost</span>
                    <h3 class="text-[32px] font-medium text-[#249FA6]">{{ applianceStore.totalYearlyEnergyCost }} <span class="text-gray-500 font-light">{{ settingsStore.currency?.code }}</span></h3>
                </template>
            </Card>
        </div>

        <Card class="mx-auto mb-4">
            <template #content>
                <div class="flex gap-2">
                    <Button label="New Appliance" size="small" icon="pi pi-plus" @click="createApplianceDialogStore.open"></Button>
                    <Button label="Settings" size="small" icon="pi pi-cog" @click="settingsDialogStore.open"></Button>
                </div>
            </template>
        </Card>

        <Card class="mx-auto">
            <template #content>
                <DataTable v-model:expandedRows="expandedRows" :value="applianceStore.appliances" dataKey="id" showGridlines stripedRows >
                    <Column expander class="w-[32px]"></Column>
                    <Column header="Appliance Name">
                        <template #body="slotProps">
                            <div>{{ slotProps.data.name }}</div>
                            <div class="text-sm text-gray-500">
                                {{ `Power: ${slotProps.data.powerRating}W` }} - {{ `Usage: ${slotProps.data.usageHours}h/day` }} - {{ `${slotProps.data.units} unit(s)` }}
                            </div>
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
                    <template #expansion="slotProps">
                        <div class="pb-2">
                            <div class="flex direction-column gap-4">
                                <Fieldset legend="Daily Usage Hours" class="mb-4 grow">
                                    <InputText size="small" v-model.number="slotProps.data.usageHours" class="mb-4 w-full"/>
                                    <Slider v-model="slotProps.data.usageHours" :min="0" :max="24" :step="0.05"/>
                                </Fieldset>
                                <Fieldset legend="Quantity (Units)" class="mb-4 grow">
                                    <InputText size="small" v-model.number="slotProps.data.units" :min="0" :max="100" class="mb-4 w-full" />
                                    <Slider v-model="slotProps.data.units"/>
                                </Fieldset>
                            </div>
                            
                            <div>
                                <Button 
                                    label="Reset" size="small" icon="pi pi-replay" class="me-2"
                                    @click="() => handleApplianceReset(slotProps.data.id)"
                                ></Button>
                                <Button 
                                    label="Save Changes" size="small" icon="pi pi-save"
                                    @click="() => handleApplianceSaveChanges(slotProps.data)"
                                ></Button>
                            </div>
                        </div>
                    </template>
                </DataTable>
            </template>
        </Card>

    </div>

</template>