import AppLayout from '@/Layouts/AppLayout';
import { Head, Link } from '@inertiajs/react';
import { motion } from 'framer-motion';
import {
    HiOutlineAcademicCap, HiOutlineFire, HiOutlineBookmark,
    HiOutlineBadgeCheck, HiOutlineBookOpen, HiOutlineLightningBolt, HiOutlineLightBulb
} from 'react-icons/hi';
import { useLanguage } from '@/i18n/LanguageContext';
import IconMap from '@/Components/IconMap';

const fadeUp = {
    hidden: { opacity: 0, y: 30 },
    visible: (d = 0) => ({ opacity: 1, y: 0, transition: { delay: d, duration: 0.6, ease: [0.16, 1, 0.3, 1] } }),
};

function ProgressRing({ percent, size = 100 }) {
    const r = (size / 2) - 8;
    const c = 2 * Math.PI * r;
    const offset = c - (percent / 100) * c;

    return (
        <div className="relative" style={{ width: size, height: size }}>
            <svg className="transform -rotate-90" viewBox={`0 0 ${size} ${size}`}>
                <circle cx={size/2} cy={size/2} r={r} stroke="rgba(255,255,255,0.05)" strokeWidth="6" fill="none" />
                <motion.circle
                    cx={size/2} cy={size/2} r={r}
                    stroke="#ffffff" strokeWidth="6" fill="none" strokeLinecap="round"
                    strokeDasharray={c} initial={{ strokeDashoffset: c }} animate={{ strokeDashoffset: offset }}
                    transition={{ duration: 1.5, ease: [0.16, 1, 0.3, 1], delay: 0.2 }}
                />
            </svg>
            <div className="absolute inset-0 flex flex-col items-center justify-center">
                <span className="text-xl font-bold text-white">{percent}%</span>
            </div>
        </div>
    );
}

export default function Dashboard({ stats, recentProgress, earnedBadges }) {
    const { t } = useLanguage();

    return (
        <AppLayout title={t('nav.dashboard')}>
            <Head title={t('nav.dashboard')} />

            {/* Top Grid */}
            <div className="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
                
                {/* Hero Box */}
                <motion.div initial="hidden" animate="visible" variants={fadeUp} custom={0.1} className="bento-card lg:col-span-2 p-8 flex flex-col sm:flex-row items-center gap-8 min-h-[220px]">
                    <div className="flex-1">
                        <div className="tag-modern mb-4 inline-block">{t('dashboard.welcome')}</div>
                        <h2 className="text-3xl font-bold text-white tracking-tight mb-2">{t('dashboard.continue')}</h2>
                        <p className="text-white/50 text-sm max-w-md">{t('dashboard.resume')}</p>
                    </div>
                    <div>
                        <ProgressRing percent={stats.progressPercent} size={140} />
                    </div>
                </motion.div>

                {/* Quick Action Matrix */}
                <motion.div initial="hidden" animate="visible" variants={fadeUp} custom={0.2} className="bento-card p-6 flex flex-col justify-between">
                    <h3 className="text-lg font-bold text-white mb-4">{t('dashboard.matrix')}</h3>
                    <div className="flex flex-col gap-2">
                        <Link href="/tutorials" className="flex items-center gap-3 p-3 rounded-xl bg-white/5 hover:bg-white/10 transition-colors border border-white/5">
                            <div className="bg-white/10 w-8 h-8 rounded-lg flex items-center justify-center">
                                <HiOutlineBookOpen className="w-4 h-4 text-white" />
                            </div>
                            <span className="text-sm font-medium text-white/80">Tutorial Hub</span>
                        </Link>
                        <Link href="/playground" className="flex items-center gap-3 p-3 rounded-xl bg-white/5 hover:bg-white/10 transition-colors border border-white/5">
                            <div className="bg-white/10 w-8 h-8 rounded-lg flex items-center justify-center">
                                <HiOutlineLightningBolt className="w-4 h-4 text-white" />
                            </div>
                            <span className="text-sm font-medium text-white/80">Playground</span>
                        </Link>
                        <Link href="/snippets" className="flex items-center gap-3 p-3 rounded-xl bg-white/5 hover:bg-white/10 transition-colors border border-white/5">
                            <div className="bg-white/10 w-8 h-8 rounded-lg flex items-center justify-center">
                                <HiOutlineLightBulb className="w-4 h-4 text-white" />
                            </div>
                            <span className="text-sm font-medium text-white/80">Snippets</span>
                        </Link>
                    </div>
                </motion.div>
            </div>

            {/* Middle Grid (Stats) */}
            <div className="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                {[
                    { label: t('dashboard.stats.completed'), value: stats.completedTutorials, total: stats.totalTutorials, icon: HiOutlineAcademicCap },
                    { label: t('dashboard.stats.active'), value: stats.inProgressTutorials, icon: HiOutlineFire },
                    { label: t('dashboard.stats.saved'), value: stats.totalBookmarks, icon: HiOutlineBookmark },
                    { label: t('dashboard.stats.badges'), value: stats.totalBadges, icon: HiOutlineBadgeCheck },
                ].map((s, i) => (
                    <motion.div key={s.label} initial="hidden" animate="visible" variants={fadeUp} custom={0.3 + i * 0.1} className="bento-card p-6 flex flex-col justify-between h-[140px]">
                        <s.icon className="w-5 h-5 text-white/40 mb-auto" />
                        <div>
                            <p className="text-3xl font-bold text-white tracking-tight">
                                {s.value}
                                {s.total && <span className="text-sm font-normal text-white/20">/{s.total}</span>}
                            </p>
                            <p className="text-[11px] text-white/40 uppercase tracking-widest mt-1">{s.label}</p>
                        </div>
                    </motion.div>
                ))}
            </div>

            {/* Bottom Grid */}
            <div className="grid grid-cols-1 lg:grid-cols-3 gap-4">
                {/* Recent Activity */}
                <motion.div initial="hidden" animate="visible" variants={fadeUp} custom={0.5} className="bento-card lg:col-span-2 p-6">
                    <div className="flex items-center justify-between mb-6">
                        <h3 className="text-lg font-bold text-white flex items-center gap-2">
                            <HiOutlineLightningBolt className="w-5 h-5 text-white/40" />
                            {t('dashboard.recent')}
                        </h3>
                        <Link href="/progress" className="text-xs text-white/50 hover:text-white transition-colors uppercase tracking-widest border border-white/10 px-3 py-1 rounded-full">{t('dashboard.viewAll')}</Link>
                    </div>
                    {recentProgress.length === 0 ? (
                        <div className="py-12 border border-white/5 border-dashed rounded-xl flex items-center justify-center">
                            <p className="text-sm text-white/30 tracking-wide uppercase">{t('dashboard.noData')}</p>
                        </div>
                    ) : (
                        <div className="space-y-3">
                            {recentProgress.map((p) => (
                                <div key={p.id} className="flex items-center gap-4 p-4 rounded-xl bg-[#18181b] border border-white/5 hover:border-white/10 transition-colors">
                                    <div className={`w-2 h-2 rounded-full shadow-lg ${
                                        p.status === 'completed' ? 'bg-white shadow-white/50' :
                                        p.status === 'in_progress' ? 'bg-white/40' : 'bg-transparent border border-white/20'
                                    }`} />
                                    <div className="flex-1 min-w-0">
                                        <p className="text-[14px] font-medium text-white/90 truncate">{p.tutorial?.title}</p>
                                        <p className="text-[11px] text-white/40 tracking-wider uppercase mt-0.5">{p.tutorial?.category}</p>
                                    </div>
                                    <div className={`px-2 py-1 rounded-md text-[10px] uppercase font-bold tracking-widest ${
                                        p.status === 'completed' ? 'bg-white text-black' : 'bg-white/10 text-white/50'
                                    }`}>
                                        {p.status === 'completed' ? t('dashboard.done') : t('dashboard.activeStatus')}
                                    </div>
                                </div>
                            ))}
                        </div>
                    )}
                </motion.div>

                {/* Achivements */}
                <motion.div initial="hidden" animate="visible" variants={fadeUp} custom={0.6} className="bento-card p-6">
                    <div className="flex items-center justify-between mb-6">
                        <h3 className="text-lg font-bold text-white">{t('dashboard.achievements')}</h3>
                    </div>
                    {earnedBadges.length === 0 ? (
                        <div className="py-12 flex flex-col items-center justify-center border border-white/5 border-dashed rounded-xl">
                            <HiOutlineBadgeCheck className="w-8 h-8 text-white/30 mb-2" />
                            <p className="text-[11px] text-white/30 uppercase tracking-widest">{t('dashboard.locked')}</p>
                        </div>
                    ) : (
                        <div className="grid grid-cols-2 gap-3">
                            {earnedBadges.map((badge) => (
                                <div key={badge.id} className="p-4 rounded-xl bg-[#18181b] border border-white/5 flex flex-col items-center text-center">
                                    <div className="w-8 h-8 rounded-lg bg-white/10 border border-white/10 flex items-center justify-center mb-2">
                                        <IconMap name={badge.icon} className="w-4 h-4 text-white/70" />
                                    </div>
                                    <p className="text-[11px] font-bold text-white/80 uppercase tracking-wider truncate w-full">{badge.name}</p>
                                </div>
                            ))}
                        </div>
                    )}
                </motion.div>
            </div>
        </AppLayout>
    );
}
