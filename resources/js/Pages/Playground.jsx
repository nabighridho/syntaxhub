import AppLayout from '@/Layouts/AppLayout';
import { Head } from '@inertiajs/react';
import { motion } from 'framer-motion';
import { useState, useCallback } from 'react';
import { HiOutlinePlay, HiOutlineTrash, HiOutlineCode, HiOutlineEye, HiOutlineTerminal } from 'react-icons/hi';

const defaultCode = {
    html: `<!DOCTYPE html>
<html lang="id">
<head>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #0a0a0b;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
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
        button:hover { transform: scale(1.05); }
    </style>
</head>
<body>
    <div class="box">
        <h1>Sandbox Loaded.</h1>
        <p>Awaiting Instructions</p>
        <button onclick="alert('Execute!')">Execute</button>
    </div>
</body>
</html>`,
    javascript: `// System Diagnostics
// Execute via Ctrl+Enter

function analyze(node) {
    console.log("[SYSTEM] Analyzing node: " + node);
    return Math.floor(Math.random() * 1000) + "ms";
}

const nodes = ['Alpha', 'Beta', 'Gamma'];

console.log("=== TELEMETRY START ===");
nodes.forEach(n => {
    let latency = analyze(n);
    console.log("-> " + n + " ping: " + latency);
});
console.log("=== DONE ===");`,
    css: `/* Experimental Grid Setup */
body {
    background: #0a0a0b;
    min-height: 100vh;
    display: grid;
    place-items: center;
    margin: 0;
}
.grid-system {
    display: flex;
    gap: 8px;
}
.node {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    background: #121214;
    border: 1px solid rgba(255,255,255,0.1);
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
.node:nth-child(2) { animation-delay: 0.2s; border-color: rgba(255,255,255,0.3); }
.node:nth-child(3) { animation-delay: 0.4s; }

@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(0.9); }
}`
};

export default function Playground() {
    const [tab, setTab] = useState('html');
    const [code, setCode] = useState(defaultCode.html);
    const [output, setOutput] = useState('');
    const [logs, setLogs] = useState([]);
    const [running, setRunning] = useState(false);

    const tabs = [
        { key: 'html', label: 'HTML' },
        { key: 'javascript', label: 'JS' },
        { key: 'css', label: 'CSS' },
    ];

    const switchTab = (t) => { setTab(t); setCode(defaultCode[t]); setOutput(''); setLogs([]); };

    const runCode = useCallback(() => {
        setRunning(true);
        setLogs([]);
        setTimeout(() => {
            if (tab === 'html') {
                setOutput(code);
            } else if (tab === 'javascript') {
                const captured = [];
                const orig = { log: console.log, error: console.error, warn: console.warn };
                const fmt = (v) => Array.isArray(v) ? JSON.stringify(v) : typeof v === 'object' && v !== null ? JSON.stringify(v, null, 2) : String(v);
                console.log = (...a) => captured.push({ type: 'log', text: a.map(fmt).join(' ') });
                console.error = (...a) => captured.push({ type: 'error', text: a.map(fmt).join(' ') });
                console.warn = (...a) => captured.push({ type: 'warn', text: a.map(fmt).join(' ') });
                try { new Function(code)(); } catch (e) { captured.push({ type: 'error', text: 'Error: ' + e.message }); }
                Object.assign(console, orig);
                setLogs(captured);
            } else if (tab === 'css') {
                setOutput(`<!DOCTYPE html><html><head><style>${code}</style></head><body><div class="grid-system"><div class="node"></div><div class="node"></div><div class="node"></div></div></body></html>`);
            }
            setRunning(false);
        }, 300);
    }, [code, tab]);

    const handleKeyDown = (e) => {
        if (e.key === 'Tab') {
            e.preventDefault();
            const s = e.target.selectionStart;
            setCode(code.substring(0, s) + '    ' + code.substring(e.target.selectionEnd));
            setTimeout(() => { e.target.selectionStart = e.target.selectionEnd = s + 4; }, 0);
        }
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') { e.preventDefault(); runCode(); }
    };

    return (
        <AppLayout title="Playground">
            <Head title="Playground" />

            <div className="grid grid-cols-1 lg:grid-cols-2 gap-4 h-[calc(100vh-200px)] min-h-[600px]">
                {/* Editor Matrix */}
                <motion.div initial={{ opacity: 0, x: -20 }} animate={{ opacity: 1, x: 0 }} transition={{ duration: 0.6, ease: [0.16, 1, 0.3, 1] }} className="bento-card flex flex-col h-full rounded-[24px]">
                    <div className="flex items-center justify-between px-2 bg-white/5 border-b border-white/5">
                        <div className="flex">
                            {tabs.map(t => (
                                <button key={t.key} onClick={() => switchTab(t.key)}
                                    className={`px-5 py-3 text-[11px] uppercase tracking-widest font-bold transition-all border-b-2 ${
                                        tab === t.key ? 'border-white text-white' : 'border-transparent text-white/30 hover:text-white/60'
                                    }`}>
                                    {t.label}
                                </button>
                            ))}
                        </div>
                        <div className="flex items-center pr-2">
                            <button onClick={() => { setCode(defaultCode[tab]); setLogs([]); setOutput(''); }}
                                className="p-2 text-white/30 hover:text-white transition-colors" title="Reset Sandbox">
                                <HiOutlineTrash className="w-4 h-4" />
                            </button>
                        </div>
                    </div>

                    <textarea
                        value={code} onChange={e => setCode(e.target.value)} onKeyDown={handleKeyDown}
                        className="flex-1 w-full bg-transparent text-white/70 font-mono text-[13px] p-6 border-none focus:ring-0 resize-none outline-none leading-relaxed"
                        spellCheck={false} style={{ tabSize: 4 }}
                    />

                    <div className="p-4 border-t border-white/5 bg-white/5 flex items-center justify-between">
                        <button onClick={runCode} disabled={running} className="btn-brutal text-xs flex items-center gap-2 disabled:opacity-50 px-6 py-2">
                            <HiOutlinePlay className="w-4 h-4" /> {running ? 'EXECUTING...' : 'RUN COMPILE'}
                        </button>
                        <span className="text-[10px] text-white/30 uppercase tracking-widest flex items-center gap-1"><span className="border border-white/20 rounded px-1 min-w-[20px] text-center">Ctrl</span> + <span className="border border-white/20 rounded px-1.5">Enter</span></span>
                    </div>
                </motion.div>

                {/* Output Matrix */}
                <motion.div initial={{ opacity: 0, x: 20 }} animate={{ opacity: 1, x: 0 }} transition={{ duration: 0.6, ease: [0.16, 1, 0.3, 1], delay: 0.1 }} className="bento-card flex flex-col h-full rounded-[24px] overflow-hidden">
                    <div className="px-6 py-3 border-b border-white/5 bg-white/5 flex items-center gap-2">
                        {tab === 'javascript' ? <HiOutlineTerminal className="w-4 h-4 text-white/40" /> : <HiOutlineEye className="w-4 h-4 text-white/40" />}
                        <span className="text-[11px] font-bold text-white/60 uppercase tracking-widest">{tab === 'javascript' ? 'Terminal Output' : 'Visual Render'}</span>
                    </div>

                    <div className="flex-1 bg-[#050505] relative">
                        {tab === 'javascript' ? (
                            <div className="p-6 font-mono text-[13px] h-full overflow-auto text-white/70">
                                {logs.length === 0 ? (
                                    <div className="h-full flex flex-col items-center justify-center opacity-30">
                                        <HiOutlineTerminal className="w-12 h-12 mb-4" />
                                        <p className="tracking-widest uppercase text-[10px]">Awaiting Execution</p>
                                    </div>
                                ) : logs.map((l, i) => (
                                    <div key={i} className={`py-1 ${l.type === 'error' ? 'text-red-400' : l.type === 'warn' ? 'text-yellow-400' : 'text-white'}`}>
                                        <span className="text-white/30 mr-3">❯</span>{l.text}
                                    </div>
                                ))}
                            </div>
                        ) : output ? (
                            <iframe srcDoc={output} className="w-full h-full border-none absolute inset-0 bg-white" sandbox="allow-scripts allow-modals" title="Preview" />
                        ) : (
                            <div className="h-full flex flex-col items-center justify-center opacity-30 text-white">
                                <HiOutlineEye className="w-12 h-12 mb-4" />
                                <p className="tracking-widest uppercase text-[10px]">Awaiting Render</p>
                            </div>
                        )}
                    </div>
                </motion.div>
            </div>
        </AppLayout>
    );
}
