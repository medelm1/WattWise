<script setup>
import { ref } from 'vue';
import { useTabStore } from '@/stores/tabStore';
import Settings from '@/views/Settings.vue';
import Estimator from '@/views/Estimator.vue';

const tabStore = useTabStore();

</script>

<template>
  <v-card class="ma-4">
    <v-tabs
      v-model="tabStore.activeTab"
      align-tabs="center"
      bg-color="orange"
      stacked
    >
      <v-tab value="estimator-tab">
        <v-icon icon="mdi-lightning-bolt"></v-icon>
        Estimator
      </v-tab>

      <v-tab value="settings-tab">
        <v-icon icon="mdi-cog"></v-icon>
        Settings
      </v-tab>
    </v-tabs>

    <v-tabs-window v-model="tabStore.activeTab">
      <v-tabs-window-item value="estimator-tab">
        <Estimator />
      </v-tabs-window-item>
      <v-tabs-window-item value="settings-tab">
        <Settings />
      </v-tabs-window-item>
    </v-tabs-window>
  </v-card>
</template>