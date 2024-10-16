<script setup>

import { ref } from 'vue';

const isActive = ref(false);

const electricalDevices = [
  {
    name: 'LED Light Bulb',
    powerRating: 10,
    usageHours: 5
  },
  {
    name: 'Refrigerator',
    powerRating: 150,
    usageHours: 24
  },
  {
    name: 'Air Conditioner',
    powerRating: 2000,
    usageHours: 8
  },
  {
    name: 'Laptop',
    powerRating: 65,
    usageHours: 6 
  },
  {
    name: 'Microwave Oven',
    powerRating: 1200,
    usageHours: 0.5
  },
  {
    name: 'Ceiling Fan',
    powerRating: 70,
    usageHours: 12
  },
  {
    name: 'Washing Machine',
    powerRating: 500,
    usageHours: 1
  },
  {
    name: 'Television',
    powerRating: 100,
    usageHours: 4
  },
  {
    name: 'Electric Kettle',
    powerRating: 1500,
    usageHours: 0.2 
  },
  {
    name: 'Desktop Computer',
    powerRating: 300,
    usageHours: 8
  }
];


</script>
<template>
    <v-card class="pa-4">
        <div class="mb-4">
            <v-dialog max-width="500">
                <template v-slot:activator="{ props: activatorProps }">
                    <v-btn
                        v-bind="activatorProps"
                        color="surface-variant"
                        text="New Device"
                        variant="flat"
                    ></v-btn>
                </template>
                <template v-slot:default="{ isActive }">
                    <v-card title="New device">
                        <v-card-text>
                            <form>
                                <v-text-field
                                    label="Name"
                                    required
                                ></v-text-field>
                            </form>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                text="Close"
                                @click="isActive.value = false"
                            ></v-btn>
                        </v-card-actions>
                    </v-card>
                </template>
            </v-dialog>
        </div>
        <v-table>
            <thead>
                <tr>
                    <th class="text-left">Name</th>
                    <th>Power Rating</th>
                    <th>Usage Hours</th>
                    <th class="text-right">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="device in electricalDevices" :key="device.name">
                    <td>{{ device.name }}</td>
                    <td>{{ `${device.powerRating}W` }}</td>
                    <td>{{ `${device.usageHours}h/day` }}</td>
                    <td class="text-right">
                        <v-btn variant="flat" size="small" color="surface-variant" class="me-2">Edit</v-btn>
                        <v-btn variant="flat" size="small" color="surface-variant">Delete</v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>
    </v-card>

</template>