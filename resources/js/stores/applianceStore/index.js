import { defineStore } from 'pinia';
import actions from './actions';

export const useApplianceStore = defineStore('applianceStore', {
    state: () => ({
        appliances: [],
    }),
    actions,
});