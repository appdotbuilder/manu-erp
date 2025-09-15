import { type SharedData } from '@/types';
import { Head, Link, usePage } from '@inertiajs/react';

export default function Welcome() {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Manufacturing ERP System">
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
                            {auth.user ? (
                                <Link
                                    href={route('dashboard')}
                                    className="px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors"
                                >
                                    Dashboard
                                </Link>
                            ) : (
                                <>
                                    <Link
                                        href={route('login')}
                                        className="px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-colors"
                                    >
                                        Log in
                                    </Link>
                                    <Link
                                        href={route('register')}
                                        className="px-6 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition-colors"
                                    >
                                        Get Started
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
                            🚀 Complete Manufacturing 
                            <span className="block text-blue-600 dark:text-blue-400">ERP Solution</span>
                        </h1>
                        <p className="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                            Streamline your manufacturing operations with our comprehensive Enterprise Resource Planning system. 
                            Manage inventory, purchasing, sales, finance, and HR all in one powerful platform.
                        </p>
                        <div className="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                            {!auth.user && (
                                <>
                                    <Link
                                        href={route('register')}
                                        className="px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold text-lg hover:bg-blue-700 transition-colors shadow-lg"
                                    >
                                        Start Free Trial
                                    </Link>
                                    <Link
                                        href={route('login')}
                                        className="px-8 py-3 bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-lg font-semibold text-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors shadow-lg"
                                    >
                                        Sign In
                                    </Link>
                                </>
                            )}
                            {auth.user && (
                                <Link
                                    href={route('dashboard')}
                                    className="px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold text-lg hover:bg-blue-700 transition-colors shadow-lg"
                                >
                                    Go to Dashboard
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
                                    Inventory Management
                                </h3>
                            </div>
                            <p className="text-gray-600 dark:text-gray-300 mb-4">
                                Track raw materials, work-in-progress, and finished goods with real-time stock levels and automated reorder alerts.
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
                                    Purchase Management
                                </h3>
                            </div>
                            <p className="text-gray-600 dark:text-gray-300 mb-4">
                                Streamline your procurement process with vendor management, purchase orders, and delivery tracking.
                            </p>
                            <ul className="text-sm text-gray-500 dark:text-gray-400 space-y-1">
                                <li>• Vendor database</li>
                                <li>• Purchase order automation</li>
                                <li>• Delivery tracking</li>
                            </ul>
                        </div>

                        <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg border dark:border-gray-700">
                            <div className="flex items-center mb-4">
                                <span className="text-4xl mr-4">💰</span>
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white">
                                    Sales & Invoicing
                                </h3>
                            </div>
                            <p className="text-gray-600 dark:text-gray-300 mb-4">
                                Manage customer relationships, sales orders, and automated invoicing to boost your revenue.
                            </p>
                            <ul className="text-sm text-gray-500 dark:text-gray-400 space-y-1">
                                <li>• Customer management</li>
                                <li>• Sales order processing</li>
                                <li>• Automated invoicing</li>
                            </ul>
                        </div>

                        <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg border dark:border-gray-700">
                            <div className="flex items-center mb-4">
                                <span className="text-4xl mr-4">📊</span>
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white">
                                    Financial Management
                                </h3>
                            </div>
                            <p className="text-gray-600 dark:text-gray-300 mb-4">
                                Complete accounting suite with chart of accounts, general ledger, and financial reporting.
                            </p>
                            <ul className="text-sm text-gray-500 dark:text-gray-400 space-y-1">
                                <li>• Chart of accounts</li>
                                <li>• General ledger</li>
                                <li>• Financial reports</li>
                            </ul>
                        </div>

                        <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg border dark:border-gray-700">
                            <div className="flex items-center mb-4">
                                <span className="text-4xl mr-4">👥</span>
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white">
                                    Human Resources
                                </h3>
                            </div>
                            <p className="text-gray-600 dark:text-gray-300 mb-4">
                                Comprehensive employee management with HR records, payroll integration, and performance tracking.
                            </p>
                            <ul className="text-sm text-gray-500 dark:text-gray-400 space-y-1">
                                <li>• Employee database</li>
                                <li>• Department management</li>
                                <li>• Payroll integration</li>
                            </ul>
                        </div>

                        <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg border dark:border-gray-700">
                            <div className="flex items-center mb-4">
                                <span className="text-4xl mr-4">📈</span>
                                <h3 className="text-xl font-bold text-gray-900 dark:text-white">
                                    Analytics & Reports
                                </h3>
                            </div>
                            <p className="text-gray-600 dark:text-gray-300 mb-4">
                                Make data-driven decisions with comprehensive reporting and real-time business intelligence.
                            </p>
                            <ul className="text-sm text-gray-500 dark:text-gray-400 space-y-1">
                                <li>• Real-time dashboards</li>
                                <li>• Custom reports</li>
                                <li>• KPI tracking</li>
                            </ul>
                        </div>
                    </div>

                    {/* Dashboard Preview */}
                    <div className="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-lg border dark:border-gray-700 mb-16">
                        <h2 className="text-3xl font-bold text-gray-900 dark:text-white text-center mb-8">
                            📊 Powerful Dashboard Overview
                        </h2>
                        <div className="bg-gray-50 dark:bg-gray-900 rounded-lg p-6">
                            <div className="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                <div className="bg-blue-100 dark:bg-blue-900 p-4 rounded-lg text-center">
                                    <div className="text-2xl font-bold text-blue-600 dark:text-blue-400">1,234</div>
                                    <div className="text-sm text-gray-600 dark:text-gray-400">Products</div>
                                </div>
                                <div className="bg-green-100 dark:bg-green-900 p-4 rounded-lg text-center">
                                    <div className="text-2xl font-bold text-green-600 dark:text-green-400">567</div>
                                    <div className="text-sm text-gray-600 dark:text-gray-400">Customers</div>
                                </div>
                                <div className="bg-purple-100 dark:bg-purple-900 p-4 rounded-lg text-center">
                                    <div className="text-2xl font-bold text-purple-600 dark:text-purple-400">89</div>
                                    <div className="text-sm text-gray-600 dark:text-gray-400">Vendors</div>
                                </div>
                                <div className="bg-orange-100 dark:bg-orange-900 p-4 rounded-lg text-center">
                                    <div className="text-2xl font-bold text-orange-600 dark:text-orange-400">$125K</div>
                                    <div className="text-sm text-gray-600 dark:text-gray-400">Revenue</div>
                                </div>
                            </div>
                            <div className="text-center text-gray-500 dark:text-gray-400">
                                Real-time business metrics at your fingertips
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
                                    Start Your Free Trial
                                </Link>
                                <Link
                                    href={route('login')}
                                    className="px-8 py-3 bg-transparent border-2 border-white text-white rounded-lg font-semibold text-lg hover:bg-white hover:text-blue-600 transition-colors"
                                >
                                    Sign In Now
                                </Link>
                            </div>
                        ) : (
                            <Link
                                href={route('dashboard')}
                                className="inline-block px-8 py-3 bg-white text-blue-600 rounded-lg font-semibold text-lg hover:bg-gray-100 transition-colors shadow-lg"
                            >
                                Access Your Dashboard
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