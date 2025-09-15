import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';
import { useTranslation } from '@/hooks/use-translation';
import { LanguageSwitcher } from '@/components/language-switcher';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;
    const { t } = useTranslation();

    return (
        <>
            <Head title={t('comprehensive_erp', 'Manufacturing ERP System')}>
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
            </Head>
            <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
                {/* Header */}
                <header className="relative z-10 p-6">
                    <nav className="flex items-center justify-between max-w-6xl mx-auto">
                        <div className="flex items-center space-x-2">
                            <span className="text-3xl">🏭</span>
                            <span className="text-xl font-bold text-gray-900 dark:text-white">
                                ManufacturingERP
                            </span>
                        </div>
                        <div className="flex items-center space-x-4">
                            <LanguageSwitcher />
                            {auth.user ? (
                                <Link
                                    href={route('dashboard')}
                                    className="px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors"
                                >
                                    {t('dashboard')}
                                </Link>
                            ) : (
                                <>
                                    <Link
                                        href={route('login')}
                                        className="px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors"
                                    >
                                        {t('login')}
                                    </Link>
                                    <Link
                                        href={route('register')}
                                        className="px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors"
                                    >
                                        {t('get_started')}
                                    </Link>
                                </>
                            )}
                        </div>
                    </nav>
                </header>

                {/* Hero Section */}
                <main className="max-w-6xl mx-auto px-6 pb-16">
                    <div className="text-center mb-16">
                        <h1 className="text-5xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6">
                            🚀 {t('comprehensive_erp', 'Complete Manufacturing')}
                            <span className="block text-blue-600 dark:text-blue-400">{t('comprehensive_erp', 'ERP Solution')}</span>
                        </h1>
                        <p className="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                            {t('manage_all_aspects', 'Streamline your manufacturing operations with our comprehensive Enterprise Resource Planning system. Manage inventory, purchasing, sales, finance, and HR with role-based access control for different user types.')}
                        </p>
                        <div className="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8 max-w-4xl mx-auto">
                            <div className="bg-blue-100 dark:bg-blue-900 p-4 rounded-lg">
                                <div className="text-2xl mb-2">👑</div>
                                <div className="text-sm font-semibold text-blue-800 dark:text-blue-200">Super Admin</div>
                                <div className="text-xs text-gray-600 dark:text-gray-300">{t('total', 'Full Access')}</div>
                            </div>
                            <div className="bg-green-100 dark:bg-green-900 p-4 rounded-lg">
                                <div className="text-2xl mb-2">💼</div>
                                <div className="text-sm font-semibold text-green-800 dark:text-green-200">{t('sales', 'Sales')} Manager</div>
                                <div className="text-xs text-gray-600 dark:text-gray-300">{t('sales', 'Sales')} & {t('customers')}</div>
                            </div>
                            <div className="bg-purple-100 dark:bg-purple-900 p-4 rounded-lg">
                                <div className="text-2xl mb-2">📦</div>
                                <div className="text-sm font-semibold text-purple-800 dark:text-purple-200">{t('inventory')} Mgr</div>
                                <div className="text-xs text-gray-600 dark:text-gray-300">Stock & {t('purchasing')}</div>
                            </div>
                            <div className="bg-orange-100 dark:bg-orange-900 p-4 rounded-lg">
                                <div className="text-2xl mb-2">🤝</div>
                                <div className="text-sm font-semibold text-orange-800 dark:text-orange-200">Partner User</div>
                                <div className="text-xs text-gray-600 dark:text-gray-300">{t('sales')} Focus</div>
                            </div>
                        </div>
                        <div className="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                            {!auth.user && (
                                <>
                                    <Link
                                        href={route('register')}
                                        className="px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold text-lg hover:bg-blue-700 transition-colors shadow-lg"
                                    >
                                        {t('get_started', 'Start Free Trial')}
                                    </Link>
                                    <Link
                                        href={route('login')}
                                        className="px-8 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-lg font-semibold text-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors shadow-lg"
                                    >
                                        {t('login', 'Sign In')}
                                    </Link>
                                </>
                            )}
                            {auth.user && (
                                <Link
                                    href={route('dashboard')}
                                    className="px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold text-lg hover:bg-blue-700 transition-colors shadow-lg"
                                >
                                    {t('dashboard', 'Go to Dashboard')}
                                </Link>
                            )}
                        </div>
                    </div>

                    {/* Key Features */}
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                        <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg border dark:border-gray-700">
                            <div className="flex items-center mb-4">
                                <span className="text-4xl mr-4">📦</span>
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white">
                                    {t('inventory_management')}
                                </h3>
                            </div>
                            <p className="text-gray-600 dark:text-gray-300 mb-4">
                                {t('track_products')}
                            </p>
                            <ul className="text-sm text-gray-500 dark:text-gray-400 space-y-1">
                                <li>• Real-time stock tracking</li>
                                <li>• Automated reorder points</li>
                                <li>• Multi-location inventory</li>
                            </ul>
                        </div>

                        <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg border dark:border-gray-700">
                            <div className="flex items-center mb-4">
                                <span className="text-4xl mr-4">🛒</span>
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white">
                                    {t('purchasing', 'Purchase')} {t('management')}
                                </h3>
                            </div>
                            <p className="text-gray-600 dark:text-gray-300 mb-4">
                                Streamline your procurement process with vendor management, purchase orders, and delivery tracking.
                            </p>
                            <ul className="text-sm text-gray-500 dark:text-gray-400 space-y-1">
                                <li>• {t('vendors')} database</li>
                                <li>• Purchase order automation</li>
                                <li>• Delivery tracking</li>
                            </ul>
                        </div>

                        <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg border dark:border-gray-700">
                            <div className="flex items-center mb-4">
                                <span className="text-4xl mr-4">💰</span>
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white">
                                    {t('sales_crm')}
                                </h3>
                            </div>
                            <p className="text-gray-600 dark:text-gray-300 mb-4">
                                {t('manage_customers')}
                            </p>
                            <ul className="text-sm text-gray-500 dark:text-gray-400 space-y-1">
                                <li>• {t('customers', 'Customer')} {t('management')}</li>
                                <li>• {t('sales')} order processing</li>
                                <li>• Automated invoicing</li>
                            </ul>
                        </div>

                        <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg border dark:border-gray-700">
                            <div className="flex items-center mb-4">
                                <span className="text-4xl mr-4">📊</span>
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white">
                                    {t('financial_control')}
                                </h3>
                            </div>
                            <p className="text-gray-600 dark:text-gray-300 mb-4">
                                {t('handle_accounting')}
                            </p>
                            <ul className="text-sm text-gray-500 dark:text-gray-400 space-y-1">
                                <li>• Chart of {t('accounts')}</li>
                                <li>• General ledger</li>
                                <li>• Financial {t('reports')}</li>
                            </ul>
                        </div>

                        <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg border dark:border-gray-700">
                            <div className="flex items-center mb-4">
                                <span className="text-4xl mr-4">👥</span>
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white">
                                    {t('hr_management')}
                                </h3>
                            </div>
                            <p className="text-gray-600 dark:text-gray-300 mb-4">
                                {t('employee_records')}
                            </p>
                            <ul className="text-sm text-gray-500 dark:text-gray-400 space-y-1">
                                <li>• {t('employees')} database</li>
                                <li>• Department {t('management')}</li>
                                <li>• Payroll integration</li>
                            </ul>
                        </div>

                        <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg border dark:border-gray-700">
                            <div className="flex items-center mb-4">
                                <span className="text-4xl mr-4">📈</span>
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white">
                                    {t('analytics')} & {t('reports')}
                                </h3>
                            </div>
                            <p className="text-gray-600 dark:text-gray-300 mb-4">
                                Make data-driven decisions with comprehensive reporting and real-time {t('business_intelligence')}.
                            </p>
                            <ul className="text-sm text-gray-500 dark:text-gray-400 space-y-1">
                                <li>• Real-time dashboards</li>
                                <li>• Custom {t('reports')}</li>
                                <li>• KPI tracking</li>
                            </ul>
                        </div>
                    </div>

                    {/* Role-Based Dashboards */}
                    <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg border dark:border-gray-700 mb-16">
                        <h2 className="text-3xl font-bold text-gray-900 dark:text-white text-center mb-8">
                            🎯 Role-Based {t('dashboard', 'Dashboards')}
                        </h2>
                        <p className="text-gray-600 dark:text-gray-300 text-center mb-8 max-w-2xl mx-auto">
                            Each user type gets a customized dashboard focused on their specific needs and responsibilities.
                        </p>
                        
                        <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            {/* Super Admin Dashboard */}
                            <div className="border border-gray-200 dark:border-gray-600 rounded-lg p-6">
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                                    👑 Super Admin {t('dashboard')}
                                </h3>
                                <div className="bg-gray-50 dark:bg-gray-900 rounded-lg p-4 mb-4">
                                    <div className="grid grid-cols-2 gap-2 text-xs">
                                        <div className="bg-blue-100 dark:bg-blue-900 p-2 rounded text-center">
                                            <div className="font-bold text-blue-600">1,234</div>
                                            <div>{t('products')}</div>
                                        </div>
                                        <div className="bg-green-100 dark:bg-green-900 p-2 rounded text-center">
                                            <div className="font-bold text-green-600">567</div>
                                            <div>{t('customers')}</div>
                                        </div>
                                        <div className="bg-purple-100 dark:bg-purple-900 p-2 rounded text-center">
                                            <div className="font-bold text-purple-600">89</div>
                                            <div>{t('vendors')}</div>
                                        </div>
                                        <div className="bg-orange-100 dark:bg-orange-900 p-2 rounded text-center">
                                            <div className="font-bold text-orange-600">156</div>
                                            <div>{t('employees')}</div>
                                        </div>
                                    </div>
                                </div>
                                <ul className="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                                    <li>• Complete {t('overview')} of all {t('modules')}</li>
                                    <li>• {t('purchasing')} & {t('sales')} order tracking</li>
                                    <li>• {t('finance', 'Financial')} and {t('hr')} metrics</li>
                                    <li>• Low stock alerts across all {t('products')}</li>
                                </ul>
                            </div>

                            {/* Partner User Dashboard */}
                            <div className="border border-gray-200 dark:border-gray-600 rounded-lg p-6">
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                                    🤝 Partner User {t('dashboard')}
                                </h3>
                                <div className="bg-gray-50 dark:bg-gray-900 rounded-lg p-4 mb-4">
                                    <div className="grid grid-cols-2 gap-2 text-xs">
                                        <div className="bg-blue-100 dark:bg-blue-900 p-2 rounded text-center">
                                            <div className="font-bold text-blue-600">45</div>
                                            <div>{t('sales')} {t('orders')}</div>
                                        </div>
                                        <div className="bg-amber-100 dark:bg-amber-900 p-2 rounded text-center">
                                            <div className="font-bold text-amber-600">12</div>
                                            <div>Pending</div>
                                        </div>
                                        <div className="bg-green-100 dark:bg-green-900 p-2 rounded text-center">
                                            <div className="font-bold text-green-600">$85K</div>
                                            <div>Revenue</div>
                                        </div>
                                        <div className="bg-red-100 dark:bg-red-900 p-2 rounded text-center">
                                            <div className="font-bold text-red-600">3</div>
                                            <div>Low Stock</div>
                                        </div>
                                    </div>
                                </div>
                                <ul className="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                                    <li>• {t('sales')}-focused metrics only</li>
                                    <li>• Recent {t('sales')} order history</li>
                                    <li>• Monthly revenue tracking</li>
                                    <li>• Low stock finished goods alerts</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {/* Dashboard Preview */}
                    <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg border dark:border-gray-700 mb-16">
                        <h2 className="text-3xl font-bold text-gray-900 dark:text-white text-center mb-8">
                            📊 Real-Time {t('business_intelligence')}
                        </h2>
                        <div className="bg-gray-50 dark:bg-gray-900 rounded-lg p-6">
                            <div className="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                <div className="bg-blue-100 dark:bg-blue-900 p-4 rounded-lg text-center">
                                    <div className="text-2xl font-bold text-blue-600 dark:text-blue-400">1,234</div>
                                    <div className="text-sm text-gray-600 dark:text-gray-400">{t('active')} {t('products')}</div>
                                </div>
                                <div className="bg-green-100 dark:bg-green-900 p-4 rounded-lg text-center">
                                    <div className="text-2xl font-bold text-green-600 dark:text-green-400">567</div>
                                    <div className="text-sm text-gray-600 dark:text-gray-400">{t('customers')}</div>
                                </div>
                                <div className="bg-purple-100 dark:bg-purple-900 p-4 rounded-lg text-center">
                                    <div className="text-2xl font-bold text-purple-600 dark:text-purple-400">89</div>
                                    <div className="text-sm text-gray-600 dark:text-gray-400">{t('vendors')}</div>
                                </div>
                                <div className="bg-orange-100 dark:bg-orange-900 p-4 rounded-lg text-center">
                                    <div className="text-2xl font-bold text-orange-600 dark:text-orange-400">$125K</div>
                                    <div className="text-sm text-gray-600 dark:text-gray-400">Monthly Revenue</div>
                                </div>
                            </div>
                            <div className="text-center text-gray-500 dark:text-gray-400">
                                Customized metrics based on your role and permissions
                            </div>
                        </div>
                    </div>

                    {/* Demo Users */}
                    <div className="bg-gradient-to-r from-purple-50 to-blue-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-8 mb-16">
                        <h2 className="text-3xl font-bold text-gray-900 dark:text-white text-center mb-8">
                            🎭 Try Different User Roles
                        </h2>
                        <p className="text-gray-600 dark:text-gray-300 text-center mb-8">
                            Experience how different user types see the system. Use these demo accounts to explore role-based features:
                        </p>
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg border dark:border-gray-600">
                                <div className="text-3xl mb-3 text-center">👑</div>
                                <h3 className="font-bold text-gray-900 dark:text-white text-center mb-2">Super Admin</h3>
                                <div className="text-center space-y-1 text-sm">
                                    <p className="font-mono bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">test@example.com</p>
                                    <p className="font-mono bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">{t('password')}</p>
                                </div>
                                <p className="text-xs text-gray-500 dark:text-gray-400 text-center mt-2">Full system access</p>
                            </div>
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg border dark:border-gray-600">
                                <div className="text-3xl mb-3 text-center">🤝</div>
                                <h3 className="font-bold text-gray-900 dark:text-white text-center mb-2">Partner User</h3>
                                <div className="text-center space-y-1 text-sm">
                                    <p className="font-mono bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded text-xs">partner@example.com</p>
                                    <p className="font-mono bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">{t('password')}</p>
                                </div>
                                <p className="text-xs text-gray-500 dark:text-gray-400 text-center mt-2">{t('sales')}-focused {t('dashboard')}</p>
                            </div>
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg border dark:border-gray-600">
                                <div className="text-3xl mb-3 text-center">💼</div>
                                <h3 className="font-bold text-gray-900 dark:text-white text-center mb-2">{t('sales')} Manager</h3>
                                <div className="text-center space-y-1 text-sm">
                                    <p className="font-mono bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded text-xs">sales_manager@example.com</p>
                                    <p className="font-mono bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">{t('password')}</p>
                                </div>
                                <p className="text-xs text-gray-500 dark:text-gray-400 text-center mt-2">{t('sales')} & {t('customers')}</p>
                            </div>
                            <div className="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg border dark:border-gray-600">
                                <div className="text-3xl mb-3 text-center">📦</div>
                                <h3 className="font-bold text-gray-900 dark:text-white text-center mb-2">{t('inventory')} Manager</h3>
                                <div className="text-center space-y-1 text-sm">
                                    <p className="font-mono bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded text-xs">inventory_manager@example.com</p>
                                    <p className="font-mono bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">{t('password')}</p>
                                </div>
                                <p className="text-xs text-gray-500 dark:text-gray-400 text-center mt-2">{t('inventory')} & {t('purchasing')}</p>
                            </div>
                        </div>
                    </div>

                    {/* Call to Action */}
                    <div className="text-center bg-blue-600 dark:bg-blue-700 rounded-xl p-12 text-white">
                        <h2 className="text-3xl font-bold mb-4">
                            Ready to Transform Your Manufacturing Business? 🚀
                        </h2>
                        <p className="text-xl mb-8 opacity-90">
                            Join hundreds of manufacturing companies that trust our ERP system to streamline their operations.
                        </p>
                        {!auth.user ? (
                            <div className="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                                <Link
                                    href={route('register')}
                                    className="px-8 py-3 bg-white text-blue-600 rounded-lg font-semibold text-lg hover:bg-gray-100 transition-colors shadow-lg"
                                >
                                    {t('get_started', 'Start Your Free Trial')}
                                </Link>
                                <Link
                                    href={route('login')}
                                    className="px-8 py-3 bg-transparent border-2 border-white text-white rounded-lg font-semibold text-lg hover:bg-white hover:text-blue-600 transition-colors"
                                >
                                    {t('login', 'Sign In Now')}
                                </Link>
                            </div>
                        ) : (
                            <Link
                                href={route('dashboard')}
                                className="inline-block px-8 py-3 bg-white text-blue-600 rounded-lg font-semibold text-lg hover:bg-gray-100 transition-colors shadow-lg"
                            >
                                {t('dashboard', 'Access Your Dashboard')}
                            </Link>
                        )}
                    </div>

                    {/* Footer */}
                    <footer className="mt-16 text-center text-gray-500 dark:text-gray-400">
                        <p>Built with ❤️ for modern manufacturing companies</p>
                    </footer>
                </main>
            </div>
        </>
    );
}