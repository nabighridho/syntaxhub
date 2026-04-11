import AppLayout from '@/Layouts/AppLayout';
import { Head, useForm, usePage } from '@inertiajs/react';
import { motion } from 'framer-motion';
import { HiOutlineUser, HiOutlineMail, HiOutlineCheck, HiOutlineColorSwatch, HiOutlineInformationCircle } from 'react-icons/hi';
import { useState } from 'react';

const fadeUp = {
    hidden: { opacity: 0, y: 16 },
    visible: (d = 0) => ({ opacity: 1, y: 0, transition: { delay: d, duration: 0.4 } }),
};

export default function Settings() {
    const { auth } = usePage().props;
    const [saved, setSaved] = useState(false);
    const { data, setData, post, processing, errors } = useForm({ name: auth.user.name, email: auth.user.email });

    const handleSubmit = (e) => {
        e.preventDefault();
        post('/settings', { onSuccess: () => { setSaved(true); setTimeout(() => setSaved(false), 3000); } });
    };

    return (
        <AppLayout title="Settings">
            <Head title="Settings" />

            <motion.div initial="hidden" animate="visible">
                <div className="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    {/* Form */}
                    <motion.div variants={fadeUp} className="lg:col-span-2 bento-card p-6">
                        <h3 className="text-sm font-bold text-white mb-5 flex items-center gap-2">
                            <HiOutlineUser className="w-4 h-4 text-sky-500" /> Pengaturan Akun
                        </h3>
                        <form onSubmit={handleSubmit} className="space-y-4">
                            <div>
                                <label className="block text-xs font-medium text-white/50 mb-1.5">Nama</label>
                                <div className="relative">
                                    <HiOutlineUser className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-white/30" />
                                    <input type="text" value={data.name} onChange={e => setData('name', e.target.value)}
                                        className="w-full pl-9 pr-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-sm text-white
                                                 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500/50 outline-none transition-all" />
                                </div>
                                {errors.name && <p className="text-red-500 text-xs mt-1">{errors.name}</p>}
                            </div>
                            <div>
                                <label className="block text-xs font-medium text-white/50 mb-1.5">Email</label>
                                <div className="relative">
                                    <HiOutlineMail className="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-white/30" />
                                    <input type="email" value={data.email} onChange={e => setData('email', e.target.value)}
                                        className="w-full pl-9 pr-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-sm text-white
                                                 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500/50 outline-none transition-all" />
                                </div>
                                {errors.email && <p className="text-red-500 text-xs mt-1">{errors.email}</p>}
                            </div>
                            <button type="submit" disabled={processing} className="btn-primary text-sm flex items-center gap-1.5 disabled:opacity-50">
                                {saved ? <><HiOutlineCheck className="w-4 h-4" /> Tersimpan!</> : processing ? 'Menyimpan...' : 'Simpan Perubahan'}
                            </button>
                        </form>
                    </motion.div>

                    {/* Sidebar */}
                    <div className="space-y-4">
                        <motion.div custom={0.1} variants={fadeUp} className="bento-card p-5">
                            <h3 className="text-sm font-bold text-white mb-3 flex items-center gap-1.5"><HiOutlineColorSwatch className="w-4 h-4 text-sky-500" /> Tampilan</h3>
                            <div className="p-3 rounded-xl bg-white/5 flex items-center justify-between opacity-70">
                                <span className="text-sm text-white/60">Dark Mode</span>
                                <div className="w-9 h-5 rounded-full bg-emerald-500/20 border border-emerald-500/30 relative cursor-not-allowed">
                                    <div className="absolute right-0.5 top-0.5 w-4 h-4 rounded-full bg-emerald-500" />
                                </div>
                            </div>
                            <p className="text-[10px] text-white/40 mt-2 px-1">Dark Mode is enforced globally</p>
                        </motion.div>

                        <motion.div custom={0.15} variants={fadeUp} className="bento-card p-5">
                            <h3 className="text-sm font-bold text-white mb-3 flex items-center gap-1.5"><HiOutlineInformationCircle className="w-4 h-4 text-sky-500" /> Info Akun</h3>
                            <div className="space-y-2 text-sm">
                                <div className="flex justify-between"><span className="text-white/40">Member sejak</span><span className="text-white font-medium">{new Date(auth.user.created_at || Date.now()).toLocaleDateString('id-ID')}</span></div>
                                <div className="flex justify-between"><span className="text-white/40">Role</span><span className="text-white font-medium">Student</span></div>
                            </div>
                        </motion.div>
                    </div>
                </div>
            </motion.div>
        </AppLayout>
    );
}
