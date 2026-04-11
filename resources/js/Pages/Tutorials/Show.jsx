import AppLayout from '@/Layouts/AppLayout';
import { Head, Link, router } from '@inertiajs/react';
import { motion, AnimatePresence } from 'framer-motion';
import { HiOutlineArrowLeft, HiOutlineArrowRight, HiOutlineCheck, HiOutlineTerminal } from 'react-icons/hi';
import { useState, useEffect } from 'react';

// === INTERACTIVE QUIZ COMPONENT ===
function InteractiveQuiz({ quiz, onComplete }) {
    if (!quiz) return null;

    const [inputs, setInputs] = useState({});
    const [status, setStatus] = useState('idle'); // idle, checking, success, error

    const handleInputChange = (blankKey, value) => {
        setInputs(prev => ({ ...prev, [blankKey]: value }));
        setStatus('idle');
    };

    const handleVerify = () => {
        setStatus('checking');
        
        setTimeout(() => {
            let allCorrect = true;
            for (const blankKey of quiz.blanks) {
                const userVal = (inputs[blankKey] || '').trim().toLowerCase();
                const correctVal = (quiz.answers[blankKey] || '').trim().toLowerCase();
                if (userVal !== correctVal) {
                    allCorrect = false;
                    break;
                }
            }

            if (allCorrect) {
                setStatus('success');
                onComplete();
            } else {
                setStatus('error');
            }
        }, 600);
    };

    // Parse the code template and inject interactive inputs
    const renderInteractiveCode = () => {
        let renderedHtml = [];
        let remainingCode = quiz.code_template;
        let lastIndex = 0;

        // A simple parser to find {0}, {1}, etc and replace them with inputs
        const regex = /\{(\d+)\}/g;
        let match;
        let elements = [];
        let keyCounter = 0;

        while ((match = regex.exec(remainingCode)) !== null) {
            // Push text before the match
            if (match.index > lastIndex) {
                elements.push(<span key={`text-${keyCounter++}`}>{remainingCode.substring(lastIndex, match.index)}</span>);
            }

            const blankKey = match[0];
            const size = Math.max(8, (quiz.answers[blankKey] || '').length + 2);
            
            elements.push(
                <input
                    key={`input-${blankKey}`}
                    type="text"
                    value={inputs[blankKey] || ''}
                    onChange={(e) => handleInputChange(blankKey, e.target.value)}
                    className={`inline-block mx-1 px-2 py-0.5 text-center font-mono text-[13px] bg-white/10 border-b-2 outline-none transition-colors ${
                        status === 'success' ? 'border-green-400 text-green-400' :
                        status === 'error' ? 'border-red-400 text-red-400' :
                        'border-white/40 text-white focus:border-white focus:bg-white/20'
                    }`}
                    style={{ width: `${size}ch` }}
                    disabled={status === 'success' || status === 'checking'}
                    autoComplete="off"
                    spellCheck="false"
                />
            );

            lastIndex = regex.lastIndex;
        }

        // Push remaining text
        if (lastIndex < remainingCode.length) {
            elements.push(<span key={`text-${keyCounter++}`}>{remainingCode.substring(lastIndex)}</span>);
        }

        return <div className="whitespace-pre-wrap">{elements}</div>;
    };

    return (
        <div className="bento-card mt-12 p-1 overflow-hidden relative">
            {/* Header */}
            <div className="bg-white/5 px-6 py-4 border-b border-white/5 flex items-center gap-3">
                <div className="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center">
                    <HiOutlineTerminal className="w-4 h-4 text-white" />
                </div>
                <div>
                    <h3 className="text-sm font-bold text-white tracking-tight">Interactive Knowledge Check</h3>
                    <p className="text-[11px] text-white/50 uppercase tracking-widest">{quiz.instruction}</p>
                </div>
            </div>

            {/* Terminal Body */}
            <div className="p-6 bg-[#050505]">
                <div className="font-mono text-[13px] text-white/80 leading-loose">
                    {renderInteractiveCode()}
                </div>
            </div>

            {/* Footer Action */}
            <div className="bg-white/5 px-6 py-4 border-t border-white/5 flex items-center justify-between">
                <div className="text-[11px] uppercase tracking-widest font-mono">
                    {status === 'idle' && <span className="text-white/40">Awaiting Input...</span>}
                    {status === 'checking' && <span className="text-yellow-400 animate-pulse">Verifying Syntax...</span>}
                    {status === 'success' && <span className="text-green-400 flex items-center gap-2"><HiOutlineCheck /> Validation Passed</span>}
                    {status === 'error' && <span className="text-red-400">Syntax Error Detected. Try Again.</span>}
                </div>
                <button
                    onClick={handleVerify}
                    disabled={status === 'success' || status === 'checking'}
                    className={`px-6 py-2 rounded-full text-[11px] uppercase tracking-widest font-bold transition-all ${
                        status === 'success' ? 'bg-green-500 text-black' :
                        status === 'checking' ? 'bg-white/20 text-white/50' :
                        'bg-white text-black hover:scale-105'
                    }`}
                >
                    {status === 'success' ? 'Secured' : 'Execute Check'}
                </button>
            </div>

            {/* Success Overlay */}
            <AnimatePresence>
                {status === 'success' && (
                    <motion.div 
                        initial={{ opacity: 0 }} animate={{ opacity: 1 }}
                        className="absolute inset-0 bg-green-500/10 pointer-events-none mix-blend-screen" 
                    />
                )}
            </AnimatePresence>
        </div>
    );
}

export default function TutorialShow({ tutorial, progress, prevTutorial, nextTutorial }) {
    const handleProgress = (status) => {
        router.post(`/tutorials/${tutorial.id}/progress`, { status }, { preserveScroll: true });
    };

    const handleQuizCompletion = () => {
        // Automatically mark as completed if quiz is successfully passed, provided they are not already completed
        if (progress?.status !== 'completed') {
            handleProgress('completed');
        }
    };

    return (
        <AppLayout title={tutorial.title}>
            <Head title={tutorial.title} />

            <div className="mb-8">
                <Link href="/tutorials" className="text-[11px] text-white/40 uppercase tracking-widest hover:text-white transition-colors border border-white/10 px-3 py-1.5 rounded-full inline-flex items-center gap-2">
                    <HiOutlineArrowLeft className="w-3 h-3" /> Back to Matrix
                </Link>
            </div>

            <div className="grid grid-cols-1 lg:grid-cols-4 gap-6">
                {/* Main Content */}
                <motion.div initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} className="lg:col-span-3">
                    <article className="bento-card p-6 md:p-12 mb-6 relative overflow-hidden">
                        {/* Background subtle glow if completed */}
                        {progress?.status === 'completed' && (
                            <div className="absolute top-0 right-0 w-full h-[60%] bg-gradient-to-b from-green-500/5 to-transparent pointer-events-none" />
                        )}

                        <header className="mb-12 border-b border-white/10 pb-8 relative z-10">
                            <div className="flex items-center gap-3 mb-6">
                                <span className="text-[10px] text-white/50 uppercase tracking-widest border border-white/10 px-2.5 py-1 rounded-full">
                                    {tutorial.level}
                                </span>
                                <span className="text-[10px] text-white/30 uppercase tracking-widest font-mono">
                                    {tutorial.estimated_minutes} min duration
                                </span>
                            </div>
                            <h1 className="text-3xl md:text-5xl font-black tracking-tighter text-white mb-4 leading-tight">
                                {tutorial.title}
                            </h1>
                            <p className="text-lg text-white/40 leading-relaxed max-w-2xl">
                                {tutorial.description}
                            </p>
                        </header>

                        <div className="tutorial-content relative z-10" dangerouslySetInnerHTML={{ __html: tutorial.content }} />

                        {/* Interactive Quiz Injection */}
                        {tutorial.quiz && (
                            <InteractiveQuiz 
                                quiz={typeof tutorial.quiz === 'string' ? JSON.parse(tutorial.quiz) : tutorial.quiz} 
                                onComplete={handleQuizCompletion} 
                            />
                        )}
                    </article>

                    {/* Nav */}
                    <div className="flex flex-col sm:flex-row items-center justify-between gap-4">
                        {prevTutorial ? (
                            <Link href={`/tutorials/${prevTutorial.id}`} className="bento-card p-4 flex items-center gap-4 w-full sm:w-[48%] group">
                                <div className="w-8 h-8 rounded-full border border-white/10 flex items-center justify-center shrink-0 group-hover:bg-white/10 transition-colors">
                                    <HiOutlineArrowLeft className="w-4 h-4 text-white/50" />
                                </div>
                                <div className="min-w-0">
                                    <p className="text-[10px] text-white/30 uppercase tracking-widest mb-1">Previous Module</p>
                                    <p className="text-[13px] font-medium text-white/80 truncate">{prevTutorial.title}</p>
                                </div>
                            </Link>
                        ) : <div className="w-full sm:w-[48%]" />}

                        {nextTutorial ? (
                            <Link href={`/tutorials/${nextTutorial.id}`} className="bento-card p-4 flex items-center justify-end gap-4 w-full sm:w-[48%] group text-right">
                                <div className="min-w-0">
                                    <p className="text-[10px] text-white/30 uppercase tracking-widest mb-1">Next Module</p>
                                    <p className="text-[13px] font-medium text-white/80 truncate">{nextTutorial.title}</p>
                                </div>
                                <div className="w-8 h-8 rounded-full border border-white/10 flex items-center justify-center shrink-0 group-hover:bg-white/10 transition-colors">
                                    <HiOutlineArrowRight className="w-4 h-4 text-white/50" />
                                </div>
                            </Link>
                        ) : <div className="w-full sm:w-[48%]" />}
                    </div>
                </motion.div>

                {/* Sidebar */}
                <motion.div initial={{ opacity: 0, x: 20 }} animate={{ opacity: 1, x: 0 }} transition={{ delay: 0.1 }} className="lg:col-span-1">
                    <div className="sticky top-24">
                        <div className="bento-card p-6">
                            <h3 className="text-[12px] font-bold text-white/60 uppercase tracking-widest mb-6">Telemetry Status</h3>
                            
                            <div className="mb-6 flex items-center gap-3">
                                <div className={`w-3 h-3 rounded-full ${
                                    progress?.status === 'completed' ? 'bg-green-400 shadow-[0_0_15px_rgba(7ade80,0.5)]' :
                                    progress?.status === 'in_progress' ? 'bg-white/40' : 'bg-transparent border border-white/20'
                                }`} />
                                <span className="text-[13px] text-white/80 font-medium">
                                    {progress?.status === 'completed' ? 'Secured' :
                                     progress?.status === 'in_progress' ? 'Monitoring' : 'Offline'}
                                </span>
                            </div>

                            <div className="space-y-3">
                                {!progress && (
                                    <button onClick={() => handleProgress('in_progress')} className="btn-outline w-full justify-center">
                                        Initialize Protocol
                                    </button>
                                )}
                                {progress?.status === 'in_progress' && !tutorial.quiz && (
                                    <button onClick={() => handleProgress('completed')} className="btn-brutal w-full flex items-center justify-center gap-2">
                                        <HiOutlineCheck className="w-4 h-4" /> Finalize
                                    </button>
                                )}
                                {progress?.status === 'in_progress' && tutorial.quiz && (
                                    <p className="text-[10px] text-white/40 text-center uppercase tracking-widest mt-4">
                                        ↳ Complete the interactive check to finalize
                                    </p>
                                )}
                                {progress?.status === 'completed' && (
                                    <button onClick={() => handleProgress('in_progress')} className="btn-outline w-full justify-center text-white/50 hover:text-white border-none mt-2">
                                        Re-evaluate
                                    </button>
                                )}
                            </div>
                        </div>
                    </div>
                </motion.div>
            </div>
        </AppLayout>
    );
}
