export default {
    // Initialize settings
    init(settings = []) {
        settings.forEach(({ key, value }) => {
            this.updateSetting(key, value);
        });
    },

    // Action to update individual settings
    updateSetting(key, value) {
        switch (key) {
            case 'currency':
                this.currency = value;
                break;

            case 'energy_rate':
                this.energyRate = value;
                break;

            // Add more cases if you have additional settings to handle
            default:
                console.warn(`Unknown setting key: ${key}`);
        }
    },
};

