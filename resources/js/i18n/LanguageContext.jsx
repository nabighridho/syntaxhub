import { createContext, useContext, useState, useEffect } from 'react';
import translations from './translations';

const LanguageContext = createContext();

export function LanguageProvider({ children }) {
    const [lang, setLang] = useState('en');

    useEffect(() => {
        // Load language from storage on mount
        const storedLang = localStorage.getItem('sh_language');
        if (storedLang && ['en', 'id'].includes(storedLang)) {
            setLang(storedLang);
        } else {
            // Check browser language
            const browserLang = navigator.language.split('-')[0];
            const defaultLang = ['en', 'id'].includes(browserLang) ? browserLang : 'en';
            setLang(defaultLang);
            localStorage.setItem('sh_language', defaultLang);
        }
    }, []);

    const toggleLanguage = () => {
        const newLang = lang === 'en' ? 'id' : 'en';
        setLang(newLang);
        localStorage.setItem('sh_language', newLang);
    };

    const t = (key) => {
        const keys = key.split('.');
        let value = translations[lang];
        for (const k of keys) {
            if (value && value[k]) {
                value = value[k];
            } else {
                return key; // Fallback to key if not found
            }
        }
        return value;
    };

    return (
        <LanguageContext.Provider value={{ lang, toggleLanguage, t }}>
            {children}
        </LanguageContext.Provider>
    );
}

export function useLanguage() {
    const context = useContext(LanguageContext);
    if (!context) {
        throw new Error('useLanguage must be used within a LanguageProvider');
    }
    return context;
}
