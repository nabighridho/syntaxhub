import AppLayout from '@/Layouts/AppLayout';
import { Head, Link } from '@inertiajs/react';
import { motion } from 'framer-motion';
import { HiOutlineClipboardCopy, HiOutlineCheck, HiOutlineArrowLeft } from 'react-icons/hi';
import { useState } from 'react';

const langConfig = {
    cli: { label: 'CLI' },
    html: { label: 'HTML' },
    css: { label: 'CSS' },
    javascript: { label: 'JavaScript' },
    python: { label: 'Python' },
};

function CodeViewer({ code, annotations }) {
    const [copied, setCopied] = useState(false);
    const lines = code.split('\n');
    const annotationMap = {};
    (annotations || []).forEach(a => { annotationMap[a.line] = a.text; });

    const handleCopy = () => {
        navigator.clipboard.writeText(code);
        setCopied(true);
        setTimeout(() => setCopied(false), 2000);
    };

    return (
        <div className="bento-card overflow-hidden">
            <div className="flex items-center justify-between px-6 py-4 bg-white/5 border-b border-white/5">
                <div className="flex gap-2">
                    <div className="w-3 h-3 rounded-full bg-white/20" />
                    <div className="w-3 h-3 rounded-full bg-white/20" />
                    <div className="w-3 h-3 rounded-full bg-white/20" />
                </div>
                <button onClick={handleCopy} className="flex items-center gap-2 text-[10px] uppercase tracking-widest text-white/40 hover:text-white transition-colors">
                    {copied ? <><HiOutlineCheck className="w-4 h-4 text-green-400" /> Copied</> : <><HiOutlineClipboardCopy className="w-4 h-4" /> Copy Syntax</>}
                </button>
            </div>

            <div className="bg-[#050505] overflow-x-auto py-4">
                {lines.map((line, i) => {
                    const lineNum = i + 1;
                    const annotation = annotationMap[lineNum];
                    return (
                        <div key={i}>
                            <div className={`flex hover:bg-white/5 transition-colors ${annotation ? 'bg-white/[0.02]' : ''}`}>
                                <span className="w-12 text-right pr-4 py-1.5 text-[12px] text-white/20 select-none font-mono shrink-0">{lineNum}</span>
                                <code className="flex-1 py-1.5 text-[13px] text-white/80 font-mono whitespace-pre pr-6">{line || ' '}</code>
                            </div>
                            {annotation && (
                                <div className="flex items-start gap-4 pl-12 pr-6 py-3 bg-white/[0.04] border-l border-white/20">
                                    <span className="text-[12px] opacity-60 mt-0.5">↳</span>
                                    <p className="text-[12px] text-white/50 leading-relaxed font-mono">{annotation}</p>
                                </div>
                            )}
                        </div>
                    );
                })}
            </div>
        </div>
    );
}

export default function SnippetShow({ snippet, relatedSnippets }) {
    const cfg = langConfig[snippet.language] || { label: snippet.language };

    return (
        <AppLayout title={snippet.title}>
            <Head title={snippet.title} />

            <div className="mb-8">
                <Link href="/snippets" className="text-[11px] text-white/40 uppercase tracking-widest hover:text-white transition-colors border border-white/10 px-3 py-1.5 rounded-full inline-flex items-center gap-2">
                    <HiOutlineArrowLeft className="w-3 h-3" /> Back to Archive
                </Link>
            </div>

            <div className="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <motion.div initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} className="lg:col-span-3 space-y-6">
                    <div className="bento-card p-8">
                        <div className="flex items-center gap-3 mb-6">
                            <span className="text-[10px] text-white/50 uppercase tracking-widest border border-white/10 px-2.5 py-1 rounded-full">{cfg.label}</span>
                            <span className="text-[10px] text-white/30 uppercase tracking-widest">{snippet.category}</span>
                        </div>
                        <h1 className="text-3xl font-bold text-white tracking-tight mb-4">{snippet.title}</h1>
                        <p className="text-white/50 text-[14px] leading-relaxed max-w-2xl">{snippet.description}</p>
                    </div>

                    <CodeViewer code={snippet.code} annotations={snippet.annotations} />
                </motion.div>

                <motion.div initial={{ opacity: 0, x: 20 }} animate={{ opacity: 1, x: 0 }} transition={{ delay: 0.1 }} className="lg:col-span-1 space-y-6">
                    <div className="bento-card p-6">
                        <h3 className="text-[12px] font-bold text-white/60 uppercase tracking-widest mb-6">Metadata</h3>
                        <div className="space-y-4">
                            <div className="flex justify-between items-center"><span className="text-[11px] text-white/30 uppercase tracking-widest">Language</span><span className="text-[13px] font-medium text-white">{cfg.label}</span></div>
                            <div className="flex justify-between items-center"><span className="text-[11px] text-white/30 uppercase tracking-widest">Category</span><span className="text-[13px] font-medium text-white">{snippet.category}</span></div>
                            <div className="flex justify-between items-center"><span className="text-[11px] text-white/30 uppercase tracking-widest">Size</span><span className="text-[13px] font-medium text-white">{snippet.code.split('\n').length} loc</span></div>
                        </div>
                    </div>

                    {relatedSnippets.length > 0 && (
                        <div className="bento-card p-6">
                            <h3 className="text-[12px] font-bold text-white/60 uppercase tracking-widest mb-6">Related Syntax</h3>
                            <div className="space-y-2">
                                {relatedSnippets.map(r => (
                                    <Link key={r.id} href={`/snippets/${r.id}`} className="block p-3 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 transition-colors group">
                                        <p className="text-[12px] font-medium text-white/80 group-hover:text-white truncate">{r.title}</p>
                                    </Link>
                                ))}
                            </div>
                        </div>
                    )}
                </motion.div>
            </div>
        </AppLayout>
    );
}
