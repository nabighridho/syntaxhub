import { Link } from '@inertiajs/react';
import { motion } from 'framer-motion';

export default function GuestLayout({ children }) {
    return (
        <div className="flex min-h-screen flex-col items-center bg-[#0a0a0b] text-white pt-6 sm:justify-center sm:pt-0 relative overflow-hidden">
            {/* Background elements */}
            <div className="noise-bg"></div>
            <div className="absolute top-[-20%] left-[-10%] w-[600px] h-[600px] bg-sky-500/10 rounded-full blur-[100px] pointer-events-none mix-blend-screen"></div>
            <div className="absolute bottom-[-20%] right-[-10%] w-[500px] h-[500px] bg-purple-500/10 rounded-full blur-[100px] pointer-events-none mix-blend-screen"></div>

            <motion.div initial={{ opacity: 0, y: -20 }} animate={{ opacity: 1, y: 0 }} transition={{ duration: 0.6 }}>
                <Link href="/" className="flex items-center gap-3 group relative z-10">
                    <img src="/logo.png" alt="Syntaxhub Logo" className="w-12 h-12 object-contain transition-transform group-hover:scale-105 filter drop-shadow-[0_0_20px_rgba(255,255,255,0.2)]" />
                    <span className="font-bold text-white text-2xl tracking-tight hidden sm:block">
                        Syntaxhub.
                    </span>
                </Link>
            </motion.div>

            <motion.div initial={{ opacity: 0, scale: 0.95 }} animate={{ opacity: 1, scale: 1 }} transition={{ duration: 0.5, delay: 0.1 }} 
                        className="mt-10 w-full overflow-hidden bento-card px-8 py-10 shadow-2xl sm:max-w-md relative z-10">
                {children}
            </motion.div>
        </div>
    );
}
