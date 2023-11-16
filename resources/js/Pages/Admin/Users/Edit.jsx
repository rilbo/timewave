import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import NavLink from '@/Components/NavLink';
import { useEffect } from 'react';
import GuestLayout from '@/Layouts/GuestLayout';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Head, Link, useForm } from '@inertiajs/react';

export default function Edit({ auth, user, companies, roles, name }) {
    const { data, setData, post, processing, errors, reset, patch } = useForm({
        firstname: user.firstname,
        lastname: user.lastname,
        email: user.email,
        company: user.id_company,
        role: user.id_role,
    });

    const submit = (e) => {
        e.preventDefault();
        patch(route('user.update', user.id));
    };

    return(
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Modification de compte - {name} </h2>}
        >
        <Head title="Utilisateurs" />

        <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form onSubmit={submit}>
                        <div>
                            <InputLabel htmlFor="firstname" value="firstname" />

                            <TextInput
                                id="firstname"
                                name="firstname"
                                value={user.firstname}
                                className="mt-1 block w-full"
                                autoComplete="username"
                                isFocused={true}
                                onChange={(e) => setData('firstname', e.target.value)}
                                required
                            />

                            <InputError message={errors.firstname} className="mt-2" />
                        </div>

                        <div>
                            <InputLabel htmlFor="lastname" value="lastname" />

                            <TextInput
                                id="lastname"
                                name="lastname"
                                value={user.lastname}
                                className="mt-1 block w-full"
                                autoComplete="username"
                                isFocused={true}
                                onChange={(e) => setData('lastname', e.target.value)}
                                required
                            />

                            <InputError message={errors.lastname} className="mt-2" />
                        </div>

                        <div className="mt-4">
                            <InputLabel htmlFor="email" value="Email" />

                            <TextInput
                                id="email"
                                type="email"
                                name="email"
                                value={user.email}
                                className="mt-1 block w-full"
                                autoComplete="username"
                                onChange={(e) => setData('email', e.target.value)}
                                required
                            />

                            <InputError message={errors.email} className="mt-2" />
                        </div>

                        
                        <div className="mt-4">
                            {/* Choix de la company en select */}
                            <InputLabel htmlFor="company" value="Choix de la company" />
                            <select id="company" name="company" className="mt-1 block w-full" onChange={(e) => setData('company', e.target.value)} defaultValue={user.id_company}>
                                {companies.map((company) => (
                                   <option key={company.id} value={company.id}>{company.title}</option>
                                ))
                            }
                            </select>
                            
                        </div>

                        
                        <div className="mt-4">
                            {/* Choix du role en select */}
                            <InputLabel htmlFor="role" value="Choix du role" />
                            <select id="role" name="role" className="mt-1 block w-full" onChange={(e) => setData('role', e.target.value)} defaultValue={user.id_role}>
                                {roles.map((role) => (
                                    <option key={role.id} value={role.id}>{role.name}</option>
                                ))}
                            </select>
                        </div>

                        <div className="flex items-center justify-end mt-4">
                            <PrimaryButton className="ms-4" disabled={processing}>
                                Modifier
                            </PrimaryButton>
                        </div>
                    </form>
            </div>
        </div>

        </AuthenticatedLayout>
    )
    
}