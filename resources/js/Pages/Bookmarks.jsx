import AppLayout from '@/Layouts/AppLayout';
import { Head, Link, router } from '@inertiajs/react';
import { motion } from 'framer-motion';
import { HiOutlineTrash, HiOutlineBookmark, HiOutlineBookOpen, HiOutlineCode } from 'react-icons/hi';

const fadeUp = {
    hidden: { opacity: 0, y: 16 },
    visible: (d = 0) => ({ opacity: 1, y: 0, transition: { delay: d, duration: 0.4 } }),
};

export default function Bookmarks({ bookmarks }) {
    const handleRemove = (bm) => {
        router.post('/bookmarks/toggle', {
            bookmarkable_type: bm.type.toLowerCase(),
            bookmarkable_id: bm.item.id,
        });
    };

    return (
        <AppLayout title="Bookmarks">
            <Head title="Bookmarks" />

            {bookmarks.length === 0 ? (
            <motion.div initial="hidden" animate="visible" variants={fadeUp} className="text-center py-24 flex flex-col items-center">
                    <HiOutlineBookmark className="w-12 h-12 text-white/20 mb-3" />
                    <p className="text-lg text-white/50 mb-2">Belum ada bookmark</p>
                    <p className="text-sm text-white/40 mb-6">Simpan tutorial atau snippet favoritmu</p>
                    <Link href="/tutorials" className="btn-primary text-sm">Jelajahi Tutorial</Link>
                </motion.div>
            ) : (
                <div className="space-y-2">
                    {bookmarks.map((bm, i) => (
                        <motion.div key={bm.id} initial="hidden" whileInView="visible" viewport={{ once: true }} custom={i * 0.03} variants={fadeUp}>
                            <div className="flex items-center gap-4 p-4 rounded-xl bg-white/5 border border-white/5
                                          hover:bg-white/10 hover:border-white/20 transition-all group">
                                <span className={`text-xs font-semibold px-2 py-0.5 rounded-md shrink-0 ${
                                    bm.type === 'Tutorial' ? 'bg-sky-500/10 text-sky-400' : 'bg-purple-500/10 text-purple-400'
                                }`}>
                                    {bm.type === 'Tutorial' ? <HiOutlineBookOpen className="w-3.5 h-3.5" /> : <HiOutlineCode className="w-3.5 h-3.5" />}
                                    <span className="ml-1">{bm.type}</span>
                                </span>
                                <Link href={bm.type === 'Tutorial' ? `/tutorials/${bm.item.id}${bm.meta?.slide_index !== undefined ? `?slide=${bm.meta.slide_index}` : ''}` : `/snippets/${bm.item.id}`} className="flex-1 min-w-0">
                                    <p className="font-semibold text-white group-hover:text-sky-400 transition-colors truncate">
                                        {bm.item.title}
                                        {bm.type === 'Tutorial' && bm.meta?.slide_index !== undefined && (
                                            <span className="ml-2 text-xs font-normal text-yellow-500/80 bg-yellow-500/10 px-1.5 py-0.5 rounded-md">
                                                Slide {bm.meta.slide_index + 1}
                                            </span>
                                        )}
                                    </p>
                                    <p className="text-sm text-white/50 truncate">{bm.item.description}</p>
                                </Link>
                                <button onClick={() => handleRemove(bm)}
                                    className="p-2 rounded-lg text-white/30 hover:text-red-400 hover:bg-white/10 transition-all opacity-0 group-hover:opacity-100">
                                    <HiOutlineTrash className="w-4 h-4" />
                                </button>
                            </div>
                        </motion.div>
                    ))}
                </div>
            )}
        </AppLayout>
    );
}
