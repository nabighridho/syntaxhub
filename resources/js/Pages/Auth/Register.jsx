import InputError from '@/Components/InputError';
import GuestLayout from '@/Layouts/GuestLayout';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Register() {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const submit = (e) => {
        e.preventDefault();

        post(route('register'), {
            onFinish: () => reset('password', 'password_confirmation'),
        });
    };

    return (
        <GuestLayout>
            <Head title="Register" />

            <div className="mb-8 text-center">
                <h2 className="text-2xl font-bold text-white tracking-tight mb-2">Create Identity</h2>
                <p className="text-[12px] text-white/50 uppercase tracking-widest">Register to Syntaxhub</p>
            </div>

            <form onSubmit={submit}>
                <div>
                    <label htmlFor="name" className="block text-[10px] font-bold text-white/50 uppercase tracking-widest mb-2">Call Sign (Name)</label>

                    <input
                        id="name"
                        name="name"
                        value={data.name}
                        className="mt-1 block w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-white/40 focus:ring-1 focus:ring-white/40 transition-colors"
                        autoComplete="name"
                        isFocused={true}
                        onChange={(e) => setData('name', e.target.value)}
                        required
                    />

                    <InputError message={errors.name} className="mt-2" />
                </div>

                <div className="mt-4">
                    <label htmlFor="email" className="block text-[10px] font-bold text-white/50 uppercase tracking-widest mb-2">Email Identity</label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value={data.email}
                        className="mt-1 block w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-white/40 focus:ring-1 focus:ring-white/40 transition-colors"
                        autoComplete="username"
                        onChange={(e) => setData('email', e.target.value)}
                        required
                    />

                    <InputError message={errors.email} className="mt-2" />
                </div>

                <div className="mt-4">
                    <label htmlFor="password" className="block text-[10px] font-bold text-white/50 uppercase tracking-widest mb-2">Security Key</label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        value={data.password}
                        className="mt-1 block w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-white/40 focus:ring-1 focus:ring-white/40 transition-colors"
                        autoComplete="new-password"
                        onChange={(e) => setData('password', e.target.value)}
                        required
                    />

                    <InputError message={errors.password} className="mt-2" />
                </div>

                <div className="mt-4">
                    <label htmlFor="password_confirmation" className="block text-[10px] font-bold text-white/50 uppercase tracking-widest mb-2">Confirm Key</label>

                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        value={data.password_confirmation}
                        className="mt-1 block w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-white/40 focus:ring-1 focus:ring-white/40 transition-colors"
                        autoComplete="new-password"
                        onChange={(e) =>
                            setData('password_confirmation', e.target.value)
                        }
                        required
                    />

                    <InputError
                        message={errors.password_confirmation}
                        className="mt-2"
                    />
                </div>

                <div className="mt-8 flex items-center justify-end">
                    <Link
                        href={route('login')}
                        className="rounded-md text-[11px] text-white/40 uppercase tracking-widest hover:text-white/80 focus:outline-none me-4"
                    >
                        Already registered?
                    </Link>

                    <button className="btn-brutal uppercase text-[11px] tracking-widest" disabled={processing}>
                        Initialize
                    </button>
                </div>
            </form>
        </GuestLayout>
    );
}
