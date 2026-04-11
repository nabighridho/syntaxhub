import { Head, Link } from '@inertiajs/react';
import { motion, useScroll, useTransform } from 'framer-motion';
import { useRef } from 'react';
import { HiOutlineMap } from 'react-icons/hi';

const fadeUp = {
    hidden: { opacity: 0, y: 30 },
    visible: (d = 0) => ({ opacity: 1, y: 0, transition: { delay: d, duration: 0.8, ease: [0.16, 1, 0.3, 1] } }),
};

export default function Welcome({ canLogin, canRegister }) {
    const heroRef = useRef(null);
    const { scrollYProgress } = useScroll({ target: heroRef, offset: ['start start', 'end start'] });
    const y1 = useTransform(scrollYProgress, [0, 1], [0, 150]);
    const y2 = useTransform(scrollYProgress, [0, 1], [0, -100]);
    const opacity = useTransform(scrollYProgress, [0, 0.5], [1, 0]);

    return (
        <div className="bg-[#0a0a0b] text-white min-h-screen overflow-hidden selection:bg-white/20">
            <div className="noise-bg"></div>
            
            {/* Ambient Backgrounds */}
            <div className="absolute top-[-10%] left-[-10%] w-[600px] h-[600px] bg-sky-500/10 rounded-full blur-[100px] pointer-events-none mix-blend-screen"></div>
            <div className="absolute top-[40%] right-[-10%] w-[500px] h-[500px] bg-purple-500/10 rounded-full blur-[100px] pointer-events-none mix-blend-screen"></div>

            {/* Navbar */}
            <nav className="fixed top-0 w-full z-50 p-6 mix-blend-difference pointer-events-none">
                <div className="max-w-7xl mx-auto flex items-center justify-between pointer-events-auto">
                    <div className="flex items-center gap-2">
                        <img src="/logo.png" alt="Syntaxhub Logo" className="w-8 h-8 object-contain mix-blend-screen" />
                        <span className="font-bold tracking-tight text-white">Syntaxhub.</span>
                    </div>
                    <div className="flex items-center gap-6">
                        {canLogin && <Link href={route('login')} className="text-[13px] font-medium tracking-wide uppercase hover:opacity-70 transition-opacity text-white">Login</Link>}
                        {canRegister && <Link href={route('register')} className="btn-brutal text-[13px] uppercase tracking-wide px-5 py-2">Get Started</Link>}
                    </div>
                </div>
            </nav>

            {/* Hero Section */}
            <section ref={heroRef} className="relative min-h-screen flex items-center justify-center px-4 pt-20">
                <motion.div style={{ y: y1, opacity }} className="relative z-10 w-full max-w-6xl mx-auto text-center flex flex-col items-center">
                    
                    <motion.div initial="hidden" animate="visible" variants={fadeUp} custom={0.1}>
                        <p className="text-[10px] sm:text-[12px] font-bold text-white/40 uppercase tracking-[0.3em] mb-8">
                            Interactive Learning Protocol
                        </p>
                    </motion.div>

                    <h1 className="text-[10vw] sm:text-[8vw] lg:text-[7rem] leading-[0.9] font-black tracking-tighter mb-6">
                        <motion.div className="overflow-hidden">
                            <motion.span className="inline-block" initial={{ y: "100%" }} animate={{ y: 0 }} transition={{ duration: 1, ease: [0.16, 1, 0.3, 1] }}>Master</motion.span>{' '}
                            <motion.span className="inline-block text-white/40" initial={{ y: "100%" }} animate={{ y: 0 }} transition={{ duration: 1, delay: 0.1, ease: [0.16, 1, 0.3, 1] }}>Network</motion.span>
                        </motion.div>
                        <motion.div className="overflow-hidden">
                            <motion.span className="inline-block" initial={{ y: "100%" }} animate={{ y: 0 }} transition={{ duration: 1, delay: 0.2, ease: [0.16, 1, 0.3, 1] }}>Configuration.</motion.span>
                        </motion.div>
                    </h1>

                    <motion.p initial="hidden" animate="visible" variants={fadeUp} custom={0.4} className="text-xl sm:text-2xl text-white/50 max-w-2xl font-light tracking-wide mb-12">
                        Designed for vocational students. Experience a brutalist, distraction-free environment to code, simulate, and learn.
                    </motion.p>

                    <motion.div initial="hidden" animate="visible" variants={fadeUp} custom={0.5} className="flex gap-4">
                        <Link href={canRegister ? route('register') : '#'} className="btn-brutal text-lg px-8 py-4">Start Executing</Link>
                    </motion.div>
                </motion.div>

                {/* Floating Elements (Parallax) */}
                <motion.div style={{ y: y2 }} className="absolute bottom-10 left-10 hidden lg:block opacity-40 mix-blend-screen pointer-events-none">
                    <pre className="text-[11px] font-mono leading-relaxed text-sky-300">
{`Router(config)# interface g0/1
Router(config-if)# ip addr 192.168.1.1 255.255.255.0
Router(config-if)# no shut
*Jul 11 14:22:15: %LINK-3-UPDOWN: Interface G0/1, state to up`}
                    </pre>
                </motion.div>
            </section>

            {/* Bento Grid Section */}
            <section className="py-32 px-4 relative z-20 bg-[#0a0a0b]">
                <div className="max-w-6xl mx-auto">
                    <motion.h2 
                        initial="hidden" whileInView="visible" viewport={{ once: true, margin: "-100px" }} variants={fadeUp}
                        className="text-4xl md:text-6xl font-bold tracking-tighter mb-16 text-center text-white"
                    >
                        Tools <span className="text-white/30">for the modern</span> <br/>sysadmin.
                    </motion.h2>

                    <div className="grid grid-cols-1 md:grid-cols-3 gap-4 md:grid-rows-2 md:h-[600px]">
                        
                        {/* Card 1 - Large */}
                        <motion.div 
                            initial="hidden" whileInView="visible" viewport={{ once: true }} variants={fadeUp} custom={0.1}
                            className="bento-card md:col-span-2 p-8 flex flex-col justify-end min-h-[300px] relative"
                        >
                            <div className="absolute top-0 right-0 w-full h-[60%] bg-gradient-to-b from-blue-500/10 to-transparent pointer-events-none" />
                            <div className="relative z-10 w-full overflow-hidden mb-6 rounded-xl border border-white/10 bg-black/50 p-4">
                                <pre className="text-sm font-mono text-green-400">
<span className="text-white/30">1</span>  function connect() {"{"}<br/>
<span className="text-white/30">2</span>      return fetch('/api/ssh', {"{"} method: 'POST' {"}"});<br/>
<span className="text-white/30">3</span>  {"}"}
                                </pre>
                            </div>
                            <h3 className="text-2xl font-bold mb-2 text-white">Code Playground</h3>
                            <p className="text-white/50 text-sm">Write, execute, and preview structural code within sandbox environments directly in your browser.</p>
                        </motion.div>

                        {/* Card 2 */}
                        <motion.div 
                            initial="hidden" whileInView="visible" viewport={{ once: true }} variants={fadeUp} custom={0.2}
                            className="bento-card p-8 flex flex-col justify-between"
                        >
                            <div className="w-12 h-12 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-2xl mb-8">
                                <HiOutlineMap className="w-6 h-6 text-white/60" />
                            </div>
                            <div>
                                <h3 className="text-xl font-bold mb-2 text-white">Guided Roads</h3>
                                <p className="text-white/50 text-sm">Strictly curated learning paths. From basics to advanced routing concepts in a minimal UI.</p>
                            </div>
                        </motion.div>

                        {/* Card 3 */}
                        <motion.div 
                            initial="hidden" whileInView="visible" viewport={{ once: true }} variants={fadeUp} custom={0.3}
                            className="bento-card p-8 flex flex-col justify-between"
                        >
                            <div className="flex items-end gap-2 mb-8 h-20 opacity-50">
                                <div className="w-4 h-[40%] bg-white rounded-t-sm" />
                                <div className="w-4 h-[70%] bg-white rounded-t-sm" />
                                <div className="w-4 h-[100%] bg-white rounded-t-sm" />
                            </div>
                            <div>
                                <h3 className="text-xl font-bold mb-2 text-white">Telemetry</h3>
                                <p className="text-white/50 text-sm">Deep analytics of your learning velocity and completion distribution.</p>
                            </div>
                        </motion.div>

                        {/* Card 4 - Long */}
                        <motion.div 
                            initial="hidden" whileInView="visible" viewport={{ once: true }} variants={fadeUp} custom={0.4}
                            className="bento-card md:col-span-2 p-8 flex flex-col md:flex-row items-center justify-between gap-8 bg-gradient-to-br from-[#121214] to-black"
                        >
                            <div className="flex-1">
                                <h3 className="text-2xl font-bold mb-2 text-white">Snippet Library</h3>
                                <p className="text-white/50 text-sm mb-6 max-w-sm">
                                    Instantly access annotated configuration syntax. Copy, paste, and deeply understand the mechanics of every line.
                                </p>
                                <Link href="/snippets" className="btn-outline">Explore Library</Link>
                            </div>
                            <div className="w-32 h-32 relative opacity-50">
                                <div className="absolute inset-0 border border-white/20 rounded-xl transform rotate-3 transition-transform hover:rotate-6"></div>
                                <div className="absolute inset-0 border border-white/10 hover:border-white/30 rounded-xl bg-white/5 backdrop-blur-md transform -rotate-3 transition-transform hover:-rotate-1 flex items-center justify-center font-mono text-xs">
                                    {'</>'}
                                </div>
                            </div>
                        </motion.div>

                    </div>
                </div>
            </section>

            {/* Big Footer */}
            <footer className="pt-32 pb-12 relative z-20 bg-[#0a0a0b] overflow-hidden">
                <div className="max-w-6xl mx-auto px-4 flex flex-col items-center">
                    <h2 className="text-[15vw] font-black tracking-tighter text-white/5 select-none leading-none absolute top-0 w-full text-center mix-blend-plus-lighter pointer-events-none">
                        SYNTAXHUB
                    </h2>
                    <div className="mt-20 flex flex-col items-center z-10">
                        <img src="/logo.png" alt="Syntaxhub Logo" className="w-16 h-16 object-contain mb-6 filter drop-shadow-[0_0_20px_rgba(255,255,255,0.3)] mix-blend-screen" />
                        <p className="text-white/40 text-sm tracking-widest uppercase text-center mb-8">
                            Engineered for optimal learning topology.
                        </p>
                        <div className="flex items-center gap-4 text-sm text-white/30">
                            <a href="#" className="hover:text-white transition-colors">Privacy</a>
                            <span>—</span>
                            <a href="#" className="hover:text-white transition-colors">Terms</a>
                            <span>—</span>
                            <a href="#" className="hover:text-white transition-colors">Contact</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    );
}
