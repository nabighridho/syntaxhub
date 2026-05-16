import { useState, useEffect } from 'react';
import { Link, usePage } from '@inertiajs/react';
import { motion, AnimatePresence } from 'framer-motion';
import {
    HiOutlineHome, HiOutlineAcademicCap, HiOutlineCode, HiOutlineBeaker,
    HiOutlineChartBar, HiOutlineBookmark, HiOutlineUser, HiOutlineCog,
    HiOutlineMenu, HiOutlineX, HiOutlineLogout, HiOutlineChevronDown,
} from 'react-icons/hi';
import { useLanguage } from '@/i18n/LanguageContext';

const mainNav = [
    { name: 'Dashboard', href: '/dashboard', icon: HiOutlineHome, routeName: 'dashboard' },
    { name: 'Tutorials', href: '/tutorials', icon: HiOutlineAcademicCap, routeName: 'tutorials' },
    { name: 'Snippets', href: '/snippets', icon: HiOutlineCode, routeName: 'snippets' },
    { name: 'Playground', href: '/playground', icon: HiOutlineBeaker, routeName: 'playground' },
    { name: 'Progress', href: '/progress', icon: HiOutlineChartBar, routeName: 'progress' },
];

function isActive(routeName, currentRoute) {
    return currentRoute.startsWith(routeName);
}

export default function AppLayout({ children, title }) {
    const user = usePage().props.auth.user;
    const { url } = usePage();
    const [scrolled, setScrolled] = useState(false);
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
    const [profileOpen, setProfileOpen] = useState(false);
    const { lang, toggleLanguage, t } = useLanguage();
    const currentRoute = route().current() || '';

    useEffect(() => {
        const handler = () => setScrolled(window.scrollY > 10);
        window.addEventListener('scroll', handler);
        return () => window.removeEventListener('scroll', handler);
    }, []);

    // Close profile dropdown on outside click
    useEffect(() => {
        if (!profileOpen) return;
        const handler = () => setProfileOpen(false);
        document.addEventListener('click', handler);
        return () => document.removeEventListener('click', handler);
    }, [profileOpen]);

    // Handle mouse tracking for glow effects
    useEffect(() => {
        const handleMouseMove = (e) => {
            const cards = document.querySelectorAll('.bento-card');
            cards.forEach(card => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                card.style.setProperty('--mouse-x', `${x}px`);
                card.style.setProperty('--mouse-y', `${y}px`);
            });
        };
        window.addEventListener('mousemove', handleMouseMove);
        return () => window.removeEventListener('mousemove', handleMouseMove);
    }, []);

    return (
        <div className="min-h-screen relative overflow-hidden bg-[#0a0a0b] text-white">
            <div className="noise-bg"></div>
            
            {/* Ambient Background Glows */}
            <div className="glow-orb top-[-20%] left-[-10%] bg-blue-500/10 mix-blend-screen"></div>
            <div className="glow-orb bottom-[-20%] right-[-10%] bg-purple-500/10 mix-blend-screen"></div>

            {/* ===== FLOATING NAVBAR ===== */}
            <header className={`fixed top-0 left-0 w-full z-50 transition-all duration-500 p-4 sm:p-6 pb-0 pointer-events-none`}>
                <div className={`max-w-6xl mx-auto flex items-center justify-between pointer-events-auto rounded-[24px] px-6 h-16 transition-all duration-500 ${
                    scrolled 
                        ? 'bg-[#121214]/80 backdrop-blur-3xl border border-white/10 shadow-2xl' 
                        : 'bg-transparent border border-transparent'
                }`}>
                    {/* Logo */}
                    <Link href="/dashboard" className="flex items-center gap-3 shrink-0 group">
                        <img src="/logo.png" alt="Syntaxhub Logo" className="w-9 h-9 object-contain shrink-0 filter drop-shadow-[0_0_15px_rgba(255,255,255,0.2)] mix-blend-screen" />
                        <span className="font-bold text-white text-lg tracking-tight hidden sm:block">
                            Syntaxhub.
                        </span>
                    </Link>

                    {/* Desktop Nav */}
                    <nav className="hidden md:flex items-center gap-1.5 absolute left-1/2 -translate-x-1/2">
                        {mainNav.map((item) => {
                            const active = isActive(item.routeName, currentRoute);
                            return (
                                <Link
                                    key={item.name}
                                    href={item.href}
                                    className={`relative flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[13px] font-medium transition-colors ${
                                        active
                                            ? 'text-white'
                                            : 'text-white/40 hover:text-white/80'
                                    }`}
                                >
                                    {active && (
                                        <motion.div
                                            layoutId="navTab"
                                            className="absolute inset-0 bg-white/5 border border-white/10 rounded-full"
                                            transition={{ type: 'spring', stiffness: 500, damping: 30 }}
                                        />
                                    )}
                                    <span className="relative z-10 hidden lg:block">{t(`nav.${item.name.toLowerCase()}`)}</span>
                                    {/* Show only icon on smaller desktop, or if not active */}
                                    {!active && <item.icon className="w-4 h-4 relative z-10 lg:hidden" />}
                                    {active && <item.icon className="w-4 h-4 relative z-10 lg:hidden text-white" />}
                                </Link>
                            );
                        })}
                    </nav>

                    {/* Right Side */}
                    <div className="flex items-center gap-3">
                        <Link
                            href="/bookmarks"
                            className="hidden sm:flex items-center justify-center w-10 h-10 rounded-full bg-white/5 border border-white/5 hover:border-white/20 hover:bg-white/10 transition-all text-white/70 hover:text-white"
                        >
                            <HiOutlineBookmark className="w-4 h-4" />
                        </Link>

                        <button onClick={toggleLanguage} className="p-2 sm:px-3 sm:py-1.5 rounded-full border border-white/10 text-white/60 hover:text-white hover:bg-white/5 transition-colors uppercase text-[10px] tracking-widest font-bold">
                            {lang === 'en' ? 'EN' : 'ID'}
                        </button>
                            
                        {/* Profile Dropdown */}
                        <div className="relative">
                            <button
                                onClick={(e) => { e.stopPropagation(); setProfileOpen(!profileOpen); }}
                                className="flex items-center gap-3 pl-1 pr-3 py-1 bg-white/5 border border-white/5 rounded-full hover:bg-white/10 transition-all"
                            >
                                <div className="w-8 h-8 rounded-full bg-white text-black flex items-center justify-center text-[13px] font-bold">
                                    {user.name.charAt(0).toUpperCase()}
                                </div>
                                <span className="hidden lg:block text-[13px] font-medium text-white/80 max-w-[100px] truncate">
                                    {user.name}
                                </span>
                            </button>

                            <AnimatePresence>
                                {profileOpen && (
                                    <motion.div
                                        initial={{ opacity: 0, y: 10, scale: 0.95 }}
                                        animate={{ opacity: 1, y: 0, scale: 1 }}
                                        exit={{ opacity: 0, y: 10, scale: 0.95 }}
                                        transition={{ duration: 0.2, ease: [0.16, 1, 0.3, 1] }}
                                        className="absolute right-0 mt-3 w-56 bg-[#18181b] backdrop-blur-3xl rounded-[20px] border border-white/10 shadow-2xl overflow-hidden"
                                    >
                                        <div className="px-4 py-3 border-b border-white/5">
                                            <p className="text-[13px] font-semibold text-white/90 truncate">{user.name}</p>
                                            <p className="text-[11px] text-white/40 truncate">{user.email}</p>
                                        </div>
                                        <div className="p-1.5">
                                            <Link href={route('profile.edit')} className="block px-4 py-3 text-[13px] font-medium text-white/70 hover:text-white hover:bg-white/5 border-b border-white/5 transition-colors">
                                                {t('nav.profile')}
                                            </Link>
                                            <Link href={route('profile.edit')} className="block px-4 py-3 text-[13px] font-medium text-white/70 hover:text-white hover:bg-white/5 border-b border-white/5 transition-colors">
                                                {t('nav.settings')}
                                            </Link>
                                            <Link href={route('logout')} method="post" as="button" className="block w-full text-left px-4 py-3 text-[13px] font-medium text-red-400 hover:text-red-300 hover:bg-white/5 transition-colors">
                                                {t('nav.logout')}
                                            </Link>
                                        </div>
                                    </motion.div>
                                )}
                            </AnimatePresence>
                        </div>

                        {/* Mobile hamburger */}
                        <button
                            onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
                            className="md:hidden w-10 h-10 flex items-center justify-center rounded-full bg-white/5 border border-white/5 text-white/70"
                        >
                            {mobileMenuOpen ? <HiOutlineX className="w-5 h-5" /> : <HiOutlineMenu className="w-5 h-5" />}
                        </button>
                    </div>
                </div>

                {/* Mobile Nav Overlay */}
                <AnimatePresence>
                    {mobileMenuOpen && (
                        <motion.div
                            initial={{ opacity: 0, y: -20 }}
                            animate={{ opacity: 1, y: 0 }}
                            exit={{ opacity: 0, y: -20 }}
                            className="absolute top-[80px] left-4 right-4 bg-[#121214]/95 backdrop-blur-3xl border border-white/10 rounded-[24px] overflow-hidden shadow-2xl md:hidden pointer-events-auto"
                        >
                            <div className="p-2 space-y-1">
                                {mainNav.map((item) => {
                                    const active = isActive(item.routeName, currentRoute);
                                    return (
                                        <Link
                                            key={item.name}
                                            href={item.href}
                                            onClick={() => setMobileMenuOpen(false)}
                                            className={`flex items-center gap-3 px-4 py-3 rounded-xl text-[14px] font-medium transition-colors ${
                                                active ? 'bg-white/10 text-white' : 'text-white/60 hover:bg-white/5'
                                            }`}
                                        >
                                            <item.icon className="w-4 h-4 mr-2" />
                                            {t(`nav.${item.name.toLowerCase()}`)}
                                        </Link>
                                    );
                                })}
                            </div>
                        </motion.div>
                    )}
                </AnimatePresence>
            </header>

            {/* ===== PAGE CONTENT ===== */}
            <main className="max-w-6xl mx-auto px-4 sm:px-6 pt-32 pb-16 min-h-screen flex flex-col relative z-10">
                {title && (
                    <motion.div
                        initial={{ opacity: 0, filter: 'blur(10px)' }}
                        animate={{ opacity: 1, filter: 'blur(0px)' }}
                        transition={{ duration: 0.8, ease: [0.16, 1, 0.3, 1] }}
                        className="mb-8"
                    >
                        <h1 className="text-3xl font-bold tracking-tight text-white glow-text">{title}</h1>
                    </motion.div>
                )}
                <motion.div
                    initial={{ opacity: 0, y: 30 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ duration: 0.8, ease: [0.16, 1, 0.3, 1], delay: 0.1 }}
                    className="flex-1"
                >
                    {children}
                </motion.div>

                {/* ===== FOOTER ===== */}
                <footer className="mt-20 pt-8 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p className="text-[12px] text-white/30 uppercase tracking-widest">
                        Syntaxhub © 2026
                    </p>
                    <p className="text-[12px] text-white/30 tracking-wide">
                        V 1.0.0
                    </p>
                </footer>
            </main>
        </div>
    );
}
