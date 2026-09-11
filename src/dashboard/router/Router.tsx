import React from 'react';
import { Navigate, Route, Routes, useLocation } from 'react-router-dom';
import { Dashboard, Help, Products } from '../screens';
import FreeVsPro from '../screens/free-vs-pro/FreeVsPro';
import { StarterTemplates } from '../screens/starter-template/StarterTemplate';

const Router: React.FC = () => {
	const { pathname } = useLocation();

	React.useLayoutEffect(() => {
		const submenu = document.querySelector(
			`.wp-submenu a[href="admin.php?page=colormag#${pathname}"]`,
		);
		if (!submenu) return;
		submenu.parentElement?.classList.add('current');
		return () => {
			submenu.parentElement?.classList?.remove('current');
		};
	}, [pathname]);

	return (
		<Routes>
			<Route path="/" element={<Navigate to="/dashboard" replace />} />
			<Route path="/dashboard" element={<Dashboard />} />
			<Route path="/demo-importer" element={<StarterTemplates />} />
			<Route path="/products" element={<Products />} />
			<Route path="/free-vs-pro" element={<FreeVsPro />} />
			<Route path="/help" element={<Help />} />
			<Route path="*" element={<Navigate to="/dashboard" replace />} />
		</Routes>
	);
};

export default Router;
