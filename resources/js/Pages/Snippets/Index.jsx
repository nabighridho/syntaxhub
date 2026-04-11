import AppLayout from '@/Layouts/AppLayout';
import { Head, Link, router } from '@inertiajs/react';
import { motion } from 'framer-motion';
import { useState } from 'react';
import { HiOutlineSearch, HiOutlineArrowRight } from 'react-icons/hi';

const fadeUp = {
    hidden: { opacity: 0, y: 20 },
    visible: (d = 0) => ({ opacity: 1, y: 0, transition: { delay: d, duration: 0.5, ease: [0.16, 1, 0.3, 1] } }),
};

const langConfig = {
    cli: { label: 'CLI' },
    html: { label: 'HTML' },
    css: { label: 'CSS' },
    javascript: { label: 'JavaScript' },
    python: { label: 'Python' },
};

export default function SnippetsIndex({ snippets, languages, filters }) {
    const [search, setSearch] = useState(filters.search || '');

    const handleSearch = (e) => {
        e.preventDefault();
        router.get('/snippets', { ...filters, search }, { preserveState: true });
    };

    const handleFilter = (lang) => {
        router.get('/snippets', {
            ...filters,
            language: filters.language === lang ? '' : lang,
        }, { preserveState: true });
    };

    return (
        <AppLayout title="Snippet Archive">
            <Head title="Snippet Archive" />

            <div className="flex flex-col md:flex-row items-center justify-between gap-6 mb-12">
                <form onSubmit={handleSearch} className="relative w-full md:max-w-md">
                    <HiOutlineSearch className="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-white/40" />
                    <input
                        type="text" value={search} onChange={(e) => setSearch(e.target.value)}
                        placeholder="Search syntax..."
                        className="w-full pl-12 pr-4 py-3 rounded-full bg-white/5 border border-white/10 text-sm text-white placeholder-white/30 focus:bg-white/10 focus:border-white/20 transition-all outline-none"
                    />
                </form>
                
                <div className="flex flex-wrap items-center gap-2">
                    {languages.map((lang) => {
                        const cfg = langConfig[lang] || { label: lang };
                        const active = filters.language === lang;
                        return (
                            <button
                                key={lang} onClick={() => handleFilter(lang)}
                                className={`px-4 py-2 rounded-full text-[11px] uppercase tracking-widest font-bold transition-all border ${
                                    active ? 'bg-white text-black border-white' : 'bg-transparent text-white/50 border-white/10 hover:border-white/30 hover:text-white'
                                }`}
                            >
                                {cfg.label}
                            </button>
                        );
                    })}
                </div>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                {snippets.map((snippet, i) => {
                    const cfg = langConfig[snippet.language] || { label: snippet.language };
                    return (
                        <motion.div key={snippet.id} initial="hidden" whileInView="visible" viewport={{ once: true }} custom={i * 0.05} variants={fadeUp}>
                            <Link href={`/snippets/${snippet.id}`} className="bento-card block p-6 h-full flex flex-col group">
                                <div className="flex items-center justify-between mb-8">
                                    <span className="text-[10px] text-white/40 uppercase tracking-widest border border-white/10 px-2.5 py-1 rounded-full">
                                        {cfg.label}
                                    </span>
                                    <span className="text-[10px] text-white/30 uppercase tracking-widest">
                                        {snippet.category}
                                    </span>
                                </div>
                                
                                <h3 className="text-xl font-bold text-white tracking-tight mb-3 group-hover:text-white/80 transition-colors">
                                    {snippet.title}
                                </h3>
                                <p className="text-[13px] text-white/40 leading-relaxed line-clamp-2 mb-6 flex-1">
                                    {snippet.description}
                                </p>
                                
                                <div className="flex items-center justify-between pt-4 border-t border-white/5">
                                    <div className="flex gap-4">
                                        <span className="text-[10px] text-white/30 uppercase tracking-widest flex items-center gap-1.5"><span className="w-1.5 h-1.5 rounded-full bg-white/20"></span> {snippet.code.split('\n').length} lines</span>
                                        <span className="text-[10px] text-white/30 uppercase tracking-widest flex items-center gap-1.5"><span className="w-1.5 h-1.5 rounded-full bg-white/20"></span> {snippet.annotations?.length || 0} notes</span>
                                    </div>
                                    <HiOutlineArrowRight className="w-4 h-4 text-white/20 group-hover:text-white transform group-hover:translate-x-1 transition-all" />
                                </div>
                            </Link>
                        </motion.div>
                    );
                })}
            </div>

            {snippets.length === 0 && (
                <div className="text-center py-32 border border-white/5 border-dashed rounded-3xl">
                    <p className="text-[12px] text-white/30 uppercase tracking-widest tracking-widest">No matching syntax found</p>
                </div>
            )}
        </AppLayout>
    );
}
