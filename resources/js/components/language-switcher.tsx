import React from 'react';
import { router, usePage } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { Globe } from 'lucide-react';
import type { SharedData } from '@/types';

const languages = [
    { code: 'en', name: 'English', flag: '🇺🇸' },
    { code: 'id', name: 'Indonesia', flag: '🇮🇩' },
];

export function LanguageSwitcher() {
    const { locale } = usePage<SharedData>().props;

    const currentLanguage = languages.find(lang => lang.code === locale) || languages[0];

    const switchLanguage = (langCode: string) => {
        const url = new URL(window.location.href);
        url.searchParams.set('lang', langCode);
        router.get(url.toString(), {}, {
            preserveState: false,
            preserveScroll: true,
        });
    };

    return (
        <DropdownMenu>
            <DropdownMenuTrigger asChild>
                <Button variant="ghost" size="sm" className="gap-2">
                    <Globe className="h-4 w-4" />
                    <span className="hidden sm:inline">{currentLanguage.flag}</span>
                    <span className="hidden md:inline">{currentLanguage.name}</span>
                </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent align="end" className="min-w-[150px]">
                {languages.map((language) => (
                    <DropdownMenuItem
                        key={language.code}
                        onClick={() => switchLanguage(language.code)}
                        className={`flex items-center gap-2 ${
                            locale === language.code ? 'bg-accent' : ''
                        }`}
                    >
                        <span>{language.flag}</span>
                        <span>{language.name}</span>
                        {locale === language.code && (
                            <span className="ml-auto text-xs text-muted-foreground">✓</span>
                        )}
                    </DropdownMenuItem>
                ))}
            </DropdownMenuContent>
        </DropdownMenu>
    );
}