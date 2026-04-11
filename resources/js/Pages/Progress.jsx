import AppLayout from '@/Layouts/AppLayout';
import { Head } from '@inertiajs/react';
import { motion } from 'framer-motion';
import { BarChart, Bar, XAxis, YAxis, Tooltip, ResponsiveContainer, PieChart, Pie, Cell } from 'recharts';
import { HiOutlineAcademicCap, HiOutlineClock, HiOutlineFire, HiOutlineBadgeCheck } from 'react-icons/hi';
import IconMap from '@/Components/IconMap';

const fadeUp = {
    hidden: { opacity: 0, y: 30 },
    visible: (d = 0) => ({ opacity: 1, y: 0, transition: { delay: d, duration: 0.6, ease: [0.16, 1, 0.3, 1] } }),
};
// Ultra minimal dark mode colors
const PIE_COLORS = ['#ffffff', '#ffffff40', '#ffffff10'];

export default function Progress({ progress, badges, weeklyData, stats }) {
    const pieData = [
        { name: 'Selesai', value: Math.max(1, stats.completed) },
        { name: 'Berjalan', value: Math.max(0, stats.inProgress) },
        { name: 'Belum', value: Math.max(0, 6 - stats.completed - stats.inProgress) },
    ];

    return (
        <AppLayout title="Telemetry">
            <Head title="Telemetry" />

            <div className="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                {[
                    { icon: HiOutlineAcademicCap, v: stats.completed, l: 'Completed' },
                    { icon: HiOutlineFire, v: stats.inProgress, l: 'Active' },
                    { icon: HiOutlineClock, v: `${stats.totalTime}m`, l: 'Duration' },
                    { icon: HiOutlineBadgeCheck, v: badges.length, l: 'Badges' },
                ].map((s, i) => (
                    <motion.div key={s.l} initial="hidden" animate="visible" variants={fadeUp} custom={0.1 + i * 0.05} className="bento-card p-6 flex items-center justify-between">
                        <div>
                            <p className="text-3xl font-bold text-white tracking-tight leading-none mb-1">{s.v}</p>
                            <p className="text-[10px] text-white/40 uppercase tracking-widest">{s.l}</p>
                        </div>
                        <div className="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center">
                            <s.icon className="w-5 h-5 text-white/60" />
                        </div>
                    </motion.div>
                ))}
            </div>

            <div className="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
                <motion.div initial="hidden" animate="visible" variants={fadeUp} custom={0.3} className="bento-card lg:col-span-2 p-6 flex flex-col min-h-[300px]">
                    <h3 className="text-[12px] font-bold text-white/60 uppercase tracking-widest mb-6">Activity Frequency</h3>
                    <div className="flex-1 w-full relative">
                        <ResponsiveContainer width="100%" height="100%">
                            <BarChart data={weeklyData} margin={{ top: 10, right: 0, left: -20, bottom: 0 }}>
                                <XAxis dataKey="day" axisLine={false} tickLine={false} tick={{ fill: '#ffffff40', fontSize: 10 }} dy={10} />
                                <YAxis axisLine={false} tickLine={false} tick={{ fill: '#ffffff40', fontSize: 10 }} />
                                <Tooltip 
                                    cursor={{ fill: 'rgba(255,255,255,0.05)' }} 
                                    contentStyle={{ background: '#121214', border: '1px solid rgba(255,255,255,0.1)', borderRadius: '12px', color: 'white', fontSize: '12px' }}
                                    itemStyle={{ color: 'white' }}
                                />
                                <Bar dataKey="activities" fill="#ffffff" radius={[4, 4, 0, 0]} />
                            </BarChart>
                        </ResponsiveContainer>
                    </div>
                </motion.div>

                <motion.div initial="hidden" animate="visible" variants={fadeUp} custom={0.4} className="bento-card p-6 flex flex-col">
                    <h3 className="text-[12px] font-bold text-white/60 uppercase tracking-widest mb-6">Distribution</h3>
                    <div className="flex-1 w-full relative flex items-center justify-center">
                        <ResponsiveContainer width="100%" height={200}>
                            <PieChart>
                                <Pie data={pieData} cx="50%" cy="50%" innerRadius={60} outerRadius={80} paddingAngle={5} dataKey="value" stroke="none">
                                    {pieData.map((_, i) => <Cell key={i} fill={PIE_COLORS[i % PIE_COLORS.length]} />)}
                                </Pie>
                                <Tooltip contentStyle={{ background: '#121214', border: '1px solid rgba(255,255,255,0.1)', borderRadius: '12px', fontSize: '12px' }} itemStyle={{ color: 'white' }} />
                            </PieChart>
                        </ResponsiveContainer>
                        <div className="absolute inset-0 flex items-center justify-center pointer-events-none">
                            <span className="text-xl font-bold text-white">{Math.round((stats.completed/6)*100)}%</span>
                        </div>
                    </div>
                    <div className="flex justify-center gap-4 mt-4">
                        {pieData.map((d, i) => (
                            <div key={d.name} className="flex items-center gap-1.5">
                                <span className="w-1.5 h-1.5 rounded-full" style={{ background: PIE_COLORS[i] }} />
                                <span className="text-[10px] text-white/50 uppercase tracking-widest">{d.name}</span>
                            </div>
                        ))}
                    </div>
                </motion.div>
            </div>

            <div className="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <motion.div initial="hidden" animate="visible" variants={fadeUp} custom={0.5} className="bento-card p-6">
                    <h3 className="text-[12px] font-bold text-white/60 uppercase tracking-widest mb-6">Module Status</h3>
                    <div className="space-y-2">
                        {progress.map((p) => (
                            <div key={p.id} className="flex items-center gap-4 p-3 rounded-xl bg-white/5 border border-white/5">
                                <div className={`w-1.5 h-6 rounded-full ${p.status === 'completed' ? 'bg-white' : p.status === 'in_progress' ? 'bg-white/40' : 'bg-white/10'}`} />
                                <div className="flex-1 min-w-0">
                                    <p className="text-[13px] font-medium text-white/90 truncate">{p.tutorial?.title}</p>
                                    <p className="text-[10px] text-white/40 uppercase tracking-widest mt-0.5">{p.tutorial?.level}</p>
                                </div>
                                <span className="text-[10px] text-white/30 uppercase tracking-widest">
                                    {p.status === 'completed' ? 'Done' : 'Active'}
                                </span>
                            </div>
                        ))}
                        {progress.length === 0 && <p className="text-[12px] text-white/30 text-center py-6 border border-white/5 border-dashed rounded-xl">No active modules</p>}
                    </div>
                </motion.div>

                <motion.div initial="hidden" animate="visible" variants={fadeUp} custom={0.6} className="bento-card p-6">
                    <h3 className="text-[12px] font-bold text-white/60 uppercase tracking-widest mb-6">Secured Badges</h3>
                    <div className="grid grid-cols-3 gap-3">
                        {badges.map(b => (
                            <div key={b.id} className="aspect-square rounded-xl bg-white/5 border border-white/5 flex flex-col items-center justify-center text-center p-2">
                                <span className="w-7 h-7 rounded-lg bg-white/10 border border-white/10 flex items-center justify-center"><IconMap name={b.icon} className="w-3.5 h-3.5 text-white/60" /></span>
                                <p className="text-[9px] font-bold text-white/60 uppercase tracking-widest truncate w-full">{b.name}</p>
                            </div>
                        ))}
                        {badges.length === 0 && <div className="col-span-3 text-[12px] text-white/30 text-center py-10 border border-white/5 border-dashed rounded-xl">None secured</div>}
                    </div>
                </motion.div>
            </div>
        </AppLayout>
    );
}
