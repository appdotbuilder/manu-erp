import { usePage } from '@inertiajs/react';
import type { SharedData } from '@/types';

export function useTranslation() {
    const { translations } = usePage<SharedData>().props;

    const t = (key: string, fallback?: string): string => {
        return translations[key] || fallback || key;
    };

    return { t };
}