import AppLayout from '@/Layouts/AppLayout';
import { Head, Link } from '@inertiajs/react';
import { motion, AnimatePresence } from 'framer-motion';
import { HiOutlineCheck, HiOutlineArrowRight } from 'react-icons/hi';
import { useState } from 'react';
import IconMap from '@/Components/IconMap';

const fadeUp = {
    hidden: { opacity: 0, y: 30 },
    visible: (d = 0) => ({ opacity: 1, y: 0, transition: { delay: d, duration: 0.6, ease: [0.16, 1, 0.3, 1] } }),
};

const departments = [
    { id: 'rpl', label: 'RPL', fullLabel: 'Rekayasa Perangkat Lunak', iconName: 'code', description: 'HTML, CSS, JavaScript, Python, Java, PHP, C++, SQL, Git' },
    { id: 'tkj', label: 'TKJ', fullLabel: 'Teknik Komputer & Jaringan', iconName: 'globe', description: 'Networking, Router, Switch, Firewall, Scripting' },
];

export default function TutorialsIndex({ tutorials, userProgress }) {
    const [activeDept, setActiveDept] = useState('rpl');
    const levels = ['beginner', 'intermediate', 'advanced'];

    const deptTutorials = tutorials.filter(t => t.department === activeDept);
    const total = deptTutorials.length;
    const completed = deptTutorials.filter(t => userProgress[t.id] === 'completed').length;

    const totalAll = tutorials.length;
    const completedAll = tutorials.filter(t => userProgress[t.id] === 'completed').length;

    return (
        <AppLayout title="Guided Roads">
            <Head title="Guided Roads" />

            {/* Department Tabs */}
            <motion.div initial="hidden" animate="visible" variants={fadeUp} className="mb-6">
                <div className="flex flex-col sm:flex-row gap-3">
                    {departments.map((dept) => {
                        const deptItems = tutorials.filter(t => t.department === dept.id);
                        const deptCompleted = deptItems.filter(t => userProgress[t.id] === 'completed').length;
                        const isActive = activeDept === dept.id;

                        return (
                            <button
                                key={dept.id}
                                onClick={() => setActiveDept(dept.id)}
                                className={`group relative flex-1 p-5 rounded-2xl border text-left transition-all duration-300 ${
                                    isActive
                                        ? 'border-white/20 bg-white/[0.08] shadow-[0_0_30px_rgba(255,255,255,0.05)]'
                                        : 'border-white/5 bg-white/[0.02] hover:border-white/10 hover:bg-white/[0.04]'
                                }`}
                            >
                                {/* Active indicator */}
                                {isActive && (
                                    <motion.div
                                        layoutId="activeDeptIndicator"
                                        className="absolute inset-0 rounded-2xl border border-white/20 bg-white/[0.04]"
                                        transition={{ type: 'spring', bounce: 0.15, duration: 0.5 }}
                                    />
                                )}

                                <div className="relative z-10">
                                    <div className="flex items-center gap-3 mb-2">
                                        <div className="w-9 h-9 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center">
                                            <IconMap name={dept.iconName} className={`w-4 h-4 transition-colors ${isActive ? 'text-white' : 'text-white/40'}`} />
                                        </div>
                                        <div>
                                            <h3 className={`text-sm font-bold tracking-wide transition-colors ${
                                                isActive ? 'text-white' : 'text-white/50'
                                            }`}>
                                                {dept.label}
                                            </h3>
                                            <p className={`text-[10px] uppercase tracking-widest transition-colors ${
                                                isActive ? 'text-white/40' : 'text-white/20'
                                            }`}>
                                                {dept.fullLabel}
                                            </p>
                                        </div>
                                    </div>
                                    <p className={`text-[11px] leading-relaxed mb-3 transition-colors ${
                                        isActive ? 'text-white/40' : 'text-white/20'
                                    }`}>
                                        {dept.description}
                                    </p>
                                    <div className="flex items-center gap-2">
                                        <div className="flex-1 h-1 rounded-full bg-white/5 overflow-hidden">
                                            <motion.div
                                                className="h-full rounded-full bg-white/30"
                                                initial={{ width: 0 }}
                                                animate={{ width: deptItems.length > 0 ? `${(deptCompleted / deptItems.length) * 100}%` : '0%' }}
                                                transition={{ duration: 0.8, ease: 'easeOut' }}
                                            />
                                        </div>
                                        <span className={`text-[10px] font-mono transition-colors ${
                                            isActive ? 'text-white/40' : 'text-white/20'
                                        }`}>
                                            {deptCompleted}/{deptItems.length}
                                        </span>
                                    </div>
                                </div>
                            </button>
                        );
                    })}
                </div>
            </motion.div>

            {/* Header Stats */}
            <motion.div initial="hidden" animate="visible" variants={fadeUp} className="bento-card p-6 mb-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div>
                    <h2 className="text-xl font-bold text-white tracking-tight mb-2 flex items-center gap-3">
                        <div className="w-8 h-8 rounded-lg bg-white/10 border border-white/10 flex items-center justify-center">
                            <IconMap name={activeDept === 'rpl' ? 'code' : 'globe'} className="w-4 h-4 text-white/70" />
                        </div>
                        {activeDept === 'rpl' ? 'Curriculum RPL' : 'Curriculum TKJ'}
                    </h2>
                    <p className="text-[13px] text-white/50 max-w-sm">
                        {activeDept === 'rpl'
                            ? 'Kurikulum pemrograman lengkap. Dari HTML dasar hingga OOP & Async Programming.'
                            : 'Strictly curated learning paths. Follow the sequence to construct foundational knowledge before advancing.'
                        }
                    </p>
                </div>
                <div className="flex gap-6 w-full md:w-auto">
                    <div>
                        <p className="text-4xl font-bold text-white tracking-tighter mb-1">{completed}<span className="text-lg text-white/20">/{total}</span></p>
                        <p className="text-[10px] text-white/40 uppercase tracking-widest">Completed</p>
                    </div>
                    <div className="border-l border-white/10 pl-6">
                        <p className="text-4xl font-bold text-white/30 tracking-tighter mb-1">{completedAll}<span className="text-lg text-white/10">/{totalAll}</span></p>
                        <p className="text-[10px] text-white/20 uppercase tracking-widest">All Dept</p>
                    </div>
                </div>
            </motion.div>

            {/* Path View */}
            <AnimatePresence mode="wait">
                <motion.div
                    key={activeDept}
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    exit={{ opacity: 0, y: -20 }}
                    transition={{ duration: 0.3 }}
                    className="space-y-12"
                >
                    {levels.map((level, levelIdx) => {
                        const items = deptTutorials.filter(t => t.level === level);
                        if (items.length === 0) return null;
                        const levelCompleted = items.filter(t => userProgress[t.id] === 'completed').length;

                        return (
                            <div key={level}>
                                <motion.div initial="hidden" whileInView="visible" viewport={{ once: true }} variants={fadeUp} className="flex items-center justify-between mb-6 border-b border-white/5 pb-2">
                                    <h2 className="text-[12px] font-bold text-white/60 uppercase tracking-widest">
                                        Phase {levelIdx + 1}: {level}
                                    </h2>
                                    <span className="text-[10px] text-white/30 uppercase tracking-widest">{levelCompleted}/{items.length} Secure</span>
                                </motion.div>

                                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    {items.map((tutorial, index) => {
                                        const isComplete = userProgress[tutorial.id] === 'completed';
                                        const isActive = userProgress[tutorial.id] === 'in_progress';
                                        
                                        return (
                                            <motion.div key={tutorial.id} initial="hidden" whileInView="visible" viewport={{ once: true }} custom={index * 0.1} variants={fadeUp}>
                                                <Link href={`/tutorials/${tutorial.id}`} className="block group h-full">
                                                    <div className={`bento-card p-6 h-full flex flex-col border ${isComplete ? 'border-white/20 bg-white/5' : isActive ? 'border-white/40 bg-white/10' : 'border-white/5'}`}>
                                                        <div className="flex justify-between items-start mb-6">
                                                            <div className={`w-8 h-8 rounded-full flex items-center justify-center border ${
                                                                isComplete ? 'bg-white text-black border-white' : 
                                                                isActive ? 'bg-transparent text-white border-white/50' : 
                                                                'bg-transparent text-white/20 border-white/10'
                                                            }`}>
                                                                {isComplete ? <HiOutlineCheck className="w-4 h-4" /> : <IconMap name={tutorial.icon || 'code'} className="w-4 h-4" />}
                                                            </div>
                                                            <div className="flex items-center gap-2">
                                                                <span className="text-[9px] text-white/20 uppercase tracking-widest font-medium px-2 py-0.5 rounded-full border border-white/5">
                                                                    {tutorial.category}
                                                                </span>
                                                                <span className="text-[10px] text-white/30 font-mono">{tutorial.estimated_minutes}m</span>
                                                            </div>
                                                        </div>
                                                        
                                                        <h3 className="text-lg font-bold text-white tracking-tight mb-2 group-hover:text-white/80 transition-colors">
                                                            {tutorial.title}
                                                        </h3>
                                                        <p className="text-[13px] text-white/40 leading-relaxed mb-6 line-clamp-2">
                                                            {tutorial.description}
                                                        </p>
                                                        
                                                        <div className="mt-auto pt-4 border-t border-white/5 flex items-center justify-between">
                                                            <span className="text-[10px] text-white/30 uppercase tracking-widest">
                                                                {isComplete ? 'Secured' : isActive ? 'In Progress' : 'Pending'}
                                                            </span>
                                                            <HiOutlineArrowRight className="w-4 h-4 text-white/20 group-hover:text-white transition-all transform group-hover:translate-x-1" />
                                                        </div>
                                                    </div>
                                                </Link>
                                            </motion.div>
                                        );
                                    })}
                                </div>
                            </div>
                        );
                    })}
                </motion.div>
            </AnimatePresence>
        </AppLayout>
    );
}
