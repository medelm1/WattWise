import { useSettingsStore } from "../settingsStore";
import _ from 'lodash';

export default {
    // Monthly energy cost for all appliances
    totalMonthlyEnergyCost() {
        const settingsStore = useSettingsStore();
        const totalMonthlyEnergyConsumption = this.appliances.reduce(
            (total, appliance) => total + (appliance.powerRating * appliance.usageHours * appliance.units / 1000) * 30,
            0
        );

        return _.round(totalMonthlyEnergyConsumption * settingsStore.energyRate, 2);
    },

    // Yearly energy cost for all appliances
    totalYearlyEnergyCost() {
        return _.round(this.totalMonthlyEnergyCost * 12, 2);
    }
};
