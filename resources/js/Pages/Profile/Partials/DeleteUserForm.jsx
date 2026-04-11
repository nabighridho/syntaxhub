import InputError from '@/Components/InputError';
import Modal from '@/Components/Modal';
import { useForm } from '@inertiajs/react';
import { useRef, useState } from 'react';
import { HiOutlineExclamationCircle } from 'react-icons/hi';

export default function DeleteUserForm({ className = '' }) {
    const [confirmingUserDeletion, setConfirmingUserDeletion] = useState(false);
    const passwordInput = useRef();

    const { data, setData, delete: destroy, processing, reset, errors } = useForm({
        password: '',
    });

    const confirmUserDeletion = () => {
        setConfirmingUserDeletion(true);
    };

    const deleteUser = (e) => {
        e.preventDefault();
        destroy(route('profile.destroy'), {
            preserveScroll: true,
            onSuccess: () => closeModal(),
            onError: () => passwordInput.current.focus(),
            onFinish: () => reset(),
        });
    };

    const closeModal = () => {
        setConfirmingUserDeletion(false);
        reset();
    };

    return (
        <section className={className}>
            <header className="flex items-start gap-4">
                <div className="mt-1 w-10 h-10 rounded-xl bg-red-500/10 flex items-center justify-center shrink-0">
                    <HiOutlineExclamationCircle className="w-5 h-5 text-red-500" />
                </div>
                <div>
                    <h2 className="text-lg font-bold text-red-400 tracking-tight">Delete Account</h2>
                    <p className="mt-1 text-sm text-white/40">
                        Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
                    </p>
                </div>
            </header>

            <div className="mt-6 ml-14">
                <button
                    className="px-4 py-2 bg-red-500 hover:bg-red-600 text-black text-[11px] font-bold uppercase tracking-widest rounded-full transition-colors"
                    onClick={confirmUserDeletion}
                >
                    Initiate Deletion
                </button>
            </div>

            <Modal show={confirmingUserDeletion} onClose={closeModal}>
                <form onSubmit={deleteUser} className="p-8 bg-[#0a0a0b] border border-white/10 rounded-2xl relative overflow-hidden">
                    <div className="noise-bg absolute inset-0 pointer-events-none opacity-50"></div>
                    
                    <div className="relative z-10">
                        <h2 className="text-xl font-bold text-white tracking-tight mb-4">
                            Are you absolutely sure?
                        </h2>

                        <p className="text-sm text-white/50 mb-6 leading-relaxed">
                            Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                        </p>

                        <div className="mt-6">
                            <label className="block text-[10px] font-bold text-white/50 uppercase tracking-widest mb-2">Security Key</label>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                ref={passwordInput}
                                value={data.password}
                                onChange={(e) => setData('password', e.target.value)}
                                className="mt-1 block w-full bg-[#121214] border border-white/10 rounded-xl px-4 py-3 text-white focus:border-red-400/50 focus:ring-1 focus:ring-red-400/50 outline-none transition-colors"
                                isFocused
                                placeholder="Enter your password"
                            />
                            <InputError message={errors.password} className="mt-2" />
                        </div>

                        <div className="mt-8 flex justify-end gap-4">
                            <button
                                type="button"
                                className="px-5 py-2 text-[11px] font-bold uppercase tracking-widest text-white/50 hover:text-white transition-colors"
                                onClick={closeModal}
                            >
                                Cancel
                            </button>

                            <button
                                className="px-6 py-2 bg-red-500 hover:bg-red-600 text-black text-[11px] font-bold uppercase tracking-widest rounded-full transition-colors disabled:opacity-50"
                                disabled={processing}
                            >
                                Delete Account
                            </button>
                        </div>
                    </div>
                </form>
            </Modal>
        </section>
    );
}
