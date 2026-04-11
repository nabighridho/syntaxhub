import AppLayout from '@/Layouts/AppLayout';
import { Head } from '@inertiajs/react';
import { motion } from 'framer-motion';
import { HiOutlineMail, HiOutlineCalendar, HiOutlineCode, HiOutlineBadgeCheck } from 'react-icons/hi';
import IconMap from '@/Components/IconMap';

const fadeUp = {
    hidden: { opacity: 0, y: 16 },
    visible: (d = 0) => ({ opacity: 1, y: 0, transition: { delay: d, duration: 0.4 } }),
};

export default function UserProfile({ userProfile, badges }) {
    const skills = ['HTML/CSS', 'JavaScript', 'Python', 'Cisco CLI', 'Networking', 'Subnetting'];

    return (
        <AppLayout title="Profil Saya">
            <Head title="Profil Saya" />

            <motion.div initial="hidden" animate="visible">
                {/* Profile Header */}
                <motion.div variants={fadeUp} className="bento-card p-6 mb-6">
                    <div className="flex flex-col sm:flex-row items-center gap-5">
                        <motion.div
                            initial={{ scale: 0 }}
                            animate={{ scale: 1 }}
                            transition={{ type: 'spring', stiffness: 200, delay: 0.2 }}
                            className="w-20 h-20 rounded-2xl bg-white/10 border border-white/20 flex items-center justify-center text-white text-3xl font-bold shadow-[0_0_30px_rgba(255,255,255,0.1)]"
                        >
                            {userProfile.name.charAt(0).toUpperCase()}
                        </motion.div>
                        <div className="text-center sm:text-left flex-1">
                            <h2 className="text-2xl font-bold text-white">{userProfile.name}</h2>
                            <div className="flex flex-col sm:flex-row items-center gap-3 mt-1 text-sm text-white/40">
                                <span className="flex items-center gap-1"><HiOutlineMail className="w-4 h-4" />{userProfile.email}</span>
                                <span className="flex items-center gap-1"><HiOutlineCalendar className="w-4 h-4" />Bergabung {userProfile.joined}</span>
                            </div>
                        </div>
                        <div className="flex gap-4 text-center">
                            <div className="px-4 py-2 rounded-xl bg-white/5 border border-white/10">
                                <p className="text-xl font-bold text-white">{userProfile.completedTutorials}</p>
                                <p className="text-[10px] text-white/40 uppercase tracking-wider">Selesai</p>
                            </div>
                            <div className="px-4 py-2 rounded-xl bg-white/5 border border-white/10">
                                <p className="text-xl font-bold text-white">{badges.length}</p>
                                <p className="text-[10px] text-white/40 uppercase tracking-wider">Badges</p>
                            </div>
                        </div>
                    </div>
                </motion.div>

                <div className="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    {/* Skills */}
                    <motion.div custom={0.1} variants={fadeUp} className="bento-card p-5">
                        <h3 className="text-sm font-bold text-white mb-4 flex items-center gap-2">
                            <HiOutlineCode className="w-4 h-4 text-white/50" /> Keahlian
                        </h3>
                        <div className="flex flex-wrap gap-2">
                            {skills.map(s => (
                                <span key={s} className="px-3 py-1.5 rounded-lg text-xs font-medium bg-white/5 border border-white/10 text-white/60
                                                         hover:bg-white/10 hover:border-white/30 hover:text-white transition-all cursor-default">{s}</span>
                            ))}
                        </div>
                    </motion.div>

                    {/* Badges */}
                    <motion.div custom={0.15} variants={fadeUp} className="bento-card p-5">
                        <h3 className="text-sm font-bold text-white mb-4 flex items-center gap-2">
                            <HiOutlineBadgeCheck className="w-4 h-4 text-white/50" /> Badges
                        </h3>
                        {badges.length === 0 ? (
                            <div className="py-6 text-center">
                                <div className="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center mx-auto mb-4">
                                    <HiOutlineBadgeCheck className="w-6 h-6 text-white/20" />
                                </div>
                                <p className="text-sm text-white/40">Belum ada badge</p>
                            </div>
                        ) : (
                            <div className="grid grid-cols-2 gap-2">
                                {badges.map(b => (
                                    <div key={b.id} className="p-4 rounded-xl bg-white/5 border border-white/5 text-center hover:border-white/20 hover:bg-white/10 transition-all">
                                        <IconMap name={b.icon} className="w-6 h-6 mx-auto mb-2 text-white/70" />
                                        <p className="text-xs font-semibold text-white truncate">{b.name}</p>
                                        <p className="text-[10px] text-white/40 mt-0.5 truncate">{b.description}</p>
                                    </div>
                                ))}
                            </div>
                        )}
                    </motion.div>
                </div>
            </motion.div>
        </AppLayout>
    );
}
