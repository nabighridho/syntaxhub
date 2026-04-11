import InputError from '@/Components/InputError';
import { Transition } from '@headlessui/react';
import { useForm } from '@inertiajs/react';
import { useRef } from 'react';
import { HiOutlineCheck } from 'react-icons/hi';

export default function UpdatePasswordForm({ className = '' }) {
    const passwordInput = useRef();
    const currentPasswordInput = useRef();

    const { data, setData, errors, put, reset, processing, recentlySuccessful } = useForm({
        current_password: '',
        password: '',
        password_confirmation: '',
    });

    const updatePassword = (e) => {
        e.preventDefault();
        put(route('password.update'), {
            preserveScroll: true,
            onSuccess: () => reset(),
            onError: (errors) => {
                if (errors.password) {
                    reset('password', 'password_confirmation');
                    passwordInput.current.focus();
                }
                if (errors.current_password) {
                    reset('current_password');
                    currentPasswordInput.current.focus();
                }
            },
        });
    };

    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-bold text-white tracking-tight">Security Key</h2>
                <p className="mt-1 text-sm text-white/40">Ensure your account is using a long, random password to stay secure.</p>
            </header>

            <form onSubmit={updatePassword} className="mt-6 space-y-6">
                <div>
                    <label className="block text-[10px] font-bold text-white/50 uppercase tracking-widest mb-2">Current Key</label>
                    <input
                        id="current_password"
                        type="password"
                        ref={currentPasswordInput}
                        className="mt-1 block w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-white/40 focus:ring-1 focus:ring-white/40 outline-none transition-colors"
                        value={data.current_password}
                        onChange={(e) => setData('current_password', e.target.value)}
                        autoComplete="current-password"
                    />
                    <InputError message={errors.current_password} className="mt-2" />
                </div>

                <div>
                    <label className="block text-[10px] font-bold text-white/50 uppercase tracking-widest mb-2">New Key</label>
                    <input
                        id="password"
                        type="password"
                        ref={passwordInput}
                        className="mt-1 block w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-white/40 focus:ring-1 focus:ring-white/40 outline-none transition-colors"
                        value={data.password}
                        onChange={(e) => setData('password', e.target.value)}
                        autoComplete="new-password"
                    />
                    <InputError message={errors.password} className="mt-2" />
                </div>

                <div>
                    <label className="block text-[10px] font-bold text-white/50 uppercase tracking-widest mb-2">Confirm Key</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        className="mt-1 block w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-white/40 focus:ring-1 focus:ring-white/40 outline-none transition-colors"
                        value={data.password_confirmation}
                        onChange={(e) => setData('password_confirmation', e.target.value)}
                        autoComplete="new-password"
                    />
                    <InputError message={errors.password_confirmation} className="mt-2" />
                </div>

                <div className="flex items-center gap-4 pt-4">
                    <button disabled={processing} className="btn-brutal text-[11px] uppercase tracking-widest px-6 py-2">
                        Update Security
                    </button>

                    <Transition show={recentlySuccessful} enter="transition ease-in-out" enterFrom="opacity-0" leave="transition ease-in-out" leaveTo="opacity-0">
                        <p className="text-[12px] text-green-400 flex items-center gap-1"><HiOutlineCheck /> Secured</p>
                    </Transition>
                </div>
            </form>
        </section>
    );
}
