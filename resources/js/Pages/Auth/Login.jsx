import Checkbox from '@/Components/Checkbox';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import GuestLayout from '@/Layouts/GuestLayout';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Login({ status, canResetPassword }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        email: '',
        password: '',
        remember: false,
    });

    const submit = (e) => {
        e.preventDefault();
        post(route('login'), {
            onFinish: () => reset('password'),
        });
    };

    return (
        <GuestLayout>
            <Head title="Log in" />

            {status && (
                <div className="mb-4 text-sm font-medium text-green-400">
                    {status}
                </div>
            )}

            <div className="mb-8 text-center">
                <h2 className="text-2xl font-bold text-white tracking-tight mb-2">Welcome Back</h2>
                <p className="text-[12px] text-white/50 uppercase tracking-widest">Authenticate to Syntaxhub</p>
            </div>

            <form onSubmit={submit}>
                <div>
                    <label htmlFor="email" className="block text-[10px] font-bold text-white/50 uppercase tracking-widest mb-2">Email Identity</label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value={data.email}
                        className="mt-1 block w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-white/40 focus:ring-1 focus:ring-white/40 transition-colors"
                        autoComplete="username"
                        isFocused={true}
                        onChange={(e) => setData('email', e.target.value)}
                    />

                    <InputError message={errors.email} className="mt-2" />
                </div>

                <div className="mt-6">
                    <label htmlFor="password" className="block text-[10px] font-bold text-white/50 uppercase tracking-widest mb-2">Security Key</label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        value={data.password}
                        className="mt-1 block w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-white/40 focus:ring-1 focus:ring-white/40 transition-colors"
                        autoComplete="current-password"
                        onChange={(e) => setData('password', e.target.value)}
                    />

                    <InputError message={errors.password} className="mt-2" />
                </div>

                <div className="mt-4 flex items-center justify-between">
                    <label className="flex items-center">
                        <Checkbox
                            name="remember"
                            checked={data.remember}
                            onChange={(e) =>
                                setData('remember', e.target.checked)
                            }
                            className="bg-[#050505] border-white/20 checked:bg-white checked:border-white"
                        />
                        <span className="ms-2 text-sm text-white/60">
                            Remember me
                        </span>
                    </label>

                    {canResetPassword && (
                        <Link
                            href={route('password.request')}
                            className="rounded-md text-[11px] text-white/40 underline hover:text-white/80 focus:outline-none"
                        >
                            Forgot your password?
                        </Link>
                    )}
                </div>

                <div className="mt-8 flex items-center justify-end">
                    <Link
                        href={route('register')}
                        className="rounded-md text-[11px] text-white/40 uppercase tracking-widest hover:text-white/80 focus:outline-none me-4"
                    >
                        Create Account
                    </Link>
                    <button className="btn-brutal uppercase text-[11px] tracking-widest" disabled={processing}>
                        Authenticate
                    </button>
                </div>
            </form>
        </GuestLayout>
    );
}
