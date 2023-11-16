import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import NavLink from '@/Components/NavLink';

export default function User({ auth, user, name }) {
    return(
        <AuthenticatedLayout
        user={auth.user}
        header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Compte - {name}</h2>}
    >
        <Head title="Utilisateur" />
    
        <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <h1>User Show</h1>
                <p>{name}</p>
            </div>
        </div>
    
        </AuthenticatedLayout>
    )
   
}