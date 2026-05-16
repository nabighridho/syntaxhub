import AppLayout from '@/Layouts/AppLayout';
import { Head, Link, router } from '@inertiajs/react';
import { motion, AnimatePresence } from 'framer-motion';
import {
    HiOutlineArrowLeft, HiOutlineArrowRight, HiOutlineCheck,
    HiOutlineTerminal, HiOutlineBookmark, HiOutlineChevronLeft,
    HiOutlineChevronRight,
} from 'react-icons/hi';
import { useState, useMemo, useCallback, useEffect } from 'react';

/* ================================================================
   INTERACTIVE QUIZ COMPONENT (supports multi-quiz per tutorial)
   ================================================================ */
function InteractiveQuiz({ quiz, onComplete, quizIndex, totalQuizzes }) {
    if (!quiz) return null;

    const [inputs, setInputs] = useState({});
    const [status, setStatus] = useState('idle');

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
                if (userVal !== correctVal) { allCorrect = false; break; }
            }
            setStatus(allCorrect ? 'success' : 'error');
            if (allCorrect) onComplete();
        }, 600);
    };

    const renderInteractiveCode = () => {
        let remainingCode = quiz.code_template;
        const regex = /\{(\d+)\}/g;
        let match, elements = [], lastIndex = 0, k = 0;

        while ((match = regex.exec(remainingCode)) !== null) {
            if (match.index > lastIndex)
                elements.push(<span key={`t-${k++}`}>{remainingCode.substring(lastIndex, match.index)}</span>);

            const blankKey = match[0];
            const size = Math.max(8, (quiz.answers[blankKey] || '').length + 2);
            elements.push(
                <input key={`i-${blankKey}`} type="text" value={inputs[blankKey] || ''}
                    onChange={(e) => handleInputChange(blankKey, e.target.value)}
                    className={`inline-block mx-1 px-2 py-0.5 text-center font-mono text-[13px] bg-white/10 border-b-2 outline-none transition-colors ${
                        status === 'success' ? 'border-green-400 text-green-400' :
                        status === 'error' ? 'border-red-400 text-red-400' :
                        'border-white/40 text-white focus:border-white focus:bg-white/20'
                    }`}
                    style={{ width: `${size}ch` }}
                    disabled={status === 'success' || status === 'checking'}
                    autoComplete="off" spellCheck="false"
                />
            );
            lastIndex = regex.lastIndex;
        }
        if (lastIndex < remainingCode.length)
            elements.push(<span key={`t-${k++}`}>{remainingCode.substring(lastIndex)}</span>);

        return <div className="whitespace-pre-wrap">{elements}</div>;
    };

    return (
        <div className="relative">
            {/* Quiz header badge */}
            <div className="flex items-center gap-2 mb-6">
                <span className="text-[10px] uppercase tracking-widest text-white/40 font-mono">
                    Soal {quizIndex + 1} / {totalQuizzes}
                </span>
            </div>

            <div className="bento-card p-1 overflow-hidden relative">
                <div className="bg-white/5 px-6 py-4 border-b border-white/5 flex items-center gap-3">
                    <div className="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center">
                        <HiOutlineTerminal className="w-4 h-4 text-white" />
                    </div>
                    <div>
                        <h3 className="text-sm font-bold text-white tracking-tight">Interactive Knowledge Check</h3>
                        <p className="text-[11px] text-white/50 uppercase tracking-widest">{quiz.instruction}</p>
                    </div>
                </div>

                <div className="p-6 bg-[#050505]">
                    <div className="font-mono text-[13px] text-white/80 leading-loose">
                        {renderInteractiveCode()}
                    </div>
                </div>

                <div className="bg-white/5 px-6 py-4 border-t border-white/5 flex items-center justify-between">
                    <div className="text-[11px] uppercase tracking-widest font-mono">
                        {status === 'idle' && <span className="text-white/40">Awaiting Input...</span>}
                        {status === 'checking' && <span className="text-yellow-400 animate-pulse">Verifying Syntax...</span>}
                        {status === 'success' && <span className="text-green-400 flex items-center gap-2"><HiOutlineCheck /> Validation Passed</span>}
                        {status === 'error' && <span className="text-red-400">Syntax Error Detected. Try Again.</span>}
                    </div>
                    <button onClick={handleVerify}
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

                <AnimatePresence>
                    {status === 'success' && (
                        <motion.div initial={{ opacity: 0 }} animate={{ opacity: 1 }}
                            className="absolute inset-0 bg-green-500/10 pointer-events-none mix-blend-screen" />
                    )}
                </AnimatePresence>
            </div>
        </div>
    );
}

/* ================================================================
   BOOK PAGE-TURN ANIMATION VARIANTS
   ================================================================ */
const pageVariants = {
    enter: (direction) => ({
        rotateY: direction > 0 ? 45 : -45,
        x: direction > 0 ? 300 : -300,
        opacity: 0,
        scale: 0.92,
        filter: 'brightness(0.6)',
    }),
    center: {
        rotateY: 0,
        x: 0,
        opacity: 1,
        scale: 1,
        filter: 'brightness(1)',
    },
    exit: (direction) => ({
        rotateY: direction > 0 ? -45 : 45,
        x: direction > 0 ? -300 : 300,
        opacity: 0,
        scale: 0.92,
        filter: 'brightness(0.6)',
    }),
};

const pageTransition = {
    type: 'tween',
    duration: 0.5,
    ease: [0.4, 0.0, 0.2, 1],
};

/* ================================================================
   MAIN COMPONENT
   ================================================================ */
export default function TutorialShow({ tutorial, progress, prevTutorial, nextTutorial, isBookmarked: initialBookmarked, bookmarkedSlide }) {
    // Read initial slide from URL query
    const urlParams = new URLSearchParams(window.location.search);
    const initialSlide = parseInt(urlParams.get('slide')) || 0;

    const [currentSlide, setCurrentSlide] = useState(initialSlide);
    const [direction, setDirection] = useState(0);
    const [isBookmarked, setIsBookmarked] = useState(initialBookmarked || false);
    const [completedQuizzes, setCompletedQuizzes] = useState(new Set());

    /* ----- Parse content into slides ----- */
    const slides = useMemo(() => {
        const result = [];
        const raw = tutorial.content || '';

        // Split HTML at <h2> boundaries to create separate content slides
        const sections = raw.split(/(?=<h2>)/);
        sections.forEach((section) => {
            const trimmed = section.trim();
            if (trimmed) {
                result.push({ type: 'content', html: trimmed });
            }
        });

        // If no h2 splits found, use entire content as one slide
        if (result.length === 0 && raw.trim()) {
            result.push({ type: 'content', html: raw });
        }

        // Append quiz slides at the end
        const quizData = tutorial.quiz;
        if (quizData) {
            // Support both single quiz object and array of quizzes
            const quizzes = Array.isArray(quizData) && quizData[0]?.instruction
                ? quizData
                : (quizData?.instruction ? [quizData] : []);

            quizzes.forEach((q, i) => {
                result.push({
                    type: 'quiz',
                    quiz: typeof q === 'string' ? JSON.parse(q) : q,
                    quizIndex: i,
                    totalQuizzes: quizzes.length,
                });
            });
        }

        return result;
    }, [tutorial]);

    const totalSlides = slides.length;
    const currentSlideData = slides[currentSlide];

    /* ----- Navigation handlers ----- */
    const goNext = useCallback(() => {
        if (currentSlide < totalSlides - 1) {
            setDirection(1);
            setCurrentSlide(prev => prev + 1);
        }
    }, [currentSlide, totalSlides]);

    const goPrev = useCallback(() => {
        if (currentSlide > 0) {
            setDirection(-1);
            setCurrentSlide(prev => prev - 1);
        }
    }, [currentSlide]);

    /* ----- Bookmark toggle ----- */
    const toggleBookmark = () => {
        router.post('/bookmarks/toggle', {
            bookmarkable_type: 'tutorial',
            bookmarkable_id: tutorial.id,
            meta: { slide_index: currentSlide },
        }, {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                // If it was already bookmarked on this slide, it toggles off. Otherwise it toggles on or updates.
                // Inertia will refresh props so isBookmarked and bookmarkedSlide will be updated automatically.
                if (isBookmarked && bookmarkedSlide === currentSlide) {
                    setIsBookmarked(false);
                } else {
                    setIsBookmarked(true);
                }
            },
        });
    };

    /* ----- Progress handlers ----- */
    const handleProgress = (status) => {
        router.post(`/tutorials/${tutorial.id}/progress`, { status }, { preserveScroll: true });
    };

    const handleQuizCompletion = (quizIdx) => {
        setCompletedQuizzes(prev => new Set(prev).add(quizIdx));

        // Check if all quizzes are completed
        const quizSlides = slides.filter(s => s.type === 'quiz');
        const newCompleted = new Set(completedQuizzes).add(quizIdx);
        if (newCompleted.size >= quizSlides.length && progress?.status !== 'completed') {
            handleProgress('completed');
        }
    };

    /* ----- Keyboard navigation ----- */
    useEffect(() => {
        const handler = (e) => {
            if (e.target.tagName === 'INPUT') return; // Don't navigate when typing in quiz
            if (e.key === 'ArrowRight') goNext();
            if (e.key === 'ArrowLeft') goPrev();
        };
        window.addEventListener('keydown', handler);
        return () => window.removeEventListener('keydown', handler);
    }, [goNext, goPrev]);

    /* ----- Count content vs quiz slides ----- */
    const contentSlideCount = slides.filter(s => s.type === 'content').length;
    const quizSlideCount = slides.filter(s => s.type === 'quiz').length;

    return (
        <AppLayout title={tutorial.title}>
            <Head title={tutorial.title} />

            <div className="mb-8 flex items-center justify-between">
                <Link href="/tutorials" className="text-[11px] text-white/40 uppercase tracking-widest hover:text-white transition-colors border border-white/10 px-3 py-1.5 rounded-full inline-flex items-center gap-2">
                    <HiOutlineArrowLeft className="w-3 h-3" /> Back to Matrix
                </Link>

                {/* Bookmark Button (top-level) */}
                <button onClick={toggleBookmark}
                    className={`flex items-center gap-2 px-4 py-2 rounded-full border text-[11px] uppercase tracking-widest font-bold transition-all ${
                        isBookmarked && bookmarkedSlide === currentSlide
                            ? 'bg-yellow-500/20 border-yellow-500/40 text-yellow-400 hover:bg-yellow-500/30'
                            : isBookmarked
                            ? 'bg-blue-500/20 border-blue-500/40 text-blue-400 hover:bg-blue-500/30'
                            : 'bg-white/5 border-white/10 text-white/50 hover:text-white hover:border-white/30'
                    }`}
                >
                    <HiOutlineBookmark className={`w-4 h-4 ${isBookmarked && bookmarkedSlide === currentSlide ? 'fill-yellow-400' : ''}`} />
                    {isBookmarked && bookmarkedSlide === currentSlide ? 'Bookmarked Here' : isBookmarked ? 'Move Bookmark Here' : 'Bookmark'}
                </button>
            </div>

            <div className="grid grid-cols-1 lg:grid-cols-4 gap-6">
                {/* Main Content — Book Viewer */}
                <motion.div initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} className="lg:col-span-3">
                    <article className="bento-card relative overflow-hidden mb-6" style={{ perspective: '1200px' }}>
                        {/* Completed glow */}
                        {progress?.status === 'completed' && (
                            <div className="absolute top-0 right-0 w-full h-[60%] bg-gradient-to-b from-green-500/5 to-transparent pointer-events-none z-0" />
                        )}

                        {/* Header - always visible */}
                        <header className="p-6 md:px-12 md:pt-10 pb-0 border-b border-white/10 relative z-10">
                            <div className="flex items-center gap-3 mb-4">
                                <span className="text-[10px] text-white/50 uppercase tracking-widest border border-white/10 px-2.5 py-1 rounded-full">
                                    {tutorial.level}
                                </span>
                                <span className="text-[10px] text-white/30 uppercase tracking-widest font-mono">
                                    {tutorial.estimated_minutes} min duration
                                </span>
                            </div>
                            <h1 className="text-2xl md:text-4xl font-black tracking-tighter text-white mb-3 leading-tight">
                                {tutorial.title}
                            </h1>
                            <p className="text-sm text-white/40 leading-relaxed max-w-2xl mb-6">
                                {tutorial.description}
                            </p>

                            {/* Slide Progress Bar */}
                            <div className="flex items-center gap-2 pb-6">
                                <div className="flex-1 h-[3px] bg-white/10 rounded-full overflow-hidden">
                                    <motion.div
                                        className="h-full bg-white/60 rounded-full"
                                        animate={{ width: `${((currentSlide + 1) / totalSlides) * 100}%` }}
                                        transition={{ duration: 0.3, ease: 'easeOut' }}
                                    />
                                </div>
                                <span className="text-[10px] text-white/40 font-mono shrink-0">
                                    {currentSlide + 1} / {totalSlides}
                                </span>
                            </div>
                        </header>

                        {/* Slide Content with Book Animation */}
                        <div className="relative overflow-hidden min-h-[400px]" style={{ perspective: '1200px' }}>
                            <AnimatePresence mode="wait" custom={direction}>
                                <motion.div
                                    key={currentSlide}
                                    custom={direction}
                                    variants={pageVariants}
                                    initial="enter"
                                    animate="center"
                                    exit="exit"
                                    transition={pageTransition}
                                    className="p-6 md:px-12 md:py-10 relative z-10"
                                    style={{
                                        transformStyle: 'preserve-3d',
                                        backfaceVisibility: 'hidden',
                                    }}
                                >
                                    {/* Page shadow overlay for depth */}
                                    <div className="book-page-shadow pointer-events-none" />

                                    {currentSlideData?.type === 'content' ? (
                                        <div className="tutorial-content"
                                            dangerouslySetInnerHTML={{ __html: currentSlideData.html }}
                                        />
                                    ) : currentSlideData?.type === 'quiz' ? (
                                        <InteractiveQuiz
                                            quiz={currentSlideData.quiz}
                                            quizIndex={currentSlideData.quizIndex}
                                            totalQuizzes={currentSlideData.totalQuizzes}
                                            onComplete={() => handleQuizCompletion(currentSlideData.quizIndex)}
                                        />
                                    ) : null}
                                </motion.div>
                            </AnimatePresence>
                        </div>

                        {/* Slide Navigation Controls */}
                        <div className="px-6 md:px-12 py-5 border-t border-white/5 flex items-center justify-between relative z-10 bg-[#0d0d0f]/80 backdrop-blur-sm">
                            <button
                                onClick={goPrev}
                                disabled={currentSlide === 0}
                                className={`flex items-center gap-2 px-4 py-2.5 rounded-xl text-[12px] font-semibold uppercase tracking-wider transition-all ${
                                    currentSlide === 0
                                        ? 'text-white/15 cursor-not-allowed'
                                        : 'text-white/60 hover:text-white hover:bg-white/5 active:scale-95'
                                }`}
                            >
                                <HiOutlineChevronLeft className="w-4 h-4" />
                                <span className="hidden sm:inline">Sebelumnya</span>
                            </button>

                            {/* Slide dots with type indicators */}
                            <div className="flex items-center gap-1.5 max-w-[200px] overflow-x-auto scrollbar-none">
                                {slides.map((slide, i) => (
                                    <button
                                        key={i}
                                        onClick={() => { setDirection(i > currentSlide ? 1 : -1); setCurrentSlide(i); }}
                                        className={`shrink-0 rounded-full transition-all duration-300 ${
                                            i === currentSlide
                                                ? (slide.type === 'quiz'
                                                    ? 'w-6 h-2.5 bg-yellow-400'
                                                    : 'w-6 h-2.5 bg-white')
                                                : (slide.type === 'quiz'
                                                    ? 'w-2.5 h-2.5 bg-yellow-400/30 hover:bg-yellow-400/50'
                                                    : 'w-2.5 h-2.5 bg-white/20 hover:bg-white/40')
                                        }`}
                                        title={slide.type === 'quiz' ? `Quiz ${slide.quizIndex + 1}` : `Slide ${i + 1}`}
                                    />
                                ))}
                            </div>

                            <button
                                onClick={goNext}
                                disabled={currentSlide === totalSlides - 1}
                                className={`flex items-center gap-2 px-4 py-2.5 rounded-xl text-[12px] font-semibold uppercase tracking-wider transition-all ${
                                    currentSlide === totalSlides - 1
                                        ? 'text-white/15 cursor-not-allowed'
                                        : 'text-white/60 hover:text-white hover:bg-white/5 active:scale-95'
                                }`}
                            >
                                <span className="hidden sm:inline">Selanjutnya</span>
                                <HiOutlineChevronRight className="w-4 h-4" />
                            </button>
                        </div>
                    </article>

                    {/* Tutorial Nav (Prev/Next Tutorial) */}
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
                    <div className="sticky top-24 space-y-4">
                        {/* Telemetry Status */}
                        <div className="bento-card p-6">
                            <h3 className="text-[12px] font-bold text-white/60 uppercase tracking-widest mb-6">Telemetry Status</h3>

                            <div className="mb-6 flex items-center gap-3">
                                <div className={`w-3 h-3 rounded-full ${
                                    progress?.status === 'completed' ? 'bg-green-400 shadow-[0_0_15px_rgba(74,222,128,0.5)]' :
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
                                {progress?.status === 'in_progress' && quizSlideCount === 0 && (
                                    <button onClick={() => handleProgress('completed')} className="btn-brutal w-full flex items-center justify-center gap-2">
                                        <HiOutlineCheck className="w-4 h-4" /> Finalize
                                    </button>
                                )}
                                {progress?.status === 'in_progress' && quizSlideCount > 0 && (
                                    <p className="text-[10px] text-white/40 text-center uppercase tracking-widest mt-4">
                                        ↳ Complete all quizzes to finalize
                                    </p>
                                )}
                                {progress?.status === 'completed' && (
                                    <button onClick={() => handleProgress('in_progress')} className="btn-outline w-full justify-center text-white/50 hover:text-white border-none mt-2">
                                        Re-evaluate
                                    </button>
                                )}
                            </div>
                        </div>

                        {/* Slide Map */}
                        <div className="bento-card p-6">
                            <h3 className="text-[12px] font-bold text-white/60 uppercase tracking-widest mb-4">Peta Slide</h3>
                            <div className="space-y-1.5 max-h-[300px] overflow-y-auto pr-1">
                                {slides.map((slide, i) => {
                                    // Extract title from content slide
                                    let label = '';
                                    if (slide.type === 'content') {
                                        const match = slide.html.match(/<h2[^>]*>(.*?)<\/h2>/);
                                        label = match ? match[1].replace(/<[^>]+>/g, '') : `Slide ${i + 1}`;
                                    } else {
                                        label = `🧪 Quiz ${slide.quizIndex + 1}`;
                                    }

                                    return (
                                        <button
                                            key={i}
                                            onClick={() => { setDirection(i > currentSlide ? 1 : -1); setCurrentSlide(i); }}
                                            className={`w-full text-left px-3 py-2 rounded-lg text-[12px] transition-all truncate ${
                                                i === currentSlide
                                                    ? 'bg-white/10 text-white font-semibold border border-white/10'
                                                    : 'text-white/40 hover:text-white/70 hover:bg-white/5'
                                            }`}
                                        >
                                            <span className="text-[10px] text-white/30 font-mono mr-2">{String(i + 1).padStart(2, '0')}</span>
                                            {label}
                                        </button>
                                    );
                                })}
                            </div>
                        </div>

                        {/* Keyboard hint */}
                        <div className="text-center text-[10px] text-white/20 uppercase tracking-widest">
                            ← → Keyboard Navigation
                        </div>
                    </div>
                </motion.div>
            </div>
        </AppLayout>
    );
}
