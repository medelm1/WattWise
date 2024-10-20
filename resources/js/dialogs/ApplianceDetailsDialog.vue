<script setup>
import { ref, watch } from 'vue';
import { useApplianceDetailsDialogStore } from '@/stores';

const applianceDetailsDialogStore = useApplianceDetailsDialogStore();

const tab = ref(null);
const appliance = ref(null);

function handleDialogClose()
{
    applianceDetailsDialogStore.close();
}

watch(
    () => applianceDetailsDialogStore.selectedAppliance, 
    (newVal) => {
        if (newVal) {
            appliance.value = newVal;
        }
    }
);

</script>
<template>
    <v-dialog v-model="applianceDetailsDialogStore.isOpen" max-width="500">
        <v-card :title="appliance && appliance.name">
            <v-card-text v-if="appliance">
                <v-tabs v-model="tab" bg-color="orange">
                    <v-tab value="energy-consumption">Energy Consumption</v-tab>
                    <v-tab value="info">Information</v-tab>
                </v-tabs>

                <v-tabs-window v-model="tab">
                    <v-tabs-window-item value="energy-consumption" class="pt-2">
                        <v-table>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-right font-weight-bold">Single Unit</th>
                                    <th class="text-right font-weight-bold">All Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Daily Consumption</td>
                                    <td class="text-right">
                                        {{ `${(appliance.powerRating * appliance.usageHours) / 1000}kWh` }}
                                    </td>
                                    <td class="text-right">
                                        {{ `${(appliance.powerRating * appliance.units * appliance.usageHours) / 1000}kWh` }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Monthly Consumption</td>
                                    <td class="text-right">
                                        {{ `${(appliance.powerRating * appliance.usageHours) * 30 / 1000}kWh` }}
                                    </td>
                                    <td class="text-right">
                                        {{ `${(appliance.powerRating * appliance.units * appliance.usageHours) * 30 / 1000}kWh` }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Yearly Consumption</td>
                                    <td class="text-right">
                                        {{ `${(appliance.powerRating * appliance.usageHours) * 365 / 1000}kWh` }}
                                    </td>
                                    <td class="text-right">
                                        {{ `${(appliance.powerRating * appliance.units * appliance.usageHours) * 365 / 1000}kWh` }}
                                    </td>
                                </tr>
                            </tbody>
                        </v-table>
                    </v-tabs-window-item>
                    <v-tabs-window-item value="info" class="pt-2">
                        <v-table>
                            <tbody>
                                <tr>
                                    <th>Number of units</th>
                                    <td class="text-right">{{ appliance.units }}</td>
                                </tr>
                                <tr>
                                    <td>Power Rating</td>
                                    <td class="text-right">
                                        {{ `${appliance.powerRating}W` }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Energy Category</td>
                                    <td class="text-right">
                                        {{ appliance.energyCategory }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Usage Hours</td>
                                    <td class="text-right">
                                        {{ `${appliance.usageHours}h/day` }}
                                    </td>
                                </tr>
                            </tbody>
                        </v-table>
                    </v-tabs-window-item>
                </v-tabs-window>


            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    text="Close"
                    @click="handleDialogClose"
                ></v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>