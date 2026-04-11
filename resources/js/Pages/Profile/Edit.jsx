import AppLayout from '@/Layouts/AppLayout';
import { Head } from '@inertiajs/react';
import DeleteUserForm from './Partials/DeleteUserForm';
import UpdatePasswordForm from './Partials/UpdatePasswordForm';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm';
import { motion } from 'framer-motion';

const fadeUp = {
    hidden: { opacity: 0, y: 30 },
    visible: (d = 0) => ({ opacity: 1, y: 0, transition: { delay: d, duration: 0.6, ease: [0.16, 1, 0.3, 1] } }),
};

export default function Edit({ mustVerifyEmail, status }) {
    return (
        <AppLayout title="Profile Setting">
            <Head title="Profile Setting" />

            <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {/* Intro Matrix */}
                <motion.div initial="hidden" animate="visible" variants={fadeUp} custom={0.1} className="lg:col-span-1 border-b lg:border-b-0 lg:border-r border-white/10 pb-8 lg:pb-0 lg:pr-8">
                    <div className="tag-modern inline-block mb-4">IDENTITY & SECURITY</div>
                    <h2 className="text-3xl font-bold text-white tracking-tight mb-2">Profile Matrix</h2>
                    <p className="text-white/50 text-sm">Manage your personal trajectory, secure authentication keys, and maintain control of your Syntaxhub dataset.</p>
                </motion.div>

                {/* Forms Matrix */}
                <div className="lg:col-span-2 space-y-6">
                    <motion.div initial="hidden" animate="visible" variants={fadeUp} custom={0.2} className="bento-card p-6 md:p-8">
                        <UpdateProfileInformationForm
                            mustVerifyEmail={mustVerifyEmail}
                            status={status}
                            className="max-w-xl"
                        />
                    </motion.div>

                    <motion.div initial="hidden" animate="visible" variants={fadeUp} custom={0.3} className="bento-card p-6 md:p-8">
                        <UpdatePasswordForm className="max-w-xl" />
                    </motion.div>

                    <motion.div initial="hidden" animate="visible" variants={fadeUp} custom={0.4} className="bento-card p-6 md:p-8 border-red-500/20">
                        <DeleteUserForm className="max-w-xl" />
                    </motion.div>
                </div>
            </div>
        </AppLayout>
    );
}
