import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link, useForm } from '@inertiajs/react';
import NavLink from '@/Components/NavLink';

export default function Users({ auth, users }) {

    // users to table
    const usersMap = users.map((user) => {
        return (
            <tr key={user.id}>
                <td className="h-px w-px whitespace-nowrap">
                    <div className="ps-6 py-3">
                        <div className="flex items-center gap-x-3">
                        <div className="grow">
                            <span className="block text-sm font-semibold text-gray-800 dark:text-gray-200">{user.firstname} {user.lastname}</span>
                            <span className="block text-sm text-gray-500">{user.email}</span>
                        </div>
                        </div>
                    </div>
                </td>
                <td className="h-px w-72 whitespace-nowrap">
                    <div className=" py-3">
                        <span className="block text-sm font-semibold text-gray-800 dark:text-gray-200">{user.company.title}</span>
                    </div>
                </td>
                <td className="h-px w-px whitespace-nowrap">
                    <div className=" py-3">
                        <span className="text-sm text-gray-500">{user.role.name}</span>
                    </div>
                </td>
                <td className="h-px w-px whitespace-nowrap">
                    <div className="px-6 py-3">
                        <span className="text-sm text-gray-500">{user.created_at}</span>
                    </div>
                </td>
                <td className="h-px w-px whitespace-nowrap">
                    <div className="px-6 py-1.5">
                        <NavLink href={route('user.edit', user.id)} className='inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline font-medium dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600'>
                            Edit
                        </NavLink>
                    </div>
                </td>
                <td className="h-px w-px whitespace-nowrap">
                    <div className="px-6 py-1.5">
                        <NavLink href={route('user.show', user.id)} className='inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline font-medium dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600'>
                            View
                        </NavLink>
                    </div>
                </td>
                <td className="h-px w-px whitespace-nowrap">
                    <div className="px-6 py-1.5">
                        <NavLink href={route('user.destroy', user.id)} method="delete" as="button" className='inline-flex items-center gap-x-1 text-sm text-red-600 decoration-2 hover:underline font-medium dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600'>
                            Delete
                        </NavLink>
                    </div>
                </td>
            </tr>
        )
    })

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Listes des utilisateurs</h2>}
        >
            <Head title="Utilisateurs" />
        
            <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div className="flex flex-col">
                    <div className="-m-1.5 overflow-x-auto">
                        <div className="p-1.5 min-w-full inline-block align-middle">
                            <div className="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-slate-900 dark:border-gray-700">
                                <div className="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-gray-700">
                                    <div>
                                    <h2 className="text-xl font-semibold text-gray-800 dark:text-gray-200">
                                        Users
                                    </h2>
                                    <p className="text-sm text-gray-600 dark:text-gray-400">
                                        Add users, edit and more.
                                    </p>
                                    </div>

                                    <div>
                                        <div className="inline-flex gap-x-2">
                                            <NavLink href={route('user.create')} className="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                               Ajouter
                                            </NavLink>
                                        </div>
                                    </div>
                                </div>
                                <table className="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead className="bg-gray-50 dark:bg-slate-800">
                                        <tr>
                                            <th scope="col" className="ps-6 py-3 text-start">
                                            <div className="flex items-center gap-x-2">
                                                <span className="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                                Nom, prénom et email
                                                </span>
                                            </div>
                                            </th>

                                            <th scope="col" className="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                                            <div className="flex items-center gap-x-2">
                                                <span className="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                                Companie
                                                </span>
                                            </div>
                                            </th>

                                            <th scope="col" className="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                                            <div className="flex items-center gap-x-2">
                                                <span className="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                                Rôle
                                                </span>
                                            </div>
                                            </th>

                                            <th scope="col" className="px-6 py-3 text-start">
                                            <div className="flex items-center gap-x-2">
                                                <span className="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                                                Created
                                                </span>
                                            </div>
                                            </th>

                                            <th scope="col" className="px-6 py-3 text-end"></th>
                                            <th scope="col" className="px-6 py-3 text-end"></th>
                                            <th scope="col" className="px-6 py-3 text-end"></th>
                                        </tr>
                                    </thead>

                                    <tbody className="divide-y divide-gray-200 dark:divide-gray-700">
                                        {usersMap}
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </AuthenticatedLayout>
    );
}
