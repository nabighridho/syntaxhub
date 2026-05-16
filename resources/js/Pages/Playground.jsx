import AppLayout from '@/Layouts/AppLayout';
import { Head } from '@inertiajs/react';
import { motion, AnimatePresence } from 'framer-motion';
import { useState, useCallback, useEffect } from 'react';
import { HiOutlinePlay, HiOutlineTrash, HiOutlineCode, HiOutlineEye, HiOutlineTerminal, HiOutlineArrowsExpand, HiOutlineArrowRight } from 'react-icons/hi';

const defaultCode = {
    html: `<div class="box">
    <h1 id="title">Sandbox Loaded.</h1>
    <p>Awaiting Instructions</p>
    <button id="btn">Console Log Test</button>
</div>`,
    javascript: `// System Diagnostics
console.log("=== TELEMETRY START ===");

document.getElementById('btn').addEventListener('click', () => {
    console.log("-> Action triggered: Execution Complete");
    document.getElementById('title').innerText = 'Execution Complete';
    document.getElementById('title').style.color = '#34d399';
});`,
    css: `body {
    font-family: 'Inter', sans-serif;
    background: #0a0a0b;
    color: #fff;
    display: grid;
    place-items: center;
    min-height: 100vh;
    margin: 0;
}
.box {
    border: 1px solid rgba(255,255,255,0.1);
    background: #121214;
    padding: 40px;
    border-radius: 24px;
    text-align: center;
}
h1 { margin: 0 0 10px 0; font-weight: 800; font-size: 32px; letter-spacing: -1px; }
p { color: rgba(255,255,255,0.4); margin: 0 0 24px 0; font-size: 14px; text-transform: uppercase; letter-spacing: 2px; }
button {
    background: #fff;
    color: #000;
    border: none;
    padding: 12px 32px;
    border-radius: 100px;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.2s;
}
button:hover { transform: scale(1.05); }`
};

export default function Playground() {
    const [tab, setTab] = useState('html');
    const [codes, setCodes] = useState(defaultCode);
    const [output, setOutput] = useState('');
    const [logs, setLogs] = useState([]);
    const [running, setRunning] = useState(false);
    const [view, setView] = useState('preview');
    const [isMaximized, setIsMaximized] = useState(false);

    const tabs = [
        { key: 'html', label: 'HTML' },
        { key: 'css', label: 'CSS' },
        { key: 'javascript', label: 'JS' },
    ];

    const switchTab = (t) => { setTab(t); };

    // Capture iframe console logs
    useEffect(() => {
        const handleMessage = (e) => {
            if (e.data && e.data.type === 'PLAYGROUND_LOG') {
                setLogs(prev => [...prev, { type: e.data.level, text: e.data.payload }]);
            }
        };
        window.addEventListener('message', handleMessage);
        return () => window.removeEventListener('message', handleMessage);
    }, []);

    const runCode = useCallback(() => {
        setRunning(true);
        setLogs([]);
        setTimeout(() => {
            const combinedHtml = `
<!DOCTYPE html>
<html>
<head>
    <style>${codes.css}</style>
</head>
<body>
    ${codes.html}
    <script>
        const _log = console.log, _error = console.error, _warn = console.warn;
        const fmt = (v) => typeof v === 'object' ? JSON.stringify(v) : String(v);
        console.log = (...a) => { window.parent.postMessage({ type: 'PLAYGROUND_LOG', level: 'log', payload: a.map(fmt).join(' ') }, '*'); _log(...a); };
        console.error = (...a) => { window.parent.postMessage({ type: 'PLAYGROUND_LOG', level: 'error', payload: a.map(fmt).join(' ') }, '*'); _error(...a); };
        console.warn = (...a) => { window.parent.postMessage({ type: 'PLAYGROUND_LOG', level: 'warn', payload: a.map(fmt).join(' ') }, '*'); _warn(...a); };
        window.onerror = (msg, url, line) => { window.parent.postMessage({ type: 'PLAYGROUND_LOG', level: 'error', payload: msg + ' at line ' + line }, '*'); };
    </script>
    <script>
        try {
            ${codes.javascript}
        } catch (e) {
            console.error(e);
        }
    </script>
</body>
</html>`;
            setOutput(combinedHtml);
            setRunning(false);
        }, 150);
    }, [codes]);

    const handleKeyDown = (e) => {
        if (e.key === 'Tab') {
            e.preventDefault();
            const s = e.target.selectionStart;
            const currentCode = codes[tab];
            setCodes({ ...codes, [tab]: currentCode.substring(0, s) + '    ' + currentCode.substring(e.target.selectionEnd) });
            setTimeout(() => { e.target.selectionStart = e.target.selectionEnd = s + 4; }, 0);
        }
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') { e.preventDefault(); runCode(); }
    };

    return (
        <AppLayout title="Playground">
            <Head title="Playground" />

            <div className="flex flex-col lg:flex-row gap-4 h-auto lg:h-[calc(100vh-200px)] lg:min-h-[500px] w-full">
                {/* Editor Matrix */}
                <AnimatePresence initial={false}>
                    {!isMaximized && (
                        <motion.div 
                            layout
                            initial={{ opacity: 0 }} 
                            animate={{ opacity: 1 }} 
                            exit={{ opacity: 0 }}
                            transition={{ duration: 0.4, ease: [0.16, 1, 0.3, 1] }} 
                            className="bento-card flex flex-col h-[50vh] lg:h-full rounded-[24px] overflow-hidden min-w-0 w-full lg:w-1/2 shrink-0"
                        >
                            <div className="flex items-center justify-between px-2 bg-white/5 border-b border-white/5">
                                <div className="flex">
                                    {tabs.map(t => (
                                        <button key={t.key} onClick={() => switchTab(t.key)}
                                            className={`px-4 sm:px-5 py-3 text-[11px] uppercase tracking-widest font-bold transition-all border-b-2 ${
                                                tab === t.key ? 'border-white text-white' : 'border-transparent text-white/30 hover:text-white/60'
                                            }`}>
                                            {t.label}
                                        </button>
                                    ))}
                                </div>
                                <div className="flex items-center pr-2">
                                    <button onClick={() => { setCodes(defaultCode); setLogs([]); setOutput(''); }}
                                        className="p-2 text-white/30 hover:text-white transition-colors" title="Reset Sandbox">
                                        <HiOutlineTrash className="w-4 h-4" />
                                    </button>
                                </div>
                            </div>

                            <textarea
                                value={codes[tab]} onChange={e => setCodes({ ...codes, [tab]: e.target.value })} onKeyDown={handleKeyDown}
                                className="flex-1 w-full bg-transparent text-white/70 font-mono text-[13px] p-4 sm:p-6 border-none focus:ring-0 resize-none outline-none leading-relaxed"
                                spellCheck={false} style={{ tabSize: 4 }}
                            />

                            <div className="p-3 sm:p-4 border-t border-white/5 bg-white/5 flex items-center justify-between gap-2">
                                <button onClick={runCode} disabled={running} className="btn-brutal text-xs flex items-center gap-2 disabled:opacity-50 px-4 sm:px-6 py-2 shrink-0">
                                    <HiOutlinePlay className="w-4 h-4" /> {running ? 'EXECUTING...' : 'RUN'}
                                </button>
                                <span className="text-[10px] text-white/30 uppercase tracking-widest hidden sm:flex items-center gap-1">
                                    <span className="border border-white/20 rounded px-1 min-w-[20px] text-center">Ctrl</span> + <span className="border border-white/20 rounded px-1.5">Enter</span>
                                </span>
                            </div>
                        </motion.div>
                    )}
                </AnimatePresence>

                {/* Output Matrix */}
                <motion.div 
                    layout
                    transition={{ duration: 0.6, ease: [0.16, 1, 0.3, 1] }} 
                    className="bento-card flex flex-col h-[50vh] lg:h-full rounded-[24px] overflow-hidden flex-1 min-w-0"
                >
                    <div className="flex items-center justify-between px-2 bg-white/5 border-b border-white/5">
                        <div className="flex shrink-0">
                            <button onClick={() => setView('preview')}
                                className={`flex items-center gap-1.5 px-3 sm:px-5 py-3 text-[11px] uppercase tracking-widest font-bold transition-all border-b-2 ${
                                    view === 'preview' ? 'border-white text-white' : 'border-transparent text-white/30 hover:text-white/60'
                                }`}>
                                <HiOutlineEye className="w-4 h-4" /> <span className="hidden sm:inline">Render</span>
                            </button>
                            <button onClick={() => setView('console')}
                                className={`flex items-center gap-1.5 px-3 sm:px-5 py-3 text-[11px] uppercase tracking-widest font-bold transition-all border-b-2 ${
                                    view === 'console' ? 'border-white text-white' : 'border-transparent text-white/30 hover:text-white/60'
                                }`}>
                                <HiOutlineTerminal className="w-4 h-4" /> <span className="hidden sm:inline">Terminal</span>
                                <span className="ml-1 bg-white/10 px-1.5 rounded-full text-[9px]">{logs.length}</span>
                            </button>
                        </div>
                        <div className="flex items-center pr-2 shrink-0">
                            <button onClick={() => setIsMaximized(!isMaximized)}
                                className="p-2 text-white/30 hover:text-white transition-colors flex items-center gap-1.5 text-[10px] uppercase tracking-widest font-bold" 
                                title={isMaximized ? "Restore Layout" : "Maximize Output"}>
                                {isMaximized ? (
                                    <><HiOutlineArrowRight className="w-4 h-4" /> <span className="hidden sm:inline">EDITOR</span></>
                                ) : (
                                    <><HiOutlineArrowsExpand className="w-4 h-4" /> <span className="hidden sm:inline">MAX</span></>
                                )}
                            </button>
                        </div>
                    </div>

                    <div className="flex-1 bg-[#050505] relative">
                        {view === 'console' ? (
                            <div className="p-4 sm:p-6 font-mono text-[12px] sm:text-[13px] h-full overflow-auto text-white/70">
                                {logs.length === 0 ? (
                                    <div className="h-full flex flex-col items-center justify-center opacity-30">
                                        <HiOutlineTerminal className="w-12 h-12 mb-4" />
                                        <p className="tracking-widest uppercase text-[10px]">Awaiting Instructions</p>
                                    </div>
                                ) : logs.map((l, i) => (
                                    <div key={i} className={`py-1 break-all ${l.type === 'error' ? 'text-red-400' : l.type === 'warn' ? 'text-yellow-400' : 'text-white'}`}>
                                        <span className="text-white/30 mr-2 sm:mr-3">❯</span>{l.text}
                                    </div>
                                ))}
                            </div>
                        ) : output ? (
                            <iframe srcDoc={output} className="w-full h-full border-none absolute inset-0 bg-white" sandbox="allow-scripts allow-modals" title="Preview" />
                        ) : (
                            <div className="h-full flex flex-col items-center justify-center opacity-30 text-white">
                                <HiOutlineEye className="w-12 h-12 mb-4" />
                                <p className="tracking-widest uppercase text-[10px]">Awaiting Compile</p>
                            </div>
                        )}
                    </div>
                </motion.div>
            </div>
        </AppLayout>
    );
}
