import InputError from '@/Components/InputError';
import { Transition } from '@headlessui/react';
import { Link, useForm, usePage } from '@inertiajs/react';
import { HiOutlineCheck } from 'react-icons/hi';

export default function UpdateProfileInformation({ mustVerifyEmail, status, className = '' }) {
    const user = usePage().props.auth.user;
    const { data, setData, patch, errors, processing, recentlySuccessful } = useForm({
        name: user.name,
        email: user.email,
    });

    const submit = (e) => {
        e.preventDefault();
        patch(route('profile.update'));
    };

    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-bold text-white tracking-tight">Identity Information</h2>
                <p className="mt-1 text-sm text-white/40">Update your account's call sign and email address.</p>
            </header>

            <form onSubmit={submit} className="mt-6 space-y-6">
                <div>
                    <label className="block text-[10px] font-bold text-white/50 uppercase tracking-widest mb-2">Call Sign (Name)</label>
                    <input
                        id="name"
                        type="text"
                        className="mt-1 block w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-white/40 focus:ring-1 focus:ring-white/40 outline-none transition-colors"
                        value={data.name}
                        onChange={(e) => setData('name', e.target.value)}
                        required
                        autoComplete="name"
                    />
                    <InputError className="mt-2" message={errors.name} />
                </div>

                <div>
                    <label className="block text-[10px] font-bold text-white/50 uppercase tracking-widest mb-2">Email Identity</label>
                    <input
                        id="email"
                        type="email"
                        className="mt-1 block w-full bg-[#050505] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-white/40 focus:ring-1 focus:ring-white/40 outline-none transition-colors"
                        value={data.email}
                        onChange={(e) => setData('email', e.target.value)}
                        required
                        autoComplete="username"
                    />
                    <InputError className="mt-2" message={errors.email} />
                </div>

                {mustVerifyEmail && user.email_verified_at === null && (
                    <div>
                        <p className="mt-2 text-[12px] text-yellow-400/80">
                            Your email address is unverified.
                            <Link href={route('verification.send')} method="post" as="button" className="ml-2 rounded-md text-white underline hover:text-white/80 focus:outline-none">
                                Click here to re-send the verification email.
                            </Link>
                        </p>
                        {status === 'verification-link-sent' && (
                            <div className="mt-2 text-[12px] font-medium text-green-400">
                                A new verification link has been sent to your email address.
                            </div>
                        )}
                    </div>
                )}

                <div className="flex items-center gap-4 pt-4">
                    <button disabled={processing} className="btn-brutal text-[11px] uppercase tracking-widest px-6 py-2">
                        Update Identity
                    </button>

                    <Transition show={recentlySuccessful} enter="transition ease-in-out" enterFrom="opacity-0" leave="transition ease-in-out" leaveTo="opacity-0">
                        <p className="text-[12px] text-green-400 flex items-center gap-1"><HiOutlineCheck /> Synced</p>
                    </Transition>
                </div>
            </form>
        </section>
    );
}
