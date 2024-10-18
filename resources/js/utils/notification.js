import { useToast, TYPE, POSITION } from 'vue-toastification';

export default function notification(message, type = 'info') {
    const toast = useToast();

    const toastType = (() => {
        switch (type) {
            case 'success':
                return TYPE.SUCCESS;
            case 'error':
                return TYPE.ERROR;
            case 'default':
                return TYPE.DEFAULT;
            case 'warning':
                return TYPE.WARNING;
            default:
                return TYPE.INFO;
        }
    })();

    return toast(message, {
        type: toastType,
        position: POSITION.TOP_CENTER,
        timeout: 30000,
        draggable: true,
        closeOnClick: true,
    });
}

