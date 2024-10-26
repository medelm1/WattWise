import { defineStore } from 'pinia';
import actions from './actions';

export const useSettingsStore = defineStore('settingsStore', {
    state: () => ({
        currency: null,
        energyRate: 0,
    }),
    actions,
});