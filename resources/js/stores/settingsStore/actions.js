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

            case 'is_dark_mode':
                this.isDarkMode = value;

                document.documentElement.classList.toggle('dark', this.isDarkMode);

                break;

            // Add more cases if you have additional settings to handle
            default:
                console.warn(`Unknown setting key: ${key}`);
        }
    }
};

