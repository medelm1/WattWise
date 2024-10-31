import { defineStore } from 'pinia';
import actions from './actions';

export const useSettingsStore = defineStore('settingsStore', {
    state: () => ({
        currency: null,
        energyRate: 0,
        isDarkMode: false,
        // isDark: localStorage.getItem('theme') === 'dark',
    }),
    actions,
});